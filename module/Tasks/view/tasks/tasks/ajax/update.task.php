<?php
if (!empty($_POST)) { (new \Tasks\Tasks())->Input($_POST); }
if (!empty($_GET)) { (new \Tasks\Tasks())->Input($_GET); }