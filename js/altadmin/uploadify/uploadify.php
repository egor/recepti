<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder = '/images/banners/'.$_POST['folder']; // Relative to the root

$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$v = new TestUp;
$v->upload();
if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
    
        $banners = new Banners;
        $banners->pid = 0;
        $banners->name='test.jpg';
        $banners->position = 0;
        $banners->module = 'test';//$module;
        $banners->visibility = 1;
        $banners->save();
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}

class TestUp extends Controller {
    public function upload() {
        $test = new Test;
        //$targetFolder = '/images/banners/news'; // Relative to the root
        $test->text = '1';//$_POST['timestamp'];
        $test->save();
        exit;
    }
}
?>