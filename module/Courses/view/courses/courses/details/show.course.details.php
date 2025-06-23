<?php
use Courses\Courses;

$courses = new Courses();
$coursetest = $courses->getDetails(1);
?>
CourseID = 1
<?=$coursetest['CourseName'];?>
<?=$coursetest['DisciplineName'];?>
<span><?=$coursetest['DisciplineCode'];?><?=$coursetest['CourseNumber'];?></span>
Section: <?=$coursetest['SectionNumber'];?>;
Semester: <?=$coursetest['CourseID'];?>
