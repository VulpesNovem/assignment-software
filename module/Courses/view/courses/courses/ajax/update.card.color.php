<?php
use Courses\Courses;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courseId = $_POST['course'] ?? null;
    $hexColor = $_POST['hexColor'] ?? null;

    if ($courseId && preg_match('/^[a-fA-F0-9]{6}$/', $hexColor)) {
        $courses = new Courses();
        $courses->updateValues($courseId, ['CardColor' => $hexColor]);
        echo 'success';
    } else {
        echo 'invalid input';
    }
} else {
    echo 'invalid request';
}