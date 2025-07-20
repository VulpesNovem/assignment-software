<?php $courseid = $_GET['CourseID'];

$assignmenttypelist = (new \Assignments\Assignments())->GetAssignmentTypes(); ?>

<form id="AddAssignmentForm" onsubmit="updateAssignment('AddAssignmentForm'); return false;">

    <input type="hidden" name="CourseID" value="<?= $courseid; ?>">

    <div class="row mb-1">
        <div class="col-6"><label>Assignment Name</label></div>
        <div class="col-6"><input required class="form-control" type="text" maxlength="255" name="AssignmentName" placeholder="Assignment Name"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Assignment Type</label></div>
        <div class="col-6">
            <select required class="form-select" name="AssignmentTypeID">
                <option value="" selected>Select Assignment Type</option>
                <?php foreach ($assignmenttypelist as $assignmenttype) { ?>
                    <option value="<?= $assignmenttype['AssignmentTypeID']; ?>" ><?= $assignmenttype['AssignmentType']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Description</label></div>
        <div class="col-6"><input class="form-control" type="text" name="AssignmentDescription" placeholder="Description"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Location Link</label></div>
        <div class="col-6"><input class="form-control" type="url" name="SourceLink" placeholder="Link to Assignment"></div>
    </div>

    <div class="row mb-3">
        <div class="col-6"><label>Due Date</label></div>
        <div class="col-6"><input required class="form-control" type="datetime-local" name="DueDate"></div>
    </div>

    <div class="row mb-1">
        <div class="col-auto mx-auto">
            <button type="submit" class="btn btn-primary" onclick="$(this).hide()"><i class="bi bi-plus"></i> Assignment</button>
        </div>
    </div>
</form>
