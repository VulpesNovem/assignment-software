<?php
use Courses\Courses;
use Courses\Semesters;

$semesters = new Semesters();
$semesterid = $_GET['SemesterID'];
$semestershown = $semesters->getDetails($semesterid);

$courses = new Courses();
$courselist = $courses->getAll();
?>

<h1 style="text-align: center" class="mb-3 mt-3"><?=$semestershown[0]['SemesterName']?></h1>

<?php
if (!empty($courselist)) {
    foreach ($courselist as $course) {
        if ($course['SemesterID'] == $semesterid) {
            $dropdownId = 'iconDropdown' . $course['CourseID']; // unique ID for each course
            ?>
            <div class="col-xl-4 col-m-6 col-sm-12 mb-3">
                <div class="card course_card">
                    <div class="card-header" style="overflow: visible">
                        <div class="dropdown float-end">
                            <button class="btn btn-link p-0 border-0" type="button" id="<?=$dropdownId?>" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <form class="color-update-form" data-course-id="<?=$course['CourseID']?>">
                                <ul class="dropdown-menu" aria-labelledby="<?=$dropdownId?>">
                                    <li>
                                        <label for="hexColor<?=$course['CourseID']?>">Card Color:&nbsp;</label>
                                        #<input type="text"
                                                id="hexColor<?=$course['CourseID']?>"
                                                name="hexColor"
                                                maxlength="6"
                                                oninput="this.value = this.value.replace(/[^a-fA-F0-9]/g, '').slice(0, 6)"
                                                value="<?=$course['CardColor']?>"
                                                required>
                                    </li>
                                    <li>
                                        <button type="submit">Save Color</button>
                                    </li>
                                </ul>
                            </form>
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
            <?php
        }
}}?>

<script>
    $(document).ready(function () {
        $('.color-update-form').on('submit', function (e) {
            e.preventDefault();

            const form = $(this);
            const courseId = form.data('course-id');
            const color = form.find('input[name="hexColor"]').val();

            // Validate hex
            if (!/^[a-fA-F0-9]{6}$/.test(color)) {
                alert("Please enter a valid 6-digit hex color.");
                return;
            }

            $.ajax({
                url: '/courses/ajax/update.card.color',
                type: 'POST',
                data: {
                    course: courseId,
                    hexColor: color
                },
                success: function (response) {
                    if (response === 'success') {
                        // Update card background
                        $('#cardBody' + courseId).css('background-color', '#' + color);
                    } else {
                        alert("Update failed: " + response);
                    }
                },
                error: function () {
                    alert("AJAX error while saving.");
                }
            });
        });
    });
</script>
