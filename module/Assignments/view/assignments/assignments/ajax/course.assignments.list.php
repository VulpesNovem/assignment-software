<?php $coursedetails = $this->coursedetails;
$upcomingassignmentslist = (new \Assignments\Assignments)->GetUpcomingByCourseID($coursedetails[0]['CourseID']);
$pastassignmentslist = (new \Assignments\Assignments)->GetPastByCourseID($coursedetails[0]['CourseID']);

foreach ($upcomingassignmentslist as $upcomingassignment) {
    $date = date('m/d/Y', strtotime($upcomingassignment['DueDate']));
    if (!isset($groupedupcomingassignments[$date])) {
        $groupedupcomingassignments[$date] = [];
    }
    $groupedupcomingassignments[$date][] = $upcomingassignment;
}?>

<div class="card mb-4">
    <div class="card-header clickable" id="upcomingAssignmentsHead">
        <div class="row m-0 p-0" onclick="$('#upcomingAssignments').slideToggle(); $('#upcomingArrowTurn').toggleClass('bi-caret-down-fill bi-caret-right-fill'); $('#upcomingAssignmentsHead').toggleClass('rounded');">
            <i class="bi bi-caret-down-fill col-auto m-0 p-0 align-content-center" id="upcomingArrowTurn"></i><h5 class="col-auto m-2 p-0"> Upcoming Assignments</h5>
        </div>
    </div>
    <div id="upcomingAssignments">
        <?php if (!empty($groupedupcomingassignments)) {
            foreach ($groupedupcomingassignments as $date => $assignments) {?>
                <div class="card-body p-2 assignment_date_row" style="background-color: var(--primary-light);">
                    <div class="card-body row m-0 p-0">
                        <h5 class="col-auto m-1 me-auto p-1"><b><?= $date; ?></b></h5>
                        <div class="col-auto m-1 ms-auto p-1"><?php if (strtotime($date) <= strtotime('+7 days')) { echo '<i class="bi bi-exclamation-triangle-fill" style="color: red"></i>'; } ?></div>
                    </div>
                </div>
                <?php foreach ($assignments as $assignment) { ?>
                    <a href="/assignments/details/<?= $assignment['AssignmentID'] ?>">
                        <div class="card-body row m-0 p-0 assignment_name_row">
                            <div class="col-auto m-0 p-0" style="width: 10px; background-color: #<?= $assignment['CardColor'] ?>"></div>
                            <div class="col-auto px-auto align-content-center" style="background-color: var(--primary-dark);"><i class="bi <?= $assignment['Icon'] ?>"></i></div>
                            <h5 class="col-auto m-2 me-auto p-1 "><?= $assignment['AssignmentName']; ?></h5>
                            <label class="col-auto m-2 ms-auto p-1"><?php if ($assignment['Complete'] != 1) { echo date('H:i', strtotime($assignment['DueDate'])); }?></label>
                            <input class="col-auto m-2 p-1 custom-checkbox" id="completionCheckbox<?= $assignment['AssignmentID'] ?>" name="Complete" type="checkbox" <?php if ($assignment['Complete'] == 1) { echo 'checked'; } ?> onchange="updateAssignmentCompletion(<?= $assignment['AssignmentID'] ?>, '#completionCheckbox<?= $assignment['AssignmentID'] ?>')">
                        </div>
                    </a>
                <?php }
            }
        } else {
            echo '<div class="card-body row m-0 p-0"><h5 class="col-auto m-2 p-2">No Upcoming Assignments</h5></div>';
        } ?>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header rounded clickable" id="pastAssignmentsHead">
        <div class="row m-0 p-0" onclick="$('#pastAssignments').slideToggle(); $('#arrowTurn').toggleClass('bi-caret-down-fill bi-caret-right-fill'); $('#pastAssignmentsHead').toggleClass('rounded');">
            <i class="bi bi-caret-right-fill col-auto m-0 p-0 align-content-center" id="arrowTurn"></i><h5 class="col-auto m-2 p-0"> Past Assignments</h5>
        </div>
    </div>
    <div id="pastAssignments" style="display: none;">
        <?php if (!empty($pastassignmentslist)) {
            foreach ($pastassignmentslist as $assignment) { ?>
                <a href="/assignments/details/<?= $assignment['AssignmentID'] ?>">
                    <div class="card-body row m-0 p-0 assignment_name_row">
                        <div class="col-auto m-0 p-0" style="width: 10px; background-color: #<?= $assignment['CardColor'] ?>"></div>
                        <div class="col-auto px-auto align-content-center" style="background-color: var(--primary-dark);"><i class="bi <?= $assignment['Icon'] ?>"></i></div>
                        <h5 class="col-auto m-2 me-auto p-1 "><?= $assignment['AssignmentName']; ?></h5>
                        <label class="col-auto m-2 ms-auto p-1"></label>
                        <div class="col-auto m-2 ms-auto p-1"><?php if ($assignment['Complete'] == 0) { echo '<i class="bi bi-exclamation-triangle-fill" style="color: red"></i>'; } ?></div>
                        <input class="col-auto m-2 p-1 custom-checkbox" id="completionCheckbox<?= $assignment['AssignmentID'] ?>" name="Complete" type="checkbox" <?php if ($assignment['Complete'] == 1) { echo 'checked'; } ?> onchange="updateAssignmentCompletion(<?= $assignment['AssignmentID'] ?>, '#completionCheckbox<?= $assignment['AssignmentID'] ?>')">
                    </div>
                </a>
            <?php }
        } else {
            echo '<div class="card-body row m-0 p-0"><h5 class="col-auto m-2 p-2">No Past Assignments</h5></div>';
        } ?>
    </div>
</div>