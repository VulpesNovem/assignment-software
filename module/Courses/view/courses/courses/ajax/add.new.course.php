<?php
use Courses\Courses;
use Courses\Disciplines;
use Courses\Semesters;

$userid = $_SESSION['AssignmentSession']['User'][0]['UserID'];
$courses = new Courses;
$disciplines = new Disciplines;
$disciplinelist = $disciplines->getAll();
$semesters = new Semesters;
$semesterlist = $semesters->getAll();
?>

<form id="AddCourseForm" onsubmit="updateCourse('AddCourseForm'); return false;">
    <div class="row mb-1">
        <div class="col-6"><label>Course Name</label></div>
        <div class="col-6"><input required class="form-control" type="text" name="CourseName" placeholder="Course Name"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Discipline</label></div>
        <div class="col-6">
            <select required class="form-select" name="DisciplineID">
                <option value="" selected>Select Discipline</option>
                <?php foreach ($disciplinelist as $discipline) { ?>
                    <option value="<?= $discipline['DisciplineID']; ?>" ><?= $discipline['DisciplineName']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Course Number</label></div>
        <div class="col-6"><input required class="form-control" type="text" name="CourseNumber" placeholder="Course Number"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Section Number</label></div>
        <div class="col-6"><input required class="form-control" type="number" max="999" name="SectionNumber" placeholder="Section Number"></div>
    </div>

    <div class="row mb-3">
        <div class="col-6"><label>Semester</label></div>
        <div class="col-6">
            <select required class="form-select" name="SemesterID">
                <option value="" selected>Select Semester</option>
                <?php foreach ($semesterlist as $semester) { ?>
                    <option value="<?= $semester['SemesterID']; ?>" ><?= $semester['SemesterName']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-auto mx-auto">
            <button type="submit" class="btn btn-primary" onclick="$(this).hide()"><i class="bi bi-plus"></i> Course</button>
        </div>
    </div>
</form>
