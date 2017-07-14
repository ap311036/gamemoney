<?php

/**
 * Created by PhpStorm.
 * User: Magus
 * Date: 2017/1/16
 * Time: 下午3:32
 */
class JpotData
{

    protected $jpot_id;
    protected $button_points;
    protected $charge_points;
    protected $acc_ratio;
    protected $acc_limit;
    protected $lottery_ratio;
    protected $charge_ratio;
    protected $accumulation;
    protected $win_amount;
    protected $game_id;
    protected $player_id;
    protected $player_win_point;


    /**
     * @return mixed
     */
    function initData($input_arr)
    {
        foreach ($input_arr as $key => $input)
            if ($key != 'id')
                $this->$key = $input;
        $this->win_amount = 0;

    }

    function setGameID($game_id)
    {

        $this->game_id = $game_id;
    }

    function setPlayeID($player_id)
    {

        $this->player_id = $player_id;
    }

    /**
     * @return mixed
     */
    public function getGameId()
    {
        return $this->game_id;
    }

    /**
     * @return mixed
     */
    public function getPlayerId()
    {
        return $this->player_id;
    }

    /**
     * @return mixed
     */
    public function getWinAmount()
    {
        return $this->win_amount;
    }

    public function getJpotId()
    {
        return $this->jpot_id;
    }

    /**
     * @return mixed
     */
    public function getAccLimit()
    {
        return $this->acc_limit;
    }

    /**
     * @return mixed
     */
    public function getAccRatio()
    {
        return $this->acc_ratio;
    }

    /**
     * @return mixed
     */
    public function getButtonPoints()
    {
        return $this->button_points;
    }

    /**
     * @return mixed
     */
    public function getChargePoints()
    {
        return $this->charge_points;
    }

    /**
     * @return mixed
     */
    public function getChargeRatio()
    {
        return $this->charge_ratio;
    }

    /**
     * @return mixed
     */
    public function getLotteryRatio()
    {
        return $this->lottery_ratio;
    }

    /**
     * @return mixed
     */
    public function getAccumulation()
    {
        return $this->accumulation;
    }

    function addAccumulation($acc_amount, DB $jpot_db)
    {
        /**
         * 將輸入spin積分轉換為累積積分 存入JpotData
         *
         *超過上限則以上限數值唯一
         *
         *每500累積0.4積分=>500000:400
         *
         * 回傳：增加積分 ？可能有錯
         *
         *
         */
        $limit = $this->getAccLimit();
        $accumulation = $this->getAccumulation();

        $point = $this->calculateAddAcc($acc_amount);

        $update_id = $this->getJpotId();
//        var_dump($acc_amount);
//        var_dump($limit);
//        var_dump($point);
//update jpot set accumulation = case when accumulation < 10000 then accumulation + 1 else 1000 end where id =5;
        $sql = "update jpot set accumulation = case when accumulation < $limit then accumulation + $point
  else $limit end where id =$update_id ";

        $result = $jpot_db->execSQL($sql, [], 'w');

        if ($accumulation + $point > $limit) {
            $this->accumulation = $limit;
            return $this->accumulation - $point < 0 ? 0 : $this->accumulation - $point;
        }
        $this->accumulation += $point;
        return $point;

    }

    function calculateAddAcc($acc_amount)
    {


        return (int)($acc_amount / $this->getChargePoints()) * $this->getAccRatio();

    }

    function dealLuckyDraw($acc_amount, $member, DB $jpot_db, DB $admin_db)
    {

        /**
         * 抽獎：
         * 每 1500抽一次 中獎機率0.01
         *1500000 ,10 ,總機率為100*100000 = 10000000
         *
         */
        $lottery_num = $this->calculateLuckyNum($acc_amount);

        if ($lottery_num <= 0)
            return false;
//        var_dump('lottery count', $lottery_num);
        //每個jp只能抽一次
//        for ($i = 0; $i < $lottery_num; $i++) {
//            $win = $this->isLotteryWin();
//            if ($win) {
//                $this->win_amount = $this->accumulation;
//                $this->setBottonAcc();
//
//                return $win;
//            }
//        }
        $win = $this->isLotteryWin();
        if ($win) {
//            var_dump($win);
            $this->win_amount = $this->accumulation;
            $this->reduceJpotAndAddPlayerBank($member, $jpot_db, $admin_db);
//            $this->setBottonAcc();

            return $win;
        }


        return 0;


    }

