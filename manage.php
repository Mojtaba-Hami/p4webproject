<?php
require 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        addComputer(
            $_POST['name'],
            $_POST['last_service'],
            $_POST['cost']
        );
    }
}
?>

<!-- بقیه کدهای HTML -->