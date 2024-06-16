<?php
    $Name = $_POST['Name'];
    $Email = $_POST['Email'];
    $Contact = $_POST['Contact'];
    $Message = $_POST['Message'];

    $conn = new mysqli('localhost', 'root', '', 'travel');
    if ($conn->connect_error) {
        echo "$conn->connect_error";
        die("Connection Failed : " . $conn->connect_error);
    } else {
        $stmt = $conn->prepare("INSERT INTO form (Name, Email, Contact, Message) VALUES (?, ?, ?, ?)");
        if ($stmt) {
            $stmt->bind_param("ssss", $Name, $Email, $Contact, $Message);
            $execval = $stmt->execute();
            if ($execval) {
                echo "Message sent successfully... ";
               
                header("Location: index.html");
                exit(); 
            } else {
                echo "Error: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error in preparing statement: " . $conn->error;
        }
        $conn->close();
    }
?>
