<?php
session_start();
unset($_SESSION['employee']) ;
unset($_SESSION['password']);
unset($_SESSION['name']);
unset($_SESSION['email']);



header("Location: index");
exit;