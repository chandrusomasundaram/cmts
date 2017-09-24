<?php

include 'init.php';

// if(isset($_POST['verify_mail'])){

$email = $_POST["email"];

$query = "SELECT emp_pass FROM employee_pd WHERE emp_email='".$email."'";

$result = mysqli_query($db_conn,$query);

if(mysqli_num_rows($result)>0){
    $row = mysqli_fetch_row($result);
    $password  = $row[0];
    $to = $email;
    $subject = 'Password';
    $from = 'chandru.rainbowclouds@email.com';
 
    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
    // Create email headers
    $headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
    // Compose a simple HTML email message
    $message = '<html><body>';
    $message .= '<h4 style="color:#f40;">Please dont share your password to others</h4>';
    $message .= '<p style="color:#080;font-size:18px;">Your Passsword is:</p>';
    $message .= $password;
    $message .= '</body></html>';
 
    // Sending email
    if(mail($to, $subject, $message, $headers)){
        echo "Your password was sent to your mail.";
    } 
    else{
        echo 'Unable to send email. Please try again.';
    }
}
else{
    echo "Details not found.";
}

mysqli_close($db_conn);
// }

?>