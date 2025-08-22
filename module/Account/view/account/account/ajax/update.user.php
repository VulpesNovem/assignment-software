<?php (new Account\Users)->Input($_POST);

if (!empty($_POST['ProfilePicture'] && !empty($_POST['UserID']))) {
    if (!is_dir('img/usericons/'.$_POST['UserID'])) {
        mkdir('img/usericons/'.$_POST['UserID']);
    }
//    if (file_exists('img/usericons/'.$_POST['UserID'].'/'.$_POST['UserID'].'profile.png')) {
//        unlink('img/usericons/'.$_POST['UserID'].'/'.$_POST['UserID'].'profile.png');
//    }
    move_uploaded_file()

}