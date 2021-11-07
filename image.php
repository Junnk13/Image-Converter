<?php

foreach ($_FILES["pictures"]['size'] as $key => $size) {
    if ($size >= 4194304) {
        header("Location:../?error=size");
        die();
    }
}

foreach ($_FILES["pictures"]["error"] as $key => $error) {
    if ($error == UPLOAD_ERR_OK) {
        $tmp_name = $_FILES["pictures"]["tmp_name"][$key];
        $name = basename($_FILES["pictures"]["name"][$key]);
        move_uploaded_file($tmp_name, "img/$name");
    } else {
        header("Location:../?error=load");
        die();
    }
}

$filename = "img/$name";
$info = getimagesize($filename);
$width = $info[0];
$height = $info[1];
$type = $info[2];

if ($type == 1) {
    $image = imageCreateFromGif($filename);
} elseif ($type == 2) {
    $image = imageCreateFromJpeg($filename);
} elseif ($type == 3) {
    $image = imageCreateFromPng($filename);
    imageSaveAlpha($image, true);
} else {
    header("Location:../?error=extension");
    die();
}

if (empty($_POST['Width'])) {
    header("Location:../?error=width");
    die();
}
if (empty($_POST['Height'])) {
    header("Location:../?error=height");
    die();
}

if ($_POST['Width'] >= 0)
    $userWidth = $_POST['Width'];
else {
    header("Location:../?error=width");
    die();
}
if ($_POST["Height"] >= 0)
    $userHeight = $_POST['Height'];
else {
    header("Location:../?error=height");
    die();
}

if ($userWidth == 0) {
    $userWidth = ceil($userHeight / ($height / $width));
}
if ($userHeight == 0) {
    $userHeight = ceil($userWidth / ($width / $height));
}

$newImage = imageCreateTrueColor($userWidth, $userHeight);
$imageColor = imagecolorallocatealpha($newImage, 255, 255, 255, 127);
imagefill($newImage, 0, 0, $imageColor);
imagecolortransparent($newImage, $imageColor);

$newWidth = ceil($userHeight / ($height / $width));
$newHeight = ceil($userWidth / ($width / $height));

if ($newWidth < $userWidth) {
    imageCopyResampled($newImage, $image, ceil(($userWidth - $newWidth) / 2), 0, 0, 0, $newWidth, $userHeight, $width, $height);
} else {
    imageCopyResampled($newImage, $image, 0, ceil(($userHeight - $newHeight) / 2), 0, 0, $userWidth, $newHeight, $width, $height);
}
if (isset($_POST["ext"])) {
    $answer = $_POST["ext"];
    if ($answer == 'png') {
        imagepng($newImage, "result/result.png");
        imagedestroy($newImage);
        header("Location:../?new-png");
    }
    if ($answer == 'jpg') {
        imagejpeg($newImage, "result/result.jpg");
        imagedestroy($newImage);
        header("Location:../?new-jpg");
    }
} else {
    header("Location:../?error=ext");
}





