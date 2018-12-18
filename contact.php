<?php

  $path = '/home/ubuntu/pear/share/pear/';
  set_include_path(get_include_path() . PATH_SEPARATOR . $path);
    
  require_once("Mail.php");
  $host = "smtp.gmail.com";
  $port = "587";
  $username = "ksoutherbruno@gmail.com";
  $password = "";

  $to = "Kyle Souther-Bruno <ksoutherbruno@gmail.com>";
  
  if(isset($_POST['name']) && isset($_POST['email']) && isset($_POST['subject']) && isset($_POST['message'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = nl2br($_POST['message']);
    $from = $email;
    $headers = array('From' => $from, 'To' => $to, 'Subject' => $subject);
    $smtp = Mail::factory('smtp', array ('host' => $host,
                                         'auth' => true,
                                         'username' => $username,
                                         'password' => $password));
    
    $body = '<b>Name:</b> '.$name.' <br><b>Email:</b> '.$email.' <p>'.$message.'</p>';
    
    $mail = $smtp->send($to, $headers, $body);
    
    if ( PEAR::isError($mail) ) {
        echo("The server failed to send the message. Please try again later." . $mail->getMessage() . "</p>");
    } else {
        echo("<p>Message sent.</p>");
    }
    
  }
?>