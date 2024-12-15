<?php
include 'Database.php';
include 'User.php';

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // dapatkan akaun dengan no matric 
    if (isset($_GET['matric'])) {
        $matric = $_GET['matric'];

  
        $database = new Database();
        $db = $database->getConnection();

        $user = new User($db);

        // delete akaun
        $deleteResult = $user->deleteUser($matric);


        $db->close();

        // kalau delete berjaya
        if ($deleteResult) {
 
            echo "<script type='text/javascript'>
                    alert('User deleted successfully.');
                    window.location.href = 'read.php';  // Redirect to user list page
                  </script>";
        } else {
            // kalau delete tak berjaya
            echo "<script type='text/javascript'>
                    alert('Error deleting user.');
                    window.location.href = 'read.php';  // Redirect to user list page
                  </script>";
        }
        exit(); 
    } else {
        // Kalau no matric tak jumpa
        echo "<script type='text/javascript'>
                alert('Matric number is missing.');
                window.location.href = 'read.php';  // Redirect to user list page
              </script>";
        exit();
    }
}
?>
