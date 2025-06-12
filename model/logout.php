<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include 'auth.php';

logout();
?> 