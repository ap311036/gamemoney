<?php
        //var_dump($_FILES);
		echo 'fileUpload file name = '. $_FILES['fileUpload']['name']. " , temp name = ".  $_FILES['fileUpload']['temp_name'] . " , fileName=" . $_POST['fileName'];


		if($_FILES[$name]["error"]>0)
			{
				//echo "Error" . $_FILES[$name]["error"];
				
				switch ( $_FILES [ $field ][ 'error' ]){  
					 case 1:  
						 // 檔案大小超出了伺服器上傳限制 UPLOAD_ERR_INI_SIZE  
						 $this ->setError( "The file is too large (server)." );  
						 break ;  
					
					 case 2:  
						 // 要上傳的檔案大小超出瀏覽器限制 UPLOAD_ERR_FORM_SIZE  
						 $this ->setError( "The file is too large (form)." );  
						 break ;  
					
					 case 3:  
						 //檔案僅部分被上傳 UPLOAD_ERR_PARTIAL  
						 $this ->setError( "The file was only partially uploaded." );  
						 break ;  
					
					 case 4:  
						 //沒有找到要上傳的檔案 UPLOAD_ERR_NO_FILE  
						 $this ->setError( "No file was uploaded." );  
						 break ;  
					
					 case 5:  
						 //伺服器臨時檔案遺失    
						 $this ->setError( "The servers temporary folder is missing." );  
						 break ;  
					
					 case 6:  
						 //檔案寫入到站存資料夾錯誤 UPLOAD_ERR_NO_TMP_DIR  
						 $this ->setError( "Failed to write to the temporary folder." );  
						 break ;  
				  
					 case 7:  
						 //無法寫入硬碟 UPLOAD_ERR_CANT_WRITE  
						 $this ->setError( "Failed to write file to disk." );  
						 break ;  
				  
				  
					 case 8:  
						 //UPLOAD_ERR_EXTENSION  
						 $this ->setError( "File upload stopped by extension." );  
						 break ;  
				}  
				
			}
			else
			{
				//echo "Name:" . $_FILES[$name]["name"] . "<br>";
				//echo "Type:" . $_FILES[$name]["type"] . "<br>";
				//echo "Size:" . $_FILES[$name]["size"] . "<br>";
				//echo "Temp Name:" . $_FILES[$name]["tmp_name"] . "<br>";
				
				if(file_exists("upload/" . $_FILES[$name]["name"]))
				{
					//Alert( "Have the same file name.");
				}
				else
				{
					move_uploaded_file($_FILES[$name]["tmp_name"],"upload/". $_FILES[$name]["name"] );
					//Alert( "Upload successed!.");
				}
				
				
			}



?>