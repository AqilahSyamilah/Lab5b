<?php
class User
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    // create akaun dengan no matric
    public function createUser($matric, $name, $password, $role)
    {
        $sql = "INSERT INTO users (matric, name, password, role) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("ssss", $matric, $name, $password, $role);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
            $stmt->close();
            return "Error: " . $stmt->error;
        }
        return "Error: " . $this->conn->error;
    }

    // dapatkan akaun dengan no matric
    public function getUser($matric)
    {
        $sql = "SELECT * FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);
            $stmt->execute();
            $result = $stmt->get_result();
            $stmt->close();
            return $result->fetch_assoc();
        }
        return null; 
    }

    //update akaun dengan no matric
    public function updateUser($matric, $name, $role)
    {
        $sql = "UPDATE users SET name = ?, role = ? WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sss", $name, $role, $matric);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
            $stmt->close();
            return "Error: " . $stmt->error;
        }
        return "Error: " . $this->conn->error;
    }

    // delete akaun dengan no matric
    public function deleteUser($matric)
    {
        $sql = "DELETE FROM users WHERE matric = ?";
        $stmt = $this->conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("s", $matric);
            if ($stmt->execute()) {
                $stmt->close();
                return true;
            }
            $stmt->close();
            return "Error: " . $stmt->error;
        }
        return "Error: " . $this->conn->error;
    }

    // function untuk display account berdasarkan db 
    public function getUsers()
    {

        $sql = "SELECT matric, name, role FROM users";  // Assuming 'users' is your table name

        $stmt = $this->conn->prepare($sql);
        

        $stmt->execute();
        

        $result = $stmt->get_result();
        
        return $result;
    }
}
?>
