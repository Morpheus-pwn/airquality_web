<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $country = $_POST["country"];
    $subject = $_POST["subject"];

    $conn = new mysqli('localhost', 'root', '', 'form'); // Database name is 'form'
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_error);
    }
    else{
        $stmt = $conn->prepare("INSERT INTO queries (firstname, lastname, country, subject) VALUES (?, ?, ?, ?)"); // Corrected table name to 'form'
        $stmt->bind_param("ssss", $firstname, $lastname, $country, $subject);
        $stmt->execute();
        echo "registration successfully...";
        $stmt->close();
        $conn->close();
    }

    // Process the data (e.g., display, save to database, send email)
    echo "<h2>Form Data:</h2>";
    echo "<p>First Name: " . htmlspecialchars($firstname) . "</p>";
    echo "<p>Last Name: " . htmlspecialchars($lastname) . "</p>";
    echo "<p>Country: " . htmlspecialchars($country) . "</p>";
    echo "<p>Subject: " . htmlspecialchars($subject) . "</p>";

    // Example: Saving to a text file (for testing)
    $data = "First Name: " . $firstname . "\n";
    $data .= "Last Name: " . $lastname . "\n";
    $data .= "Country: " . $country . "\n";
    $data .= "Subject: " . $subject . "\n\n";

    file_put_contents("form_data.txt", $data, FILE_APPEND);

    // Redirect to a success page or display a message
    // header("Location: success.html");
    // exit;
} else {
    // If the form is accessed directly (not via POST), display an error or redirect
    echo "Method not allowed.";
    // header("Location: error.html");
    // exit;
}
?>