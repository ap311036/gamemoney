<?php //$Id: db_class.php 73 2011-06-06 11:01:43Z Administrator $ ?>
<?php


class DB
{

//	protected $db_name = DB_TABLE_NAME;
    protected $db_name;

//	protected $db_host_r = DB_SET_R;
//	protected $db_host_w = DB_SET_W;
    protected $db_host_r;
    protected $db_host_w;

    protected $db_acc;
    protected $db_pw;


    protected $db_connect_flag_r = 0;
    protected $db_connect_flag_w = 0;

    protected $db_connection_r;
    protected $db_connection_w;

    protected $db_debug = 0;

    public function __construct($dbconfig)
    {
//        'schema'=>'tiger_slot',
//        'read_from'=>'localhost',
//        'write_to'=>'localhost',
//        'account'=>'root',
//        'password'=>'grace623',
        $this->db_name = $dbconfig['schema'];
        $this->db_host_r = $dbconfig['read_from'];
        $this->db_host_w = $dbconfig['write_to'];
        $this->db_acc = $dbconfig['account'];
        $this->db_pw = $dbconfig['password'];
    }

    public function db_set()
    {
        //set db
        $this->db_host_r = DB_SET_W;
    }

    //debug mode 0 關閉 1 啟動
    public function debug()
    {
        $this->db_debug = 1;
    }

    //讀取連線
    public function connect_r()
    {


        if ($this->db_connect_flag_r == 0) {


            $connection = new mysqli($this->db_host_r, $this->db_acc, $this->db_pw, $this->db_name);


            if (mysqli_connect_errno()) {
                echo '資料庫連線失敗';
                exit;
            }
            $connection->set_charset("utf8");
            //echo 'r成功';
            $this->db_connect_flag_r = 1;
            $this->db_connection_r = $connection;

            return $connection;
        }

        return $this->db_connection_r;

    }

    //寫入連線
    public function connect_w()
    {

        if ($this->db_connect_flag_w == 0) {


            $connection = new mysqli($this->db_host_w, $this->db_acc, $this->db_pw, $this->db_name);


            if (mysqli_connect_errno()) {
                echo '資料庫連線失敗';
                exit;
            }
            $connection->set_charset("utf8");
            //echo 'w成功';
            $this->db_connect_flag_w = 1;
            $this->db_connection_w = $connection;

            return $connection;
        }

        return $this->db_connection_w;

    }

    public function connect_close()
    {

        if ($this->db_connect_flag_r == 1) {
            mysqli_close($this->connect_r());
        }

        if ($this->db_connect_flag_w == 1) {
            mysqli_close($this->connect_w());
        }
        return true;

    }


