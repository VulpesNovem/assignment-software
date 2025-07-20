<?php use Courses\Courses;
use Courses\Semesters;

$semesters = new Semesters();
$semesterid = $_GET['SemesterID'];
$semestershown = $semesters->getDetails($semesterid);

$courses = new Courses();
$courselist = $courses->getAllByUserID($_SESSION['AssignmentSession']['User'][0]['UserID']);

$semestercourses = [];
foreach ($courselist as $course) {
    if ($course['SemesterID'] == $semesterid) {
        $semestercourses[] = $course;
    }
} ?>

<h1 style="text-align: center" class="mb-3 mt-3"><?=$semestershown[0]['SemesterName']?></h1>

<?php
if (!empty($semestercourses)) {
    foreach ($semestercourses as $course) {?>
        <div class="col-xl-4 col-m-6 col-sm-12 mb-3">
            <div class="card course_card">
                <div class="card-header" style="overflow: visible">
                    <div class="dropdown float-end">
                        <a class="dropdown-button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false"><i class="bi bi-three-dots-vertical"></i></a>
                        <ul class="dropdown-menu p-1" data-popper-placement="bottom-end">
                            <li>
                                <a class="dropdown-item clickable" onclick="editCourse(<?= $course['CourseID'] ?>)">Edit Course</a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form id="CourseCard<?=$course['CourseID']?>" class="p-1" onsubmit="updateCourse('CourseCard<?=$course['CourseID']?>'); return false;">
                                    <input type="hidden" name="CourseID" value="<?=$course['CourseID']?>">
                                    <div class="row m-0 mb-2 p-0">
                                        <div class="col m-0 p-0 d-flex align-items-center">
                                            <label>Card Color:&nbsp;</label>
                                            <input class="ms-auto" required type="color" name="CardColor" value="#<?=$course['CardColor']?>">
                                        </div>
                                    </div>
                                    <div class="row m-0 p-0">
                                        <div class="col-auto m-0 ms-auto p-0">
                                            <button type="submit" class="btn btn-sm btn-primary">Save</button>
                                        </div>
                                    </div>
                                </form>
                            </li>
                        </ul>
                    </div>
                    <a href="/courses/details/<?=$course['CourseID']?>" style="overflow: hidden;">
                        <h5><?=$course['DisciplineCode'];?> <?=$course['CourseNumber'];?> - <?=sprintf('%03d', $course['SectionNumber']);?></h5>
                    </a>
                </div>
                <a class="card-body" id="cardBody<?=$course['CourseID']?>" href="/courses/details/<?=$course['CourseID']?>" style="background-color:#<?=$course['CardColor']?>"></a>
                <a class="card-footer" href="/courses/details/<?=$course['CourseID']?>">
                    <h5><?=$course['CourseName'];?></h5>
                </a>
            </div>
        </div>
    <?php }
} else {
    echo '<h3>No courses found.</h3>';
} ?>