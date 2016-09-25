<?php
	if(isset($_FILES["fileToUpload"])){
		$target_dir = ROOT_PATH.DS."img".DS;
		$file = $_FILES["fileToUpload"];
		$timpestamp = date('dhis-',time());
		$target_file = $target_dir.$timpestamp . basename($file["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) {
			$check = getimagesize($file["tmp_name"]);
			if($check !== false) {
				echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} else {
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		// Check if file already exists
		if (file_exists($target_file)) {
			echo "Sorry, file already exists.";
			$uploadOk = 0;
		}
		// Check file size
		if ($file["size"] > 500000) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
		// Allow certain file formats
		if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
			echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
			$uploadOk = 0;
		}
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($file["tmp_name"], $target_file)) {
				echo "The file ". $timpestamp.basename( $file["name"]). " has been uploaded.";
				$data = json_encode(array(
					'type'=>$_POST['type'],
					'file'=>$timpestamp.basename( $file["name"])
				));
				
				?>
				<script type="text/javascript"> 
				opener.postMessage(<?php echo $data;?>,window.location.origin);
				window.close();
				</script>
		<?php
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
		exit;
	}
?>
<form action="uploader" method="post" enctype="multipart/form-data">
    Select image to upload:
	<?php if(isset($_GET['type'])):?>
    <input type="hidden" name="type" id="type" value="<?php echo $_GET['type']; ?>">
	<?php endif; ?>
    <input type="file" name="fileToUpload" id="file">
    <input type="submit" value="Upload Image" name="submit">
</form>
