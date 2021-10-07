<?php
session_start();
session_unset();
session_destroy();
header("Location: login.php");
flash("You have been logged out");
?>