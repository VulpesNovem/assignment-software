<?php $userdetails = (new Account\Users)->Details($_SESSION['AssignmentSession']['User'][0]['UserID'])[0]; ?>

<form id="AccountDetailsForm" onsubmit="updateUserProfilePhoto('AccountDetailsForm', <?= $userdetails['UserID'] ?>); updateUser('AccountDetailsForm'); return false;" method="post"
      action="<?=$_SERVER['REQUEST_URI']?>"
      enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-auto me-auto">
            <h4>Account Details</h4>
        </div>
        <div class="col-auto ms-auto align-content-center">
            <span class="fs-5 fw-lighter clickable" type="reset" onclick="$('#accountDetailsView').toggle(); $('#accountDetailsEdit').toggle(); $('#AccountDetailsForm').trigger('reset');"><i class="bi bi-pencil-square"></i></span>
        </div>
    </div>

    <div class="row mx-3 py-3" id="accountDetailsView">
        <div class="col-3 text-center">
            <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userdetails['UserID'].'/'.$userdetails['UserID'].'profile.png')) { ?>
            <div class="profile-page-icon my-1 mx-auto" style="border: 1px solid var(--primary-text);">
                <img src="/img/usericons/<?= $userdetails['UserID'].'/'.$userdetails['UserID'] ?>profile.png" style="height: 150px;">
            </div>
            <?php } else { ?>
                <i class="profile-page-icon bi bi-person-circle"></i>
            <?php } ?>
        </div>
        <div class="col-6 align-content-center">
            <h1 class="mb-2"><?= $userdetails['DisplayName'] ?></h1>
            <h5 class="mb-2"><?= $userdetails['FirstName'].' '.$userdetails['LastName'] ?></h5>
            <b><?= $userdetails['Email'] ?></b>
        </div>
        <h5 class="col-3 text-center align-content-center">
            <span class="fw-normal">Connections</span>
            <br>
            0
        </h5>
    </div>

    <div class="row mx-3 py-3" id="accountDetailsEdit" style="display: none">
        <input type="hidden" name="UserID" value="<?= $userdetails['UserID'] ?>">
        <div class="col-3 justify-content-center align-items-center">
            <div class="row mb-2">
                <div class="col text-center">
                    <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/public/img/usericons/'.$userdetails['UserID'].'/'.$userdetails['UserID'].'profile.png')) { ?>
                        <div class="profile-page-edit-icon my-1 mx-auto" style="border: 1px solid var(--primary-text);">
                            <img src="/img/usericons/<?= $userdetails['UserID'].'/'.$userdetails['UserID'] ?>profile.png" style="height: 100px;">
                        </div>
                    <?php } else { ?>
                        <i class="profile-page-edit-icon bi bi-person-circle m-0"></i>
                    <?php } ?>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="file" class="form-control" name="ProfilePicture" id="ProfilePictureUpload" accept="image/*">
                </div>
            </div>
        </div>
        <div class="col-6 align-content-center">
            <div class="row mb-2">
                <div class="col">
                    <input type="text" class="form-control" name="DisplayName" placeholder="Display Name" value="<?= $userdetails['DisplayName'] ?>">
                </div>
            </div>
            <div class="row mb-2">
                <div class="col me-1">
                    <input type="text" class="form-control" name="FirstName" placeholder="First Name" value="<?= $userdetails['FirstName'] ?>">
                </div>
                <div class="col ms-1">
                    <input type="text" class="form-control" name="LastName" placeholder="Last Name" value="<?= $userdetails['LastName'] ?>">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <input type="email" class="form-control" name="Email" placeholder="Email" value="<?= $userdetails['Email'] ?>">
                </div>
            </div>
        </div>
        <h5 class="col-3 text-center align-content-center">
            <span style="font-weight: normal">Connections</span>
            <br>
            0
        </h5>

        <div class="col-auto mx-auto mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save Changes</button>
        </div>
    </div>
</form>