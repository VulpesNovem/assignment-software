<?php $coursedetails = (new \Courses\Courses)->getDetails($_GET['CourseID'])[0];
$disciplinelist = (new \Courses\Disciplines)->getAll();
$semesterlist = (new \Courses\Semesters)->getAll(); ?>

<form id="EditCourseForm" onsubmit="updateCourse('EditCourseForm'); return false;">

    <input type="hidden" name="CourseID" value="<?= $coursedetails['CourseID'] ?>">

    <div class="row mb-1">
        <div class="col-6"><label>Course Name</label></div>
        <div class="col-6"><input required class="form-control" type="text" name="CourseName" placeholder="Course Name" maxlength="255" value="<?= $coursedetails['CourseName'] ?>"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Discipline</label></div>
        <div class="col-6">
            <select required class="form-select" name="DisciplineID">
                <option value="" selected>Select Discipline</option>
                <?php foreach ($disciplinelist as $discipline) { ?>
                    <option value="<?= $discipline['DisciplineID']; ?>" <?= $discipline['DisciplineID'] == $coursedetails['DisciplineID'] ? 'selected' : '' ?>><?= $discipline['DisciplineName']; ?></option>
                <?php } ?>
            </select>
        </div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Course Number</label></div>
        <div class="col-6"><input required class="form-control" type="text" name="CourseNumber" placeholder="Course Number" maxlength="4" value="<?= $coursedetails['CourseNumber'] ?>"></div>
    </div>

    <div class="row mb-1">
        <div class="col-6"><label>Section Number</label></div>
        <div class="col-6"><input required class="form-control" type="number" max="999" name="SectionNumber" placeholder="Section Number" maxlength="3" value="<?= $coursedetails['SectionNumber'] ?>"></div>
    </div>

    <div class="row mb-3">
        <div class="col-6"><label>Semester</label></div>
        <div class="col-6">
            <select required class="form-select" name="SemesterID">
                <option value="" selected>Select Semester</option>
                <?php foreach ($semesterlist as $semester) { ?>
                    <option value="<?= $semester['SemesterID']; ?>" <?= $semester['SemesterID'] == $coursedetails['SemesterID'] ? 'selected' : '' ?>><?= $semester['SemesterName']; ?></option>
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
