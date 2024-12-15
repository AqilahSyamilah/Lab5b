<?php
include 'Database.php';
include 'User.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $matric = trim($_POST['matric']);  
    $name = trim($_POST['name']);     
    $role = trim($_POST['role']);     


    $database = new Database();
    $db = $database->getConnection();

    $user = new User($db);

    try {
        // Call method yang updte data user
        $isUpdated = $user->updateUser($matric, $name, $role);

        // kalau berjaya
        if ($isUpdated) {
         //redirect ke read.php
            header('Location: read.php?message=User updated successfully');
            exit;
        } else {
            // kalau tak berjaya
            echo "<p>Error: User could not be updated.</p>";
        }
    } catch (Exception $e) {
        // kalau ada error lain
        echo "<p>Error: " . $e->getMessage() . "</p>";
    }


    $db->close();
}
?>