    public function execSQL($sql, $params, $type)
    {
//        global $count;
//        $count++;
//        var_dump($count);

        if ($type == 'r')
            $link = $this->connect_r();
        else
            $link = $this->connect_w();

        $results = array();

        //debug mode
        if ($this->db_debug) {
            foreach ($params as $key => $row) {
                if ($key == 0)
                    $sql_show = $sql;
                if ($key > 0)
                    $sql_show = substr_replace($sql_show, '"' . $row . '"', strpos($sql_show, "?"), 1);
            }

            if ($sql_show == '') {
                $sql_show = $sql;
            }

            echo '<pre>SQL語法:' . $sql_show . '</pre>';
            echo '<pre>輸入參數:';
            print_r($params);
            echo '</pre>';
        }

        if ($this->db_debug) {
            $stmt = mysqli_prepare($link, $sql);
        } else {
            $stmt = mysqli_prepare($link, $sql) or die ("資料處理失敗!");
        }

//        die;
        //debug mode
        if ($this->db_debug) {
            // prepare() can fail because of syntax errors, missing privileges, ....
            if (false === $stmt) {
                // and since all the following operations need a valid/ready statement object
                // it doesn't make sense to go on
                // you might want to use a more sophisticated mechanism than die()
                // but's it's only an example
                die('prepare() failed: ' . htmlspecialchars($this->db_connection_r->error));
            }
        }

        $rc = call_user_func_array(array($stmt, 'bind_param'), $this->refValues($params));

        //debug mode
        if ($this->db_debug) {

            // bind_param() can fail because the number of parameter doesn't match the placeholders in the statement
            // or there's a type conflict(?), or ....
            if (false === $rc) {
                // again execute() is useless if you can't bind the parameters. Bail out somehow.
                die('bind_param() failed: ' . htmlspecialchars($stmt->error));
            }
        }


        $rc = $stmt->execute();

        //debug mode
        if ($this->db_debug) {
            // execute() can fail for various reasons. And may it be as stupid as someone tripping over the network cable
            // 2006 "server gone away" is always an option
            if (false === $rc) {
                die('execute() failed: ' . htmlspecialchars($stmt->error));
            }
        }


        //while ( $rows = $rc->fetch_array( MYSQLI_BOTH ))
        //print_r($rows);


        if ($type == 'r') {
            $meta = $stmt->result_metadata();
            //print_r($meta->fetch_field());
            while ($field = $meta->fetch_field()) {
                $parameters[] = &$row[$field->name];

            }

            call_user_func_array(array($stmt, 'bind_result'), $this->refValues($parameters));

            while ($stmt->fetch()) {
                $x = array();
                foreach ($row as $key => $val)
                    $x[$key] = $val;

                $results[] = $x;
            }

            $result = $results;
        } else {

            if ($type == 'wi')
                $result = $stmt->insert_id;
            else
                $result = $stmt->affected_rows;


        }

        $stmt->close();

        //$mysqli->close();

        return $result;


    }

    public function refValues($arr)
    {
        if (strnatcmp(phpversion(), '5.3') >= 0) //Reference is required for PHP 5.3+
        {
            $refs = array();
            foreach ($arr as $key => $value)
                $refs[$key] = &$arr[$key];

            return $refs;
        }

        return $arr;
    }



    /************************************
     * @2011-12-27 sql 處理式
     ************************************/
    //建立可執行的 Selec 語法
    public function dbSelect($sql, $sql_input)
    {
        $i = 1;
        $arr_input = array("");
        foreach ($sql_input as $val) {
            if ($val != '') {
                $arr_input[0] .= 's';

                $arr_input[$i++] = $val;
            }
        }

        //echo $sql;
        //$this->log_sys_add_w(3,$table.','.$def.$sql_input[count($sql_input)-1]);
        return $this->execSQL($sql, $arr_input, 'r');
    }

    //建立可執行的 Insert 語法
    public function dbInsert($sql, $sql_input)
    {
        $columns = "";
        $values = "";
        $i = 1;
        $arr_condition = array("");
        //整理欄位 和 value 對應
        foreach ($sql_input as $column => $value) {
//			$i++;   
            if ($value != NULL) {
//				$arr_condition[0] = $arr_condition[0].'s';
                $arr_condition[0] .= 's';
                $arr_condition[$i++] = $value;
                $columns .= ($columns == "") ? "" : ", ";
                $columns .= $column;
                $values .= ($values == "") ? "" : ", ";
                $values .= '?';
            }
        }


        $sql = $sql . " ($columns) values ($values)";

        //echo $sql;
        //var_dump( $arr_condition);
        //exit();
        //$this->log_sys_add_w(1,$table);

        return $this->execSQL($sql, $arr_condition, 'wi');
    }

    //建立可執行的 Update 語法
    public function dbUpdate($sql, $sql_input_data, $sql_condition, $sql_input_condition)
    {
        //設定column value
        $vc = "";
        $i = 1;
        $arr_condition = array("");
        foreach ($sql_input_data as $column => $value) {
            $arr_condition[0] .= 's';
            $arr_condition[$i++] = $value;
            $vc .= ($vc == "") ? "" : ", ";
            $vc .= ($column == "") ? "" : "$column = ? ";
        }

        //設定 where 搜尋條件
        foreach ($sql_input_condition as $val) {
            if ($val != NULL) {
                $arr_condition[0] .= 's';
                $arr_condition[$i++] = $val;
            }
        }

        //$sql= "UPDATE $table SET $vc WHERE $def";
        $sql = $sql . ' SET ' . $vc . ' WHERE ' . $sql_condition;
        //echo $sql;
        //var_dump($arr_condition);
        //$this->log_sys_add_w(2,$table.','.$def.$sql_input[count($sql_input)-1]);
        //exit();
        return $this->execSQL($sql, $arr_condition, 'wu');
    }

