<?php
die('Upload');

if (!empty($_FILES['ProfilePicture']['name']) && !empty($_POST['UserID'])) {
    $userId = preg_replace("/[^a-zA-Z0-9_-]/", "", $_POST['UserID']);

    if (!is_dir('img/usericons/'.$userId)) {
        mkdir('img/usericons/'.$userId, 0755, true);
    }

    $targetpath = 'img/usericons/'.$userId.'/'.$userId.'profile.png';
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
