<?php
require_once 'db.php';
$_SESSION = [];
session_destroy();
header("Location: login.php?status=logout");
exit;
