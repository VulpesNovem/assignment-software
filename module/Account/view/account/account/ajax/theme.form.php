<?php $userdetails = (new Account\Users)->Details($_SESSION['AssignmentSession']['User'][0]['UserID'])[0];
$themelist = (new Account\Themes)->All(); ?>

<form id="UpdateThemeForm" onsubmit="updateUser('UpdateThemeForm'); return false;">
    <div class="row mb-3">
        <div class="col">
            <h4>Themes</h4>
        </div>
        <div class="col-auto ms-auto align-content-center">
            <span class="fs-5 fw-lighter clickable" type="reset" onclick="$('#themeDetailsView').toggle(); $('#themeDetailsEdit').toggle(); $('#UpdateThemeForm').trigger('reset');"><i class="bi bi-pencil-square"></i></span>
        </div>
    </div>

    <div class="row ms-3 me-3" id="themeDetailsView">
        <h6 class="col-auto align-content-center">Current Theme:</h6><h6 class="col-auto card-header align-content-center"><?= ((new Account\Themes)->Details($userdetails['ThemeID']))[0]['ThemeName'] ?></h6>
    </div>

    <div class="row ms-3 me-3" id="themeDetailsEdit" style="display: none;">
        <input type="hidden" name="UserID" value="<?= $userdetails['UserID'] ?>"/>
        <?php foreach ($themelist as $theme) { ?>
            <div class="col-xl-3 col-md-4 col-sm-6 mb-3">
                <div class="card" style="background-color: #<?= $theme['PrimaryColor'] ?>; border: #<?= $theme['PrimaryTextColor'] ?> solid 1px;">
                    <div class="card-header" style="background-color: #<?= $theme['SecondaryColor'] ?>;">
                        <div class="form-check">
                            <input class="form-check-input" name="ThemeID" id="radio<?= $theme['ThemeID'] ?>" type="radio" value="<?= $theme['ThemeID'] ?>" <?= $theme['ThemeID'] == $userdetails['ThemeID'] ? 'checked' : '' ?>>
                            <label class="form-check-label" for="radio<?= $theme['ThemeID'] ?>">
                                <?= $theme['ThemeName'] ?>
                            </label>
                        </div>
                    </div>
                    <div class="card-body" style="color: #<?= $theme['PrimaryTextColor'] ?>;">
                        Example Card
                        <br>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-auto mx-auto mt-3">
            <button type="submit" class="btn btn-primary"><i class="bi bi-floppy-fill"></i> Save Changes</button>
        </div>
    </div>
</form>