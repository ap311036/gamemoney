<?php
require_once('func/func_nav_collapse.php');

$tab_group = get_tab_group($tab,get_page_name());

?>
<div class="nav-collapse">
       
        
                         <?php 
                if(count($admin)>0){
                ?>
                    <p class="navbar-text pull-right">
                        [<?php echo $admin['ad_name'];?>]，歡迎登入&nbsp;&nbsp;&nbsp;<a href="login_act.php?logout=logout" class="btn btn-info">登出</a>
                    </p>
                    <ul class="nav">
                    	<li <?php echo html_nav_selected('index.php');?>><a href="index.php">導覽頁</a></li>
        <?php
			foreach($tab[$tab_group] as $key => $row)
			{
				if($key == 'title' || $key == 'group')
				{
					continue;
				}
		?>
				<li <?php echo html_nav_selected($key);?>><a href="<?php echo $key;?>"><?php echo $row;?></a></li>
		<?php
			}
		?>
                    </ul>
                     <?php 
                }
                ?>
        
   
</div><!--/.nav-collapse -->

        
