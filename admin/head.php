<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<title>歡迎使用Slot管理系統</title>
<!--old
<link href="css/bootstrap.css" rel="stylesheet" media="screen">
<link href="css/jquery-ui-1.10.3.custom.css" rel="stylesheet"/>
-->
<!-- Le styles -->
<link href="css/bootstrap.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="css/docs.css" rel="stylesheet">
<link href="css/jquery-ui-1.8.19.custom.css?ver=201410171649" rel="stylesheet">
<link href="css/font.css" rel="stylesheet">

<style type="text/css">
body {padding-top: 60px;padding-bottom: 40px;}
.sidebar-nav {padding: 9px 0;}
</style>
<script src="js/jquery-1.9.1.min.js"></script>
<script src="js/jquery-ui-1.10.3.custom.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/comm.js"></script>

</head>
<body>
	<?php 
    if($id_id !="login")
    {
    ?>
	<div class="navbar navbar-inverse navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container-fluid">
                <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
			<div class="btn-group pull-left">
                <h3><a href="index.php">管理系統</a></h3>
            </div>
            <?php
            //include nav op
			include_once "nav_collapse.php";
			//include nav ed
			?>
                
                <!--/.nav-collapse -->
            </div>
        </div>
    </div>
	<?php
    }
    ?>	        
