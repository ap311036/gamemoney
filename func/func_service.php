<?php
session_start(); 
date_default_timezone_set("Asia/Taipei");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

include_once("lib/config.php");
include_once("lib/WebDB.php");
include_once("lib/basePage.php");

$viewData  = array();
class func_service extends basePage
{

    public function page_load()
    {
        //是否登入
        //$this->isLogin();

        if( isset( $_GET['m']))
        {
            switch($_GET['m'])
            {
                case 'contact_us':
                        $this->save_contact();
                        break;

                case 'recommand':
                        $this->save_recommand();
                        break;
            }          
        }

        global $viewData ;
        $viewData['qlist'] = $this->getQuestion();
        $viewData['qlist2'] = $this->getLair();
        $viewData['user_rule'] = $this->getUserRule();
    }

    public function save_contact()
    {
        $input = array();
        $input['name'] = $_POST['name'];
        $input['phone'] = $_POST['tel'];
        $input['type'] = "contact_us";
        $input['email'] = $_POST['email'];
        $input['content'] = $_POST['content'];
        $input['create_date'] = date('Y-m-d H:i:s');

        $this->_db->Insert('contact_us',$input);
       
        $this->alert('留言成功，客服人員會盡快回覆您的問題。');
    }

    public function save_recommand()
    {
        $input = array();
        $input['name'] = $_POST['title'];
        $input['phone'] = $_POST['phone'];
        $input['type'] = "recommand";
        $input['email'] = $_POST['email'];
        $input['content'] = $_POST['content'];
        $input['create_date'] = date('Y-m-d H:i:s');
        $this->_db->Insert('contact_us',$input);
       
        $this->alert('留言成功，客服人員會盡快回覆您的問題。');
    }

    public function getQuestion()
    {
        $sql = 'select a.question
                        ,a.title
                        ,a.answer
                        ,a.create_date
                        ,b.name type

                    from question a 
                    left join question_type b on(a.question_type_id=b.id) 
                where a.is_del = 0 ';
        $result = $this->_db->query($sql);
        return $result;

    }

    public function getLair()
    {
          $sql = 'select *
                    from question2 
                where is_del = 0 ';
        $result = $this->_db->query($sql);
        return $result;

    }


    public function getUserRule()
    {
            $sql = 'select *
                    from user_rule  
                where is_del = 0 ';
        $result = $this->_db->query($sql);
        return $result;
    }

}

 $aa = new func_service();
 $aa->page_load();




?>