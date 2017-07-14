<?php

//取得網頁名稱，排除附檔名和參數
function get_page_name($page)
{
	//取得檔名
	if($page == '')
	{
		preg_match('#/(.*).php#iUs', getenv("REQUEST_URI"),$page_idx);
	}
	else
	{
		preg_match('#(.*).php#iUs', $page,$page_idx);
	}
	
	return $page_idx[1].'.php';	
}

//判斷檔名 將符合的nav 設定成選取狀態
function html_nav_selected($nav_name)
{
	$page_name_now = get_page_name();

	if($page_name_now == get_page_name($nav_name))
	{
		return ' class="active"';	
	}
}

//取得tab group
function get_tab_group($tab,$url)
{
	if($url == '.php')
	{
		return '';
	}
	else
	{
		foreach($tab as $group)
		{
			foreach($group as $link => $row)
			{
				if($url == get_page_name($link))
				{
					return $group['group'];
				}
			}
		}
	}
}











?>