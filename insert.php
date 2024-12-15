<?php
include 'Database.php';
include 'User.php';

if (isset($_POST['matric'], $_POST['name'], $_POST['password'], $_POST['role'])) {
    $matric = trim($_POST['matric']);
    $name = trim($_POST['name']);
    $password = trim($_POST['password']);
    $role = trim($_POST['role']);

    if (!empty($matric) && !empty($name) && !empty($password) && !empty($role)) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);

            // Hash password
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // masukkan detail yang baru sahaja register
            $user->createUser($matric, $name, $hashedPassword, $role);

            echo "User registered successfully.";
            
            //redirect ke login page
            echo '<br><a href="login.php">Login here</a>';

        } catch (Exception $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Form data not submitted.";
}
?>
