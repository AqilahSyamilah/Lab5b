<?php

include 'Database.php';
include 'User.php';
if (isset($_POST['matric'], $_POST['password'])) {
    $matric = trim($_POST['matric']);
    $password = trim($_POST['password']);

    if (!empty($matric) && !empty($password)) {
        try {
            $database = new Database();
            $db = $database->getConnection();

            $user = new User($db);
            // call balik user function
            $userDetails = $user->getUser($matric); 

            if ($userDetails) {

                if (password_verify($password, $userDetails['password'])) {
                    //kalau dapat login
                    echo "<script type='text/javascript'>
                            alert('Login successful!');
                            window.location.href = 'login.php';  // Replace with the appropriate page
                          </script>";
                } else {
                    // salah password
                    echo "<script type='text/javascript'>
                            alert('Incorrect password.');
                            window.location.href = 'login.php';  // Redirect back to login page
                          </script>";
                }
            } else {
                //matric takde dalam db atau belum register
                echo "<script type='text/javascript'>
                        alert('No user found with that matric number.');
                        window.location.href = 'login.php';  // Redirect back to login page
                      </script>";
            }
        } catch (Exception $e) {
            // lain lain error
            echo "<script type='text/javascript'>
                    alert('Error: " . $e->getMessage() . "');
                    window.location.href = 'login.php';  // Redirect back to login page
                  </script>";
        }
    } else {
        //kalau takde input no matric/password
        echo "<script type='text/javascript'>
                alert('Matric and password are required.');
                window.location.href = 'login.php';  // Redirect back to login page
              </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<body>

    <div class="login-container">
        <h2>Login</h2>
        
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="matric">Matric Number:</label>
                <input type="text" id="matric" name="matric" required>
            </div>
            
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <button type="submit">Login</button>
        </form>
        
        <p><a href="register_form.php">Don't have an account? Register here</a></p> <!-- Link to registration page -->
    </div>

</body>
</html>
