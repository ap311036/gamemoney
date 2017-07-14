<?php
//ini_set('display_errors',1);

class Pager{
	private $page = array(
				'showCnt' => 10,
				'page_limit' => 20,
			);
	
	function __construct($page)
	{
		if($page['page_limit'] == '')
		{
			$page['page_limit'] = $this->page['page_limit'];
		}
		
		$pg = ($page['num']/$page['page_limit']);
		if($pg == 0)
		{
			$page['total'] = 1;
		}
		else
		{
			$page['total'] = ceil($pg);
		}
		
		
		if($page['page_id'] > $page['total'])
		{
			$page['page_id'] = $page['total'];
		}
                
		if($page['page_id'] < 1)
		{
			$page['page_id'] = 1;
		}
		
		$page['start'] = (($page['page_id']-1)*$page['page_limit']);
		
		if($page['start'] == 0)
		{
			$page['start'] = '0';
		}
		
		
		foreach($page as $key => $val)
		{
			$this->page[$key] = $val;
		}
	}
	
	function getPage($tag)
	{
		return $this->page[$tag];
	}
	
	function getSqlLimit()
	{
		return 'limit '.$this->page['start'].','.$this->page['page_limit'];
	}
	
	function getPageHead()
	{
		$str .= '<div class="pull-left span7" style="margin-top:10px">';
		$str .= '搜尋結果：共 '.$this->page['num'].' 筆 顯示 '.($this->page['start']+1).' - '.($this->page['start']+$this->page['page_limit']).' 項';
		$str .= '</div>';
		$str .= '<div class="pull-right span4 text-right">';
		$str .= '<ul class="pager">';
		if(($this->page['page_id']-1) > 0)
		{
			$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']-1)),1).'">上一頁</a></li>';
		}
		else 
		{
			$str .= '<li class="disabled"><a href="javascript:void(0);">上一頁</a></li>';
		}
		if(($this->page['page_id']+1) <= $this->page['total'])
		{
			$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']+1)),1).'">下一頁</a></li>';
		}
		else 
		{
			$str .= '<li class="disabled"><a href="javascript:void(0);">下一頁</a></li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
		return $str;
	}
	
	function getPageFoot()
	{
		if($this->page['total'] >= 2)
		{
			$str .= '<div class="span12 pagination">';
			$str .= '<ul>';
			if($this->page['page_id'] > 1)
			{
				$str .= '<li><a href="'.get_Url(array('pageID'=>1),1).'">第一頁</a></li>';
				$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']-1)),1).'">&lt;&lt;</a></li>';
			}		
                        
                       $showCnt = $this->page['showCnt'];
                      if ($showCnt > $this->page['total'])
                          $showCnt = $this->page['total'];
                      
				$level = floor(($this->page['total']-1) / $showCnt) * $showCnt;
				$for_i = floor(($this->page['page_id']-1) / $showCnt) * $showCnt;
				if($level == $for_i)
				{
					$for_i = $this->page['total'] - $showCnt;
				}
				
				$for_len = $for_i + $showCnt;
				
				for($for_i ; $for_i < $for_len ; $for_i++)
				{
					if(($for_i+1) == $this->page['page_id'])
					{
						$str .= '<li class="active">';
					}
					else 
					{
						$str .= '<li>';
					}
					$str .= '<a href="'.get_Url(array('pageID'=>($for_i+1)),1).'">'.($for_i+1).'</a></li>';
				}
				
				if($this->page['page_id'] < $this->page['total'])
				{
					$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']+1)),1).'">&gt;&gt;</a></li>';
					$str .= '<li><a href="'.get_Url(array('pageID'=>$this->page['total']),1).'">最末頁</a></li>';
				}
			$str .= '</ul>';
			$str .= '</div>';

			return $str;
		}
	}
	
	function getFramePageHead($frame_id,$url)
	{
		$str .= '<div class="pull-left span7" style="margin-top:10px">';
		$str .= '搜尋結果：共 '.$this->page['num'].' 筆 顯示  <span id="page_show_limit">'.($this->page['start']+1).' - '.($this->page['start']+$this->page['page_limit']).'</span> 項';
		$str .= '</div>';
		$str .= '<div class="pull-right span4 text-right">';
		$str .= '<ul class="pager">';
		
		
		
		//$str .= '<li id="page_prev"><a href="javascript:void(0);" onclick="change_page(1);">上一頁</a></li>';
		
		$str .= '<li id="page_prev" class="disabled"><a href="#">上一頁</a></li>';
		
		if(($this->page['page_id']+1) <= $this->page['total'])
		{
			$str .= '<li id="page_next"><a href="javascript:void(0);" onclick="change_page(1);">下一頁</a></li>';
		}
		else
		{
			$str .= '<li id="page_next" class="disabled"><a href="#">下一頁</a></li>';
		}
		$str .= '</ul>';
		$str .= '</div>';
		
		$str .= '<script>
				 var page_now = 1;
				 var page_total = '.$this->page['total'].';
				 var frame_url_o = \''.$url.'\';
				 var frame_url = \''.$url.'\';
				 var page_limit = '.$this->page['page_limit'].';
				 		
				 function change_page(add)
				 {
					var temp_page = page_now + add;
					if( temp_page > page_total )
				 	{
				 		alert(\'大於總頁數，沒有下一頁!\');
				 		return false;
					}
				 	if( temp_page < 1 )
				 	{
				 		alert(\'小於總頁數，沒有上一頁!\');
				 		return false;
					}
				 		
				 	if( temp_page == page_total)
			 		{
				 		$(\'#page_next\').prop(\'class\',\'disabled\');
				 		$(\'#page_next\').html(\'<a href="#">下一頁</a>\');
			 		}
				 	else
				 	{
				 		$(\'#page_next\').prop(\'class\',\'\');
				 		$(\'#page_next\').html(\'<a href="javascript:void(0);" onclick="change_page(1);">下一頁</a>\');
				 	}
				 		
				 	if( temp_page == 1)
			 		{
				 		$(\'#page_prev\').prop(\'class\',\'disabled\');
				 		$(\'#page_prev\').html(\'<a href="#">上一頁</a>\');
			 		}
				 	else
				 	{
				 		$(\'#page_prev\').prop(\'class\',\'\');
				 		$(\'#page_prev\').html(\'<a href="javascript:void(0);" onclick="change_page(-1);">上一頁</a>\');
				 	}
				 	var temp_show = ((temp_page-1)*page_limit);
				 	var temp_show_start = temp_show + 1;
				 	var temp_show_end = temp_show + page_limit;	
				 	
				 	$(\'#page_show_limit\').html(temp_show_start + \' - \' + temp_show_end);	
				 	$(\'#'.$frame_id.'\').prop(\'src\',frame_url+\'&pageID=\'+temp_page);

				 	page_now = temp_page;
				 }
				 </script>';
		return $str;
	}
	
	function getFramePageFoot()
	{
		if($this->page['total'] >= 5)
		{
			$str .= '<div class="span12 pagination">';
			$str .= '<ul>';
			if($this->page['page_id'] > 1)
			{
				$str .= '<li><a href="'.get_Url(array('pageID'=>1),1).'">第一頁</a></li>';
				$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']-1)),1).'">&lt;&lt;</a></li>';
			}
			$level = floor(($this->page['total']-1) / $this->page['showCnt']) * $this->page['showCnt'];
			$for_i = floor(($this->page['page_id']-1) / $this->page['showCnt']) * $this->page['showCnt'];
			if($level == $for_i)
			{
				$for_i = $this->page['total'] - $this->page['showCnt'];
			}
	
			$for_len = $for_i + $this->page['showCnt'];
	
			for($for_i ; $for_i < $for_len ; $for_i++)
			{
			if(($for_i+1) == $this->page['page_id'])
			{
			$str .= '<li class="active">';
			}
			else
			{
			$str .= '<li>';
			}
			$str .= '<a href="'.get_Url(array('pageID'=>($for_i+1)),1).'">'.($for_i+1).'</a></li>';
		}
	
		if($this->page['page_id'] < $this->page['total'])
				{
				$str .= '<li><a href="'.get_Url(array('pageID'=>($this->page['page_id']+1)),1).'">&gt;&gt;</a></li>';
						$str .= '<li><a href="'.get_Url(array('pageID'=>$this->page['total']),1).'">最末頁</a></li>';
				}
			$str .= '</ul>';
			$str .= '</div>';
	
				return $str;
					}
	}
	
	
}?>