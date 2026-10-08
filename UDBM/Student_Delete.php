<?php
require_once "dbconfig.php";
require_once "Student.php";

$id = filter_var($_POST["id"] ?? null, FILTER_VALIDATE_INT);
if ($id === false || $id === null || $id < 1) {
    header("Location: index.php");
    exit;
}

$studentRepository = new Student($conn);
$studentRepository->delete($id);
header("Location: dashboard.php?deleted=1");
exit;