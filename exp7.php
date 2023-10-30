<!DOCTYPE html>
<html>
<head>
    <title>Bank IFSC Code Lookup</title>
</head>
<body>
    <h2>Bank IFSC Code Lookup</h2>
    <form method="POST">
        <label for="ifsc">Enter IFSC Code:</label>
        <input type="text" id="ifsc" name="ifsc" required>
        <button type="submit" name="lookup">Lookup</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['lookup'])) {
        $ifsc = $_POST['ifsc'];

        // Connect to the database
        $dbHost = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbName = "exp7";

        $conn = new mysqli($dbHost, $dbUser, $dbPass, $dbName);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Query the database to fetch the bank's address
        $sql = "SELECT address FROM ifsc WHERE ifsc = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ifsc);

        if ($stmt->execute()) {
            $stmt->bind_result($address);
            $stmt->fetch();

            if (!empty($address)) {
                echo "<h3>Bank Address for IFSC Code '$ifsc':</h3>";
                echo "<p>$address</p>";
            } else {
                echo "<p>Bank with IFSC code '$ifsc' not found.</p>";
            }
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
        $conn->close();
    }
    ?>
</body>
</html>
