<?php

require_once('../libs/database.class.php');
require_once('../libs/utility.class.php');

$db = new Database();
$util = new Utility();

if (isset($_FILES["file"]["type"])) {
    $validextensions = array("jpeg", "jpg", "png");
    $temporary = explode(".", $_FILES["file"]["name"]);
    $file_extension = end($temporary);

    if ((($_FILES["file"]["type"] == "image/png") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/jpeg")) && ($_FILES["file"]["size"] < 9000000) && in_array($file_extension, $validextensions)) {
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
        } else {
            if (file_exists("../image/slider/" . $_FILES["file"]["name"])) {
                echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
            } else {
                $default_state = "NA";
                $sourcePath = trim($_FILES['file']['tmp_name']);
                $targetPath = "../image/slider/" . trim($_FILES['file']['name']);
                //$targetPathURL = "www.maufutsal.com/newadmin/image/slider/".$_FILES['file']['name'];
                $targetPathURL = "../image/slider/" . trim($_FILES['file']['name']);

                move_uploaded_file($sourcePath, $targetPath);

                // echo "<span id='success'>Image Uploaded Successfully...!!</span><br/>";
                // echo "<br/><b>File Name:</b> " . $_FILES["file"]["name"] . "<br>";
                // echo "<b>Type:</b> " . $_FILES["file"]["type"] . "<br>";
                // echo "<b>Size:</b> " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
                // echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";

                $query = "INSERT INTO tbl_slider(path, state) VALUES(?,?)";
                $result_insert_pict = $db->insertValue($query, [$_FILES["file"]["name"], $default_state]);

                if ($result_insert_pict) {
                    echo "success";
                } else {
                    echo "gagal";
                }
            }
        }
    } else {
        echo "<span id='invalid'>***Invalid file Size or Type***<span>";
    }
}
?>
