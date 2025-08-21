<?php use Account\Users;

$userdetails = (new Users)->Details($_SESSION['AssignmentSession']['User'][0]['UserID'])[0]; ?>

<div class="row mb-3">
    <div class="col">
        <h4>Account Details</h4>
    </div>
</div>
<div class="row ms-3 me-3">
    <div class="col-6 d-flex justify-content-center align-items-center">
        <img class="profile-page-icon my-1" src="img/usericons/placeholder/person-circle.svg">
    </div>
    <div class="col-6 align-content-center">
        <h1 class="mb-2"><span style="font-weight: normal">Display Name:</span> <?= $userdetails['DisplayName'] ?></h1>
        <h5 class="mb-2"><span style="font-weight: normal">Name:</span> <?= $userdetails['FirstName'].' '.$userdetails['LastName'] ?></h5>
        Email: <b><?= $userdetails['Email'] ?></b>
    </div>
</div>