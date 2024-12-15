<?php
include 'Database.php';
include 'User.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);
$result = $user->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User List</title>
</head>
<body>
    <h1>User List</h1>
    
    <?php if ($result->num_rows > 0): ?>
        <table border="1">
            <tr>
                <th>Matric</th>
                <th>Name</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    
                    <td><?= htmlspecialchars($row['matric']); ?></td>
                    <td><?= htmlspecialchars($row['name']); ?></td>
                    <td><?= htmlspecialchars($row['role']); ?></td>
                    <td>
                        <a href="update_form.php?matric=<?= urlencode($row['matric']); ?>">Update</a>
                        <a href="delete.php?matric=<?= urlencode($row['matric']); ?>">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
    
</body>
</html>

<?php
$db->close();
?>
