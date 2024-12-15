<?php

include 'Database.php';
include 'User.php';

if (isset($_POST['submit']) && ($_SERVER['REQUEST_METHOD'] == 'POST')) {

    $database = new Database();
    $db = $database->getConnection();


    $matric = $db->real_escape_string($_POST['matric']);
    $password = $db->real_escape_string($_POST['password']);

    // Validate inputs
    if (!empty($matric) && !empty($password)) {
        $user = new User($db);
        $userDetails = $user->getUser($matric);

        // Check kalau input ada dalam db
        if ($userDetails && password_verify($password, $userDetails['password'])) {
            echo 'Login Successful';
        } else {
            echo 'Login Failed';
        }
    } else {
        echo 'Please fill in all required fields.';
    }
}