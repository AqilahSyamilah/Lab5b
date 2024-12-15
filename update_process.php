<?php
include 'Database.php';
include 'User.php';


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $matric = $_POST['matric'];
    $name = $_POST['name'];
    $role = $_POST['role'];

    $database = new Database();
    $db = $database->getConnection();
    $user = new User($db);


    $isUpdated = $user->updateUser($matric, $name, $role);

    if ($isUpdated === true) {
        echo "<script type='text/javascript'>
                alert('User updated successfully.');
                window.location.href = 'read.php'; // Redirect to the user list page
              </script>";
        exit();
    } else {
        // Display the error message
        echo "Error: " . $isUpdated;
    }
}
?>
