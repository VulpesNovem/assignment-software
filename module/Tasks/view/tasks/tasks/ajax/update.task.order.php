<?php
$tasks = json_decode($_POST['data'], true);
foreach ($tasks as $task) {
    (new Tasks\Tasks)->Input($task);
}