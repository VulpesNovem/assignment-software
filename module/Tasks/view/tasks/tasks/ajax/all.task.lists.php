<?php $unlistedtasklist = (new \Tasks\Tasks)->getUnlistedByUserID($_SESSION['AssignmentSession']['User'][0]['UserID']);
$tasklistslist = (new \Tasks\TaskLists)->getAllByUserID($_SESSION['AssignmentSession']['User'][0]['UserID']); ?>

<div class="row row-cols-<?= count($tasklistslist) >= 3 ? '3' : (count($tasklistslist) + 1) ?>">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5>General</h5>
            </div>
            <div class="card-body">
                <ul class="m-0" id="tasksGeneral" style="min-height: 50px;">
                    <?php if (!empty($unlistedtasklist)) {
                        foreach ($unlistedtasklist as $unlistedtask) { ?>
                            <li class="row m-0 p-0 sortable-task-item">
                                <div class="col-auto p-0 align-content-center sortable-handle">
                                    <i class="bi bi-grip-vertical"></i>
                                </div>
                                <div class="col ps-3 align-content-center sortable-content">
                                    <input class="custom-checkbox" type="checkbox" <?= $unlistedtask['Complete'] == 1 ? 'checked' : '' ?>>
                                    <h5 class=" ps-3 d-inline"><?= $unlistedtask['TaskTitle'] ?></h5>
                                </div>
                            </li>
                        <?php }
                    } ?>
                </ul>
            </div>
        </div>
    </div>
    <script>
        taskListsSortable(0, '#tasksGeneral', '.sortable-task-item', '.sortable-handle');
    </script>

    <?php if (!empty($tasklistslist)) {
        foreach ($tasklistslist as $tasklist) { ?>
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h5><?= $tasklist['TaskListTitle'] ?></h5>
                    </div>
                    <div class="card-body">
                        <ul class="m-0" id="tasksList<?= $tasklist['TaskListID'] ?>" style="min-height: 50px;">
                            <?php $taskslist = (new \Tasks\Tasks)->getAllByTaskListID($tasklist['TaskListID']);
                            if (!empty($taskslist)) {
                                foreach ($taskslist as $task) { ?>
                                    <li class="row m-0 p-0 sortable-task-item">
                                        <div class="col-auto p-0 align-content-center sortable-handle">
                                            <i class="bi bi-grip-vertical"></i>
                                        </div>
                                        <div class="col ps-3 align-content-center sortable-content">
                                            <input class="custom-checkbox" type="checkbox">
                                            <h5 class=" ps-3 d-inline"><?= $task['TaskTitle'] ?></h5>
                                        </div>
                                    </li>
                                <?php }
                            } ?>
                        </ul>
                    </div>
                </div>
            </div>
            <script>
                taskListsSortable(0, '#tasksList<?= $tasklist['TaskListID'] ?>', '.sortable-task-item', '.sortable-handle');
            </script>
        <?php }
    } ?>
</div>