<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $to = "evkrak@gmail.com"; 
    $subject = "New Contact Form Submission from $name";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email";

    echo "<!DOCTYPE html>
    <html lang='en'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Message Sent</title>
        <link rel='stylesheet' href='style.css'>
        <style>
            .message-container { text-align: center; padding: 50px; }
            .success { color: green; }
            .error { color: red; }
        </style>
    </head>
    <body>
        <div class='message-container'>";

    if(mail($to, $subject, $body, $headers)){
        echo "<h1 class='success'>Thank you, $name!</h1>";
        echo "<p>Your message has been sent successfully. We will get back to you soon.</p>";
    } else {
        echo "<h1 class='error'>Oops!</h1>";
        echo "<p>Sorry, there was an error sending your message. Please try again later.</p>";
    }

    echo "<p>Redirecting you back to the home page in 5 seconds...</p>";
    echo "<script>setTimeout(function(){ window.location.href = 'index.php'; }, 5000);</script>";
    echo "</div>
    </body>
    </html>";
}
?>