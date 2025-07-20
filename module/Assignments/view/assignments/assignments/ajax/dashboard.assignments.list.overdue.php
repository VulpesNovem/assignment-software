<?php $coursedetails = $this->coursedetails;
$overdueassignmentslist = (new \Assignments\Assignments)->GetOverdue(); ?>


<div class="card mb-4">
    <div class="card-header">
        <h5>Overdue Assignments</h5>
    </div>
    <?php foreach ($overdueassignmentslist as $assignment) { ?>
        <a href="/assignments/details/<?= $assignment['AssignmentID'] ?>">
            <div class="card-body row m-0 p-0 assignment_name_row">
                <div class="col-auto m-0 p-0" style="width: 10px; background-color: #<?= $assignment['CardColor'] ?>"></div>
                <div class="col-auto px-auto align-content-center" style="background-color: var(--primary-dark);"><i class="bi <?= $assignment['Icon'] ?>"></i></div>
                <h5 class="col-auto m-2 me-auto p-1 "><?= $assignment['AssignmentName']; ?></h5>
                <label class="col-auto m-2 ms-auto p-1"></label>
                <input class="col-auto m-2 p-1 custom-checkbox" id="completionCheckbox<?= $assignment['AssignmentID'] ?>" name="Complete" type="checkbox" <?php if ($assignment['Complete'] == 1) { echo 'checked'; } ?> onchange="updateAssignmentCompletion(<?= $assignment['AssignmentID'] ?>, '#completionCheckbox<?= $assignment['AssignmentID'] ?>')">
            </div>
        </a>
    <?php } ?>
</div>