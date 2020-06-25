<?php 
require '../auth/checkAuth_handler.php';
require_once '../function.php';
require '../../database/database.php';
if (!isset($_SESSION)) {
	session_start();
}