    //建立可執行的 DELETE 語法
    public function dbDelete($sql, $sql_condition, $sql_input_condition)
    {
        //設定column value
        $vc = "";
        $i = 0;

        //設定 where 搜尋條件
        foreach ($sql_input_condition as $val) {
            if ($val != NULL) {
                $i++;
                $arr_condition[0] = $arr_condition[0] . 's';
                $arr_condition[$i] = $val;
            }
        }

        $sql = $sql . ' WHERE ' . $sql_condition;

        return $this->execSQL($sql, $arr_condition, 'wu');
    }

    /*
    for sql 通用式
    */

    public function dbSelectPrepare($sql, $arr_input)
    {
        return $this->dbSelect($sql, $arr_input);
    }

    public function dbInsertPrepare($sql, $arr_input)
    {
        return $this->dbInsert($sql, $arr_input);
    }

    public function dbUpdatePrepare($sql, $sql_input_data, $sql_where_condition, $sql_where_value)
    {
        return $this->dbUpdate($sql, $sql_input_data, $sql_where_condition, $sql_where_value);
    }

    public function dbDeletePrepare($sql, $sql_where_condition, $sql_where_value)
    {
        return $this->dbDelete($sql, $sql_where_condition, $sql_where_value);
    }

    public function checkSQLResult($res)
    {
        if ($res === 0)
            return false;
        else if (is_array($res)) {
            if (empty($res[0]))
                return false;
        } else if (!is_int($res))
            return false;
        return true;

    }

    public function getOneRow($res)
    {
        return $res[0];
    }

    public function getSingleValue($res)
    {
        return $res[0][min(array_keys($res[0]))];
    }


    function getMysqliLink($type)
    {
        if ($type == 'r')
            return $this->connect_r();

        else
            return $this->connect_w();
    }
    //目前不作select資料與bindpram,使用前請先確認過濾所以參數 以免被SQL injection
    //廢棄 原因：執行後第2筆SQL不能使用
//
//    function multiQuery($sql, $type)
//    {
//        if ($type == 'r')
//            $link = $this->connect_r();
//        else
//            $link = $this->connect_w();
//
//        $results = array();
//
//        //debug mode
//        if ($this->db_debug) {
//            echo '<pre>SQL語法:' . $sql . '</pre>';
//            echo '</pre>';
//        }
//
//        //while ( $rows = $rc->fetch_array( MYSQLI_BOTH ))
//        //print_r($rows);
//        $return_arr = array();
//        $trigger = $link->multi_query($sql);
//
//        if (!$trigger && $this->db_debug)
//            echo $link->error;
////        echo $link->affected_rows;
//
//        //执行多条SQL命令
////            do {
////                if ($result = $link->store_result()) {
////                    //获取第一个结果集
////                    var_dump('row:', $row);
////                    while ($row = $result->fetch_row()) {
////
////                        var_dump('row2:', $row);
////                        var_dump('fetch:', $result->fetch_row());
////                        //遍历结果集中每条记录
////                        foreach ($row as $data) {
////                            //从一行记录数组中获取每列数据
//////                            echo $data . "&nbsp;&nbsp;";
////                            //输出每列数据
////                        }
//////                        echo "<br>";
////                        //输出换行符号
////                    }
////
////                    $returnVar = $link->affected_rows;
////                    array_push($return_arr, $returnVar);
////                    $result->close();
////                    //关闭一个打开的结果集
////                }
////                if ($link->more_results()) {
////                    //判断是否还有更多的结果集
//////                    echo "-----------------<br>";
////                    //输出一行分隔线
////                }
////            } while ($link->next_result());
////            //获取下一个结果集，并继续执行循环
//
//        //关闭mysqli连接
////        $link->close();
//
//
//        return $return_arr;
//
//
//    }

}

?>