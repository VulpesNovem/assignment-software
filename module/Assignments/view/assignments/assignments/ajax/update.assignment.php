<?php
if (!empty($_POST)) { (new \Assignments\Assignments)->input($_POST); }
if (!empty($_GET)) { (new \Assignments\Assignments)->input($_GET); }