<?php
require 'db.php';

function getComputers() {
    global $conn;
    $result = $conn->query("SELECT * FROM computers");
    return $result->fetch_all(MYSQLI_ASSOC);
}

function addComputer($name, $last_service, $cost) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO computers (name, last_service, cost_per_sec) VALUES (?, ?, ?)");
    $stmt->bind_param("ssd", $name, $last_service, $cost);
    $stmt->execute();
    $stmt->close();
}

function deleteComputer($id) {
    global $conn;
    $stmt = $conn->prepare("DELETE FROM computers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

function getUsageRecords($computer_id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM usage_records WHERE computer_id = ?");
    $stmt->bind_param("i", $computer_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}
?>