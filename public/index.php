<?php

if (!isset($_SESSION)) {
  session_start();
}

if (isset($_SESSION['id'])) {
  header('location: ../src/Views/home.php');
} else {
  header('location: ../src/Views/login.php');
}