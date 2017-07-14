<?php
session_start();
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");
include_once("lib/Carbon.php");

$viewData = array();
use \Carbon\Carbon;

class func_activity extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        //get 上有要特別處理的參數
        $arrGetParam = array();
        $arrGetParam['m'] = 'getPrizelist';
        global $viewData;

        foreach ($arrGetParam as $k => $v) {
            if (isset($_GET[$k])) {
                if ($_GET[$k] == 'getPrizelist') {
                    $viewData['single'] = $this->getPrizeSingle($_GET['act']);
                }
            }
        }

        global $viewData;
        $viewData['activity'] = $this->getActivity();
        $viewData['prizeList'] = $this->getPrizeDetail();
        $viewData['actPrize'] = $this->getActivityPrize();
//        echo json_encode($viewData['prizeList']);
//        die;


    }

    public function getPrizeDetail()
    {
        $activitys = $this->getActivityPrize();
        $sql2 = 'select * from prize ';
        $pzs = $this->_db->query($sql2);

        $result = [];
        foreach ($activitys as $at) {

            $act = $this->mergeAct($at);


            $player = $this->getActPlayer($act['act_id']);
            $act['prize_detail'] = $this->sortPrizePlayer($pzs, $player);
            array_push($result, $act);
        }
        return $result;

    }

    function mergeAct($act)
    {

        $res = [];
        $res['act_id'] = $act['id'];
        $res['title'] = $act['title'];
        $res['prize_detail'] = [];
        return $res;

    }

    function getActPlayer($act_id)
    {
        $sql = 'select ap.*,m.name,p.prize_item from activity_prize as ap left outer join member as m
        on m.id=ap.member_id left outer join prize as p on p.id =ap.prize_id where ap.activity_id
        =' . $act_id;
        $player = $this->_db->query($sql);
        return $player;


    }

    function sortPrizePlayer($pzs, $player)
    {

        $prize = [];
        foreach ($pzs as $k => $p) {
            $prize[$k] = [];
            $prize[$k]['prize_id'] = $p['id'];
            $prize[$k]['prize_item'] = $p['prize_item'];
            $prize[$k]['player'] = [];

        }

        foreach ($player as $q) {
            foreach ($pzs as $k => $p) {
                if ($p['id'] == $q['prize_id']) {//'prize_id
                    array_push($prize[$k]['player'], $q['name']);//player_name
                }
            }

        }
        foreach ($prize as $a => $p) {
            if (empty($p['player']))
                unset($prize[$a]);

        }
        sort($prize);
        return $prize;


    }


    public function getActivity()
    {

        $today = Carbon::now()->toDateTimeString();
        $sql = 'select * from activity where publish_start_date <= \'' . $today . '\' and publish_end_date >= \'' . $today . '\' 
        and is_delete = 0';
        $result = $this->_db->query($sql);
        return $result;


    }

    function getPrizeList()
    {
        $today = Carbon::now()->toDateTimeString();


        $sql = 'select ac.id as act_id,ac.title as prize_title,ac.description, p.prize_item,ac.prize_start_date,ac.prize_end_date,m.name,m.id as member_id ,
p.id as prize_id from activity as ac left outer join activity_prize as ap on 
ac.id=ap.activity_id left outer join member as m on m.id = ap.member_id 
left outer join prize as p on p.id = ap.prize_id
 where prize_start_date <= \'' . $today . '\' and prize_end_date >= \'' . $today . '\' 
        and is_delete = 0 and m.name IS NOT NULL order by ac.id ';
        $list = $this->_db->query($sql);

        $sql2 = 'select id as pz_id  from prize';
        $pzs = $this->_db->query($sql2);
        $activity = $this->getActivityPrize();
        $result = [];
        foreach ($activity as $key => $act) {
            $trigger1 = false;
            $trigger2 = false;
            $act_id = $act['id'];
            foreach ($list as $k => $l) {
                if (!$trigger1) {
                    $act_arr = [];
                    $act_arr['act_id'] = $act_id;
                    $act_arr['act_title'] = $act['title'];
                    $act_arr['prize'] = [];
//                    $result[$key] = $act_arr;//array_push?
                    array_push($result, $act_arr);

                    $trigger1 = true;

                }
                $pact_id = $l['act_id'];

                if ($act_id == $pact_id) {
                    $trigger2 = false;
                    foreach ($pzs as $t => $p) {

                        $pz_key = $p['pz_id'];
                        if (/*$pz_key == $l['prize_id'] &&*/
                        !$trigger2
                        ) {
                            $pr_arr = [];
                            $pr_arr['pz_id'] = $l['prize_id'];
                            $pr_arr['prize_item'] = $l['prize_item'];
                            $pr_arr['player'] = [];
                            array_push($result[$key]['prize'], $pr_arr);
//                            $result[$key]['prize'] = $pr_arr;
                            $trigger2 = true;
                        }

                        if ($pz_key == $l['prize_id']) {

                            array_push($result[$key]['prize'][$t]['player'], $l['name']);
                        }
                    }
                    unset($trigger2);
                }
            }
            if ($pact_id == $pact_id && $pact_id == 2)
                unset($trigger1);
        }
        echo(json_encode($result));

//        echo json_encode($result);
        return $result;

    }

    function getPrizeSingle($act_id)
    {
        $today = Carbon::now()->toDateTimeString();


        $sql = 'select ac.id as act_id,ac.title as prize_title,ac.description, p.prize_item,
ac.link_url,ac.img_url,ac.prize_start_date,ac.prize_end_date,m.name,m.id as member_id ,
ap.id as prize_id from activity as ac left outer join activity_prize as ap on 
ac.id=ap.activity_id left outer join member as m on m.id = ap.member_id 
left outer join prize as p on p.id = ap.prize_id
 where prize_start_date <= \'' . $today . '\' and prize_end_date >= \'' . $today . '\' 
        and is_delete = 0  and ac.id = ' . $act_id . 'order by ac.id ';
        $list = $this->_db->single($sql);

        return $list;
//
//        $activity = $this->getActivityPrize();
//        $result = [];
//        foreach ($activity as $key => $value) {
//
//            $activity = [];
//            $activity['act_title'] = $value['title'];
////            $activity['prize_start'] = $value['prize_start_date'];
////            $activity['prize_end'] = $value['prize_end_date'];
////            $activity['img_url'] = $value['img_url'];
////            $activity['link_url'] = $value['link_url'];
//            $activity['prize_list'] = [];
//
//            foreach ($list as $item) {
//                if ($value['id'] == $item['act_id'])
//                    array_push($activity['prize_list'], $item);
//
//            }
//            $result[$value['id']] = $activity;
//
//
//        }


//        echo json_encode($result);
//        return $result;

    }

    public function getActivityPrize()
    {
        $today = Carbon::now()->toDateTimeString();
        $sql2 = 'select a.*,ap.member_id from activity as a left outer join activity_prize as ap on ap.activity_id=
 a.id where prize_start_date <= \'' . $today . '\' and prize_end_date >= \'' . $today . '\' 
        and a.is_delete = 0 and ap.member_id is not null order by a.title ';
        $activity = $this->_db->query($sql2);

        foreach ($activity as $k => $act) {
            if ($k == 0)
                continue;
            elseif ($act['id'] == @$activity[$k - 1]['id'])
                unset($activity[$k]);
        }
        sort($activity);
        return $activity;

    }


}

$aa = new func_activity();
$aa->page_load();


?>