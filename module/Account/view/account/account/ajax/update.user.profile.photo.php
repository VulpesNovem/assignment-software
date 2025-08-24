<?php
//die(print_r($_FILES));
//die(print_r($_GET['UserID']));

if (!empty($_FILES['ProfilePicture']) && !empty($_GET['UserID'])) {
//    (print_r($_FILES));
//    die(print_r($_GET['UserID']));

    $userId = preg_replace("/[^a-zA-Z0-9_-]/", "", $_GET['UserID']);

    if (!is_dir($_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userId)) {
        mkdir($_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userId, 0755, true);
    }

    $targetpath = $_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userId.'/'.$userId.'profile.png';
    $imagestring = imagecreatefromstring(file_get_contents($_FILES['ProfilePicture']['tmp_name']));

    if ($imagestring === false) {
        die("Invalid image file upload.");
    }

    if ($_FILES['ProfilePicture']['size'] > 2 * 1024 * 1024) {
        die("File too large (max 2MB).");
    }

    if (!imagepng($imagestring, $targetpath)) {
        die("Failed to save PNG file.");
    }

    imagedestroy($imagestring);

    die("Profile picture uploaded and saved as PNG at $targetpath");
}
