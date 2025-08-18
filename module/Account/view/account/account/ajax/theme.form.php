<?php

use Account\Themes;
use Account\Users;

$userdetails = (new Users)->Details($_SESSION['AssignmentSession']['User'][0]['UserID'])[0];
$themelist = (new Themes)->All();
?>

<div class="row mb-3">
    <div class="col">
        <h4>Themes</h4>
    </div>
</div>
<form id="UpdateThemeForm" onsubmit="updateUser('UpdateThemeForm'); return false;">
    <input type="hidden" name="UserID" value="<?= $userdetails['UserID'] ?>"/>
    <div class="row ms-3 me-3">
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
    </div>
    <div class="row mb-3">
        <div class="col">
            <button type="submit" class="btn btn-primary float-end">Save Color</button>
        </div>
    </div>
</form>