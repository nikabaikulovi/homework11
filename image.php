<?php
session_start();
$userdir = $_SESSION["Username"];
$target_dir = "images/";
if (!mkdir($currentdir = $target_dir . $userdir) && !is_dir($currentdir)){
    throw new \RuntimeExeption(sprintf('Directory  was not created',$currentdir));
}
$target_file = $target_dir . $userdir . '/' . basename($_FILES["image"]["name"]);
$uploaded = 1;
$imageFileType = $_FILES["image"]["type"];
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if($check !== false) {
        echo "File is image - " . $check["mime"] . ".";
        $uploaded = 1;
    } else {
        echo "File is not image.";
        $uploaded = 0;}
}
if ($_FILES["image"]["size"] > 500000) {
    echo "file fize is too large";
    $uploaded = 0;
}
if($imageFileType !== 'image/jpeg') {
    echo "only jpg,jpeg,png acctenshion alowed.";
    $uploaded = 0;
}
if ($uploaded == 0) {
    echo "file was not uploaded";
} else {
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $_SESSION['img']=$target_file;
        header("Location: singin.php");
    } else {
        echo "file was not uploaded";
    }
}
?>