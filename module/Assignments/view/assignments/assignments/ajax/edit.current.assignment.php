<?php $assignmentid = $_GET['AssignmentID'];
$assignmentdetails = (new \Assignments\Assignments)->getDetails($assignmentid)[0];
$assignmenttypelist = (new \Assignments\Assignments)->GetAssignmentTypes(); ?>

<form id="EditAssignmentForm" onsubmit="updateAssignment('EditAssignmentForm'); return false;">

    <input type="hidden" name="AssignmentID" value="<?= $assignmentid; ?>">

    <div class="row mb-1">
        <div class="col-6"><label>Assignment Name</label></div>
        <div class="col-6"><input required class="form-control" type="text" maxlength="255" name="AssignmentName" placeholder="Assignment Name" value="<?= $assignmentdetails['AssignmentName'] ?>"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Assignment Type</label></div>
        <div class="col-6">
            <select required class="form-select" name="AssignmentTypeID">
                <?php foreach ($assignmenttypelist as $assignmenttype) { ?>
                    <option value="<?= $assignmenttype['AssignmentTypeID']; ?>" <?= $assignmenttype['AssignmentTypeID'] == $assignmentdetails['AssignmentTypeID'] ? 'selected' : '' ?>><?= $assignmenttype['AssignmentType']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Description</label></div>
        <div class="col-6"><input class="form-control" type="text" name="AssignmentDescription" placeholder="Description" value="<?= $assignmentdetails['AssignmentDescription'] ?>"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Location Link</label></div>
        <div class="col-6"><input class="form-control" type="url" name="SourceLink" placeholder="Link to Assignment" value="<?= $assignmentdetails['SourceLink'] ?>"></div>
    </div>

    <div class="row mb-3">
        <div class="col-6"><label>Due Date</label></div>
        <div class="col-6"><input required class="form-control" type="datetime-local" name="DueDate" value="<?= $assignmentdetails['DueDate'] ?>"></div>
    </div>

    <div class="row mb-1">
        <div class="col-auto mx-auto">
            <button type="submit" class="btn btn-primary" onclick="$(this).hide()"><i class="bi bi-save"></i> Assignment</button>
        </div>
    </div>
</form>
