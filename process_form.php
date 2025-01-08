<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate required fields
    $errors = [];
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $errors[] = "$key is required.";
        }
    }

    // Validate name
    if (!preg_match("/^[a-zA-Z\s]+$/", $_POST['name'])) {
        $errors[] = "Name can only contain letters and spaces.";
    }

    // Validate email
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    }

    // Validate file upload
    $allowed_types = ['image/png', 'image/jpeg', 'image/gif'];
    if (!in_array($_FILES['image']['type'], $allowed_types)) {
        $errors[] = "Only PNG, JPG, and GIF files are allowed.";
    }

    // Check for errors
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    } else {
        // Display data
        echo "<h2>Submitted Information</h2>";
        echo "<table border='1'>";
        foreach ($_POST as $key => $value) {
            echo "<tr><td>$key</td><td>$value</td></tr>";
        }
        echo "</table>";
    }
}
?>