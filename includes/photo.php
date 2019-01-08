<?

function product_photo_upload($user_id, $photo_file, $photo_tags, $inuse, $product_id = null, $phototype = null)
{
	//testing file status
	$file_error = $photo_file['error'];
	if ($file_error > 0)
	{
		echo 'Error! ', $file_error ;
		switch ($file_error)
		{
			case 1: echo '<p class="errorMsg">File exceeded uploading maximum file size ( > 20MB).<br />'; break;
			case 2: echo '<p class="errorMsg">File exceeded server maximum file size.<br />'; break;
			case 3: echo '<p class="errorMsg">File only partially uploaded.<br />'; break;
			case 4: echo '<p class="errorMsg">File not uploaded.<br />'; break;
		}
		exit();
	}

	// setup variables
	set_time_limit(360); // upload process time limit 6 minutes
	$folder_path = 'product_photo/';
	$count = 1;
	$dup = 1;
	$percent = 0.5;
	$thumb_height = 150;
	$thumb_width = 100;
	$mob_height = 50;
	$mob_width = 50;
	$img_fol =   $folder_path . '';
	$thm_fol = $img_fol . 'thumb/';
	$work_fol = $img_fol . 'working/';
	$zoom_fol = $img_fol . 'zoom/';
	$mob_fol = $img_fol . 'mob/';
	//echo $img_fol;
	// Assign name for files
	$tmp_name = $photo_file['tmp_name'];
	$original_name = $photo_file['name'];
	$new_name = $original_name;
	$new_name = ereg_replace( ' +', '', $new_name);
	// testing extensions
	$extension = substr($new_name, strrpos($new_name,".") + 1);
	$extension = strtolower($extension);

	if ($extension == 'jpeg' || $extension == 'jpg' || $extension == 'gif' || $extension == 'png') {
		// generate new file name
		$alphanum = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$rand = substr(str_shuffle($alphanum), 0, 5);
		//$rand = strtolower($rand);
		$datename = date("ymd");
		$new_name = 'img' . $user_id .'_'. $rand . '_'.$datename . '.' . $extension;

		// check duplications and rename it
		while (file_exists($img_fol . $new_name)) {
			$new_name = $dup . '_' . $new_name;
			$dup++;
		}
	}

		//uploading original file
		//echo $tmp_name, $img_fol . $new_name;
		move_uploaded_file($tmp_name, $img_fol . $new_name);



	// once file uploaded succesfully, get new dimensions
		$filename = $img_fol . $new_name;
		list($width, $height, $type, $attr) = getimagesize($filename);
		// new zoom image dimension
		if ($width > 900) {
			$o_width = 900; // 100 X 80, 
			$propotions = $width / $o_width; // 900 = 900 / 100 = 9X
			$o_height = $height / $propotions; // 80 HEIGHT, 80 x 9 = 720
		} else {
			//1024 x 768
			$o_width = $width; //1024
			$o_height = $height; //768
		}
		// new working image dimension
		if ($width > 600) {
			$new_width = 600;
			$propotions = $width / $new_width;
			$new_height = $height / $propotions;
		} else {
			$new_width = $width;
			$new_height = $height;
		}

		if ($width > $height) {
			// new thumbnail dimension
			$new_width_t = 300;
			$propotions_t = $width / $new_width_t;
			$new_height_t = $height / $propotions_t;
			// new mobile thumbnail dimension
			$new_width_m = 150;
			$propotions_m = $width / $new_width_m;
			$new_height_m = $height / $propotions_m;
		} else {
			// new thumbnail dimension
			$new_height_t = 300;
			$propotions_t = $height / $new_height_t;
			$new_width_t = $width / $propotions_t;
			// new mobile thumbnail dimension
			$new_height_m = 150;
			$propotions_m = $height / $new_height_m;
			$new_width_m = $width / $propotions_m;
		}

		$get_ext = image_type_to_extension($type);
		// Resampling image
		$image_o = imagecreatetruecolor($o_width, $o_height); // zoom
		$image_p = imagecreatetruecolor($new_width, $new_height); // working
		$image_t = imagecreatetruecolor($new_width_t, $new_height_t); // thumbnail
		$image_m = imagecreatetruecolor($new_width_m, $new_height_m); // mobile thumbnail
		switch ($get_ext)
		{
			case '.jpeg': $image = imagecreatefromjpeg($filename); break;
			case '.jpg': $image = imagecreatefromjpeg($filename); break;
			case '.gif': $image = imagecreatefromgif($filename); break;
			case '.png': $image = imagecreatefrompng($filename); break;
			default: return false; break;
		}

    //generate watermark

		$blue = imagecolorallocate($image, 0, 0, 255);
		$grey = imagecolorallocate($image, 128, 128, 128);
		$text = "boyd eshop";
		$font = 'verdana.ttf';
		imagettftext($image, 11, 0, 6, 21, $grey, $font, $text);
		imagettftext($image, 10, 0, 5, 20, $blue, $font, $text);


		imagecopyresampled($image_o, $image, 0, 0, 0, 0, $o_width, $o_height, $width, $height);
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		imagecopyresampled($image_t, $image, 0, 0, 0, 0, $new_width_t, $new_height_t, $width, $height);
		imagecopyresampled($image_m, $image, 0, 0, 0, 0, $new_width_m, $new_height_m, $width, $height);
		switch ($get_ext)
		{
			case '.jpeg':
				imagejpeg($image_o, $zoom_fol . $new_name, 80);
				imagejpeg($image_p, $work_fol . $new_name, 80);
				imagejpeg($image_t, $thm_fol . $new_name, 80);
				imagejpeg($image_m, $mob_fol . $new_name, 80);
				break;
			case '.jpg':
				imagejpeg($image_o, $zoom_fol . $new_name, 80);
				imagejpeg($image_p, $work_fol . $new_name, 80);
				imagejpeg($image_t, $thm_fol . $new_name, 80);
				imagejpeg($image_m, $mob_fol . $new_name, 80);
				break;
			case '.gif':
				imagegif($image_o, $zoom_fol . $new_name, 80);
				imagegif($image_p, $work_fol . $new_name, 80);
				imagegif($image_t, $thm_fol . $new_name, 80);
				imagegif($image_m, $mob_fol . $new_name, 80);
				break;
			case '.png':
				imagepng($image_o, $zoom_fol . $new_name, 8);
				imagepng($image_p, $work_fol . $new_name, 8);
				imagepng($image_t, $thm_fol . $new_name, 8);
				imagepng($image_m, $mob_fol . $new_name, 8);
				break;
			default: return false; break;
		}

		$user_photo_sub_folder = SITEURL . $folder_path . '/thumbs/';
		$data = $user_photo_sub_folder . $new_name;
		//write photo into database
		$photo_original_file_name = $original_name;
		$photo_file_name = $new_name;
		$photo_url = SITEURL . $folder_path . '/';
		$photo_width = $width;
		$photo_height = $height;
		$photo_uploaded_on = date('Y-m-d H:i:s');
		$photo_tags = strtolower($photo_tags);

		$query = "INSERT INTO product_photo (user_id, original_file_name, photo_file_name, photo_url, photo_width, photo_height, photo_tags, created_on, inuse) VALUES (:user_id, :photo_original_file_name, :photo_file_name, :photo_url, :photo_width, :photo_height, :photo_tags, :photo_uploaded_on, :inuse)";

		$query = $this->db->prepare($query);
		
		$query->bindParam("user_id", $user_id, PDO::PARAM_INT);
		$query->bindParam("photo_original_file_name", $photo_original_file_name, PDO::PARAM_STR);
		$query->bindParam("photo_file_name", $photo_file_name, PDO::PARAM_STR);
		$query->bindParam("photo_url", $photo_url, PDO::PARAM_STR);
		$query->bindParam("photo_width", $photo_width, PDO::PARAM_STR);
		$query->bindParam("photo_height", $photo_height, PDO::PARAM_STR);
		$query->bindParam("photo_tags", $photo_tags, PDO::PARAM_STR);
		$query->bindParam("photo_uploaded_on", $photo_uploaded_on, PDO::PARAM_STR);
		$query->bindParam("inuse", $inuse, PDO::PARAM_STR);
		$query->execute();


		$photo_id = $this->db->lastInsertId();
		$_SESSION['photo_id_up'] = $photo_id;
		$latest_photo_id = $_SESSION['photo_id_up'];

		$fh = fopen($filename, 'w'); // or die("can't open file");
		fclose($fh);
		unlink($filename);
		imagedestroy($image);
		//echo '<p class="errorMsg"> "', $new_name, '" - file format is currently not supported.</p>';
}


?>
