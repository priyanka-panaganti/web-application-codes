<!DOCTYPE html>
<html>
<head>
    <title>Banking Sign-In</title>
</head>
<body>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Retrieve form data
        $username = isset($_POST['username']) ? $_POST['username'] : '';
        $password = isset($_POST['password']) ? $_POST['password'] : '';
        $accountNumber = isset($_POST['account_number']) ? $_POST['account_number'] : '';
    ?>
    <h2>Confirmation</h2>
    <p>Username: <?php echo htmlspecialchars($username); ?></p>
    <p>Password: <?php echo htmlspecialchars($password); ?></p>
    <p>Account Number: <?php echo htmlspecialchars($accountNumber); ?></p>
    <?php
    } else {
    ?>
    <h2>Banking Sign-In</h2>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>

        <label for="account_number">Account Number:</label>
        <input type="text" id="account_number" name="account_number" required><br>

        <button type="submit">Sign In</button>
    </form>
    <?php
    }
    ?>
</body>
</html>
