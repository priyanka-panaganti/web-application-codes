<!DOCTYPE html>
<html>
<head>
    <title>Session Management with Cookies</title>
</head>
<body>
    <h2>Session Management with Cookies</h2>

    <?php
    // Set a cookie
    if (isset($_POST['setCookie'])) {
        $cookieName = "user";
        $cookieValue = $_POST['username'];
        $expiration = time() + 3600; // 1 hour
        setcookie($cookieName, $cookieValue, $expiration);
        echo "Cookie 'user' set with value: $cookieValue";
    }

    // Modify a cookie
    if (isset($_POST['modifyCookie'])) {
        if (isset($_COOKIE["user"])) {
            $newUsername = $_POST['newUsername'];
            setcookie("user", $newUsername, time() + 3600);
            echo "Cookie 'user' modified. New value: $newUsername";
        } else {
            echo "Cookie 'user' not set. Cannot modify.";
        }
    }

    // Delete a cookie
    if (isset($_POST['deleteCookie'])) {
        if (isset($_COOKIE["user"])) {
            setcookie("user", "", time() - 3600); // Set expiration to the past
            echo "Cookie 'user' deleted.";
        } else {
            echo "Cookie 'user' not set. Nothing to delete.";
        }
    }
    ?>

    <h3>Set a Cookie</h3>
    <form method="POST">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username">
        <button type="submit" name="setCookie">Set Cookie</button>
    </form>

    <h3>Modify a Cookie</h3>
    <form method="POST">
        <label for="newUsername">New Username:</label>
        <input type="text" id="newUsername" name="newUsername">
        <button type="submit" name="modifyCookie">Modify Cookie</button>
    </form>

    <h3>Delete a Cookie</h3>
    <form method="POST">
        <button type="submit" name="deleteCookie">Delete Cookie</button>
    </form>

    <h3>Access the Cookie</h3>
    <?php
    if (isset($_COOKIE["user"])) {
        $username = $_COOKIE["user"];
        echo "Welcome, $username!";
    } else {
        echo "Cookie 'user' not set.";
    }
    ?>
</body>
</html>