    function setPlayerGetWin($player_win_point)
    {

        $this->player_win_point = $player_win_point;
    }

    /**
     * @return mixed
     */
    public function getPlayerWinPoint()
    {
        return $this->player_win_point;
    }

    function reduceJpotAndAddPlayerBank($member, DB $jpot_db, DB $admin_db)
    {
        $player_id = $this->getPlayerId();

        $game_id = $this->getGameId();
        $add_point = $this->win_amount;
        $reduce = $add_point - $this->getButtonPoints();

        $player_get_point = (int)($add_point / 100);
        $this->setPlayerGetWin($player_get_point);
        $jp_id = $this->getJpotId();
        $sql2 = "update jpot set accumulation = accumulation - $reduce where id = $jp_id  ;";

        $game = $admin_db->dbSelectPrepare(
            'select * from game',
            ['id' => $game_id]
        )[0];


        $now = date('Y-m:d H:i:s');
        $v_string = "($jp_id,$game_id,$player_get_point,$player_id
        , '" . $now . "'
        , '" . $member['account'] . "' 
        , '" . $member['name'] . "' 
        , '" . $game['name'] . "'
            );";

        $sql3 = "insert into jpot_win_record (jpot_id,game_id,win_amount,member_id
,created_at
,member_account
,member_name
,game_name

) VALUES 
                $v_string";

        $sql_ex = [];
//        array_push($sql_ex, $sql1);
        array_push($sql_ex, $sql2);
        array_push($sql_ex, $sql3);

        $jlink = $jpot_db->getMysqliLink('w');
        $jlink->autocommit(false);
        $adlink = $admin_db->getMysqliLink('w');
        $adlink->autocommit(false);
        $sql1 = "update member set point = point + $player_get_point where id = $player_id  ;";

        if (false == $adlink->query($sql1)) {
            $adlink->rollback();
            $sql_input = [];
            $sql_input['jpot_id'] = $jp_id;
            $sql_input['game_id'] = $game_id;
            $sql_input['win_amount'] = $player_get_point;
            $sql_input['member_id'] = $player_id;
            $sql_input['created_at'] = $now;
            $sql_input['error_msg'] = json_encode($sql1);
            $sql_input['input_detail'] = json_encode($_POST);
            $sql_input['member_detail'] = json_encode($member);
            $this->insertJpotErr($jpot_db, $sql_input);
            return false;
        }


        foreach ($sql_ex as $query) {
//            global $count;
//            $count++;
//            var_dump($count);
            if (false == $jlink->query($query)) {
                $jlink->rollback();
                $sql_input = [];
                $sql_input['jpot_id'] = $jp_id;
                $sql_input['game_id'] = $game_id;
                $sql_input['win_amount'] = $player_get_point;
                $sql_input['member_id'] = $player_id;
                $sql_input['created_at'] = $now;
                $sql_input['error_msg'] = json_encode($sql1);
                $sql_input['input_detail'] = json_encode($_POST);
                $sql_input['member_detail'] = json_encode($member);
                $this->insertJpotErr($jpot_db, $sql_input);

                return false;
            };

        }
        $adlink->commit();
        $jlink->commit();
        return true;

    }

    function insertJpotErr(DB $jpot_db, $sql_input)
    {
        $sql = 'insert into jpot_error_log';

        $jpot_db->dbInsertPrepare($sql, $sql_input);

    }


    function isLotteryWin()
    {

        $rate = $this->getLotteryRatio();
        $tick = (mt_rand(1, 100000));
//        var_dump('win_rate:'.$rate.',tick:'.$tick);
        $win = $rate >= $tick;
        return $win;

    }


    function calculateLuckyNum($acc_amount)
    {

        $lucky_count = (int)($acc_amount / $this->getChargeRatio());
        return ($lucky_count);
    }

//    function setBottonAcc()
//    {
//
//        $this->accumulation = $this->getButtonPoints();
//
//
//    }

//    function saveData($admin_db)
//    {
//        $sql = 'Update jpot';
//        $trigger = $admin_db->dbUpdatePrepare($sql, ['accumulation' => $this->getAccumulation()],
//            'id = ? ', ['id' => $this->getJpotId()]);
//        return $trigger;
//
//    }


}