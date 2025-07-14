<?php Use Assignments\Assignments;

$coursedetails = $this->coursedetails;
$upcomingassignmentslist = (new Assignments)->getUpcomingByCourseID($coursedetails[0]['CourseID']);
$pastassignmentslist = (new Assignments)->getPastByCourseID($coursedetails[0]['CourseID']);

foreach ($upcomingassignmentslist as $upcomingassignment) {
    $date = date('m/d/Y', strtotime($upcomingassignment['DueDate']));
    if (!isset($groupedupcomingassignments[$date])) {
        $groupedupcomingassignments[$date] = [];
    }
    $groupedupcomingassignments[$date][] = $upcomingassignment;
}?>

<div class="card mb-4">
    <div class="card-header rounded" id="upcomingAssignmentsHead">
        <div class="row m-0 p-0" onclick="$('#upcomingAssignments').slideToggle(); $('#upcomingArrowTurn').toggleClass('bi-caret-down-fill'); $('#upcomingArrowTurn').toggleClass('bi-caret-right-fill'); $('#upcomingAssignmentsHead').toggleClass('rounded');">
            <i class="bi bi-caret-right-fill col-auto m-0 p-0 align-content-center" id="upcomingArrowTurn"></i><h5 class="col-auto m-2 p-0"> Upcoming Assignments</h5>
        </div>
    </div>
    <div id="upcomingAssignments" style="display: none;">
        <?php foreach ($groupedupcomingassignments as $date => $assignments) {?>
            <div class="card-body p-2 assignment_date_row" style="background-color: var(--primary-light);">
                <h5 class="m-1"><b><?= $date; ?></b></h5>
            </div>
            <?php foreach ($assignments as $assignment) { ?>
                <div class="card-body row m-0 p-0 assignment_name_row">
                    <div class="col-auto px-auto align-content-center" style="background-color: var(--primary-dark);"><i class="bi bi-archive-fill"></i></div>
                    <h5 class="col-auto m-2 me-auto p-1 "><?= $assignment['AssignmentName']; ?></h5>
                    <label class="col-auto m-2 ms-auto p-1"><?= date('H:i', strtotime($assignment['DueDate'])); ?></label>
                </div>
            <?php } ?>
        <?php } ?>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header rounded" id="pastAssignmentsHead">
        <div class="row m-0 p-0" onclick="$('#pastAssignments').slideToggle(); $('#arrowTurn').toggleClass('bi-caret-down-fill'); $('#arrowTurn').toggleClass('bi-caret-right-fill'); $('#pastAssignmentsHead').toggleClass('rounded');">
            <i class="bi bi-caret-right-fill col-auto m-0 p-0 align-content-center" id="arrowTurn"></i><h5 class="col-auto m-2 p-0"> Past Assignments</h5>
        </div>
    </div>
    <div id="pastAssignments" style="display: none;">
        <?php foreach ($pastassignmentslist as $assignment) { ?>
            <div class="card-body row m-0 p-0 assignment_name_row">
                <div class="col-auto px-auto align-content-center" style="background-color: var(--primary-dark);"><i class="bi bi-archive-fill"></i></div>
                <h5 class="col-auto m-2 me-auto p-1 "><?= $assignment['AssignmentName']; ?></h5>
                <label class="col-auto m-2 ms-auto p-1"></label>
            </div>
        <?php } ?>
    </div>
</div>
