<?php
include("db_connect.php"); // Include the database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Function to sanitize input data
    function sanitize_input($data) {
        return htmlspecialchars(trim($data));
    }

    // Validate and sanitize form inputs
    $name = sanitize_input($_POST["name"]);
    $email = sanitize_input($_POST["email"]);
    $contact = sanitize_input($_POST["contact"]);
    $education = sanitize_input($_POST["education"]);
    $pass_out_year = sanitize_input($_POST["pass_out_year"]);
    $address = sanitize_input($_POST["address"]);
    $city = sanitize_input($_POST["city"]);
    $dob = sanitize_input($_POST["dob"]);
    $internship_pref = sanitize_input($_POST["internship_pref"]);

    // Basic validation - checking if required fields are not empty
    if (empty($name) || empty($email) || empty($contact) || empty($education) || empty($pass_out_year) || empty($address) || empty($city) || empty($dob) || empty($internship_pref)) {
        echo "Error: All fields are required.";
    } else {
        // Validate email address
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Error: Invalid email address.";
        } else {
            if (!preg_match('/^(?!.*(.)\1{9})[1-9]\d{9}$/', $contact)) {
                echo "Error: Invalid phone number.";
            } else {
                if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $dob)) {
                    echo "Error: Invalid date of birth format. Please enter a valid date in YYYY-MM-DD format.";
                } else {
                   
                    $sql = "INSERT INTO enroll (name, email, contact, education, pass_out_year, address, city, dob, internship_pref) VALUES ('$name', '$email', '$contact', '$education', '$pass_out_year', '$address', '$city', '$dob', '$internship_pref')";
                    if ($conn->query($sql) === TRUE) {
                        echo "Form submitted successfully!";
                    } else {
                        echo "Error: Form submission failed.";
                    }
                }
            }
        }
    }
} else {
    echo "Error: Invalid request method.";
}

$conn->close();
?>
