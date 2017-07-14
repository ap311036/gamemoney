<?php 
class FileUpload{ 
	
	//default
	private $def_set = array(
				'width' 		=> 800,			//最大寬(圖片用)
				'height' 		=> 600,			//最大高(圖片用)
				'file_size_max' => 100000000,		//最大size
				'overwrite' 	=> 0,			//接受覆蓋檔案
			);
	
	private $ImgError = '';
	
	//change def_set value
	function set_def($item,$val)
	{
		$this -> def_set[$item] = $val;
	}
	
	function getError()
	{
		return $this -> ImgError;
	}
	
	private function fileError($file = '')
	{
		if($file == '')
		{
			$this -> ImgError = '對不起，呼叫有問題！file不存在!';
			return false;
		}
		
		if($file['tmp_name'] == '')
		{
			$this -> ImgError = '對不起，檔案上傳有問題!';
			return false;
		}
		
		if($file['error'] > 0)
		{
			switch($file['error'])
			{
				case 1:
					$this -> ImgError = '上傳圖片['.$file['name'].']失敗！請檢查圖片的容量是否大於規定。';
					break;
				case 2:
					$this -> ImgError = '圖片太大！['.$file['name'].']';
					break;
				case 3:
					$this -> ImgError = '圖片只加載了一部分！['.$file['name'].']';
					break;
				case 4:
					$this -> ImgError = '文件加載失敗(1)！['.$file['name'].']';
					break;
				default:
					$this -> ImgError = '文件加載失敗(2)！['.$file['name'].']';
					break;
			}
				
			return false;
		}
		
		if($file['size'] > $this -> def_set['file_size_max'])
		{
			$this -> ImgError = '對不起，你的容量大於規定！['.$file['name'].']';
			return false;
		}
		return true;
	}
	
	public function img_propor($src_w,$src_h)
	{
		//---- Upload image parameters (start) ----
		$thumb_w_p        = $this -> def_set['width'];
		$thumb_h_p        = $this -> def_set['height'];
		//---- Upload image parameters (end) ----
		
		$pic_propor = ($src_w / $src_h);
		$def_propor = ($thumb_w_p / $thumb_h_p);
		if($pic_propor > $def_propor)
		{
			if($src_w > $this -> def_set['width'])
			{
				$thumb_w_p = $this -> def_set['width'];
				$thumb_h_p = intval($src_h / $src_w * $this -> def_set['width']);
			}
			else
			{
				$thumb_w_p = $src_w;
				$thumb_h_p = $src_h;
			}
		}
		elseif($def_propor > $pic_propor)
		{
			if($src_h > $this -> def_set['height'])
			{
				$thumb_h_p = $this -> def_set['height'];
				$thumb_w_p = intval($src_w / $src_h * $this -> def_set['height']);
			}
			else
			{
				$thumb_w_p = $src_w;
				$thumb_h_p = $src_h;
			}
		}
		elseif($def_propor == $pic_propor)
		{
			if($src_h > $this -> def_set['height'])
			{
				$thumb_h_p = $this -> def_set['height'];
				$thumb_w_p = intval($src_w / $src_h * $this -> def_set['height']);
			}
			else
			{
				$thumb_w_p = $src_w;
				$thumb_h_p = $src_h;
			}
		}
		
		return array($thumb_w_p,$thumb_h_p);
	}
	
	//$file => $_FILES['file_name']
	function upload_img($file = '',$file_path = '',$file_name1 = null)
	{
		if($file == '' || $file_path == '')
		{
			$this -> ImgError = '對不起，呼叫有問題！ImgUpFile';
			return false;
		}
		
		if(!$this -> fileError($file))
		{
			return false;
		}
		
		//---- file parameters (start) ----
		$arr_img['tmp'] 		=  $file['tmp_name'];
		$arr_img['name'] 		=  $file['name'];
		$arr_img['size'] 		=  $file['size'];
		$arr_img['type'] 		=  $file['type'];
		$arr_img['error'] 		=  $file['error'];
		//---- file parameters (end) ----
		
		
		
		switch($arr_img['type'])
		{
			case 'image/jpeg':
				$pic_src 	= imagecreatefromjpeg($arr_img['tmp']);
				$hzm 		= 'jpg';
			break;
			case 'image/gif':
				$pic_src 	= imagecreatefromgif($arr_img['tmp']);
				$hzm 		= 'gif';
			break;
			case 'image/png':
				$pic_src 	= imagecreatefrompng($arr_img['tmp']);
				$hzm 		= 'png';
			break;
			default:
				$this -> ImgError = '檔案格式不符，僅可上傳(jpg、gif、png)！['.$arr_img['name'].']';
				return false;
			break;
		}
		
		if(!$pic_src)
		{
			$this -> ImgError = '上傳圖片失敗-非圖片檔案！['.$arr_img['name'].']';
			return false;
		}
		
		$src_w = imagesx($pic_src);
		$src_h = imagesy($pic_src);
		
		list($thumb_w_p,$thumb_h_p) = $this -> img_propor($src_w, $src_h);
		
		//$file_name = $this->upload_img($arr_img['upload_file_p_'.$i],$arr_img['upload_file_name_p_'.$i],$thumb_w_p,$thumb_h_p,'gb_pic_'.$arr_input['gb_oid'].'_'.date('YmdHis').'_'.$i,1);
		
		// 建立縮圖
		$thumb = imagecreatetruecolor($thumb_w_p, $thumb_h_p);
		
		// 開始縮圖
		$thumb_r = imagecopyresampled($thumb, $pic_src, 0, 0, 0, 0, $thumb_w_p, $thumb_h_p, $src_w, $src_h);
		
		if(!$thumb_r)
		{
			$this -> ImgError = '上傳圖片失敗-非圖片檔案-縮圖失敗！['.$arr_img['name'].']';
			return false;
		}
		
		//
		
		if($file_name1 == null)
		{
			$file_name = date('YmdHis').".".$hzm;
		}
		else 
		{
			$file_name = $file_name1.'.'.$hzm;
		}
		
		if($this -> def_set['overwrite'] == 0)
		{
			if(file_exists($file_path."/".$file_name))
			{
				$this -> ImgError = '上傳圖片失敗-檔案已存在！['.$file_path."/".$file_name.']';
				return false;
			}
		}
		
		if($hzm == 'jpg')
		{
			$upok = imagejpeg($thumb, $file_path."/".$file_name,100);
		}
		elseif($hzm == 'gif')
		{
			$upok = imagegif($thumb, $file_path."/".$file_name,100);
		}
		elseif($hzm == 'png')
		{
			$upok = imagepng($thumb, $file_path."/".$file_name,100);
		}
		else
		{
			$upok = move_uploaded_file($arr_img['tmp'],$file_path."/".$file_name);
		}
							
		if(!$upok)
		{
			$this -> ImgError = '上傳圖片失敗-權限問題！['.$file_path.']';
			return false;
		}
		return $file_name;
	}

	
	
}  
?>