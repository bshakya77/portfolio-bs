<?php 
    if(isset($_POST['submit']))
    {
        echo "
            <script>
                alert('Entered');
            </script>
        ";
        $full_name = $_POST['full-name'];
        $email = $_POST['email'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];

        $email_from = "bijshakya77@gmail.com";
        $email_subject =  $subject;
        $email_body = "Full Name: $full_name.\n".
                        "Email Id: $email.\n".
                            "Message: $message.\n";
        $to_email= "deathnotebijay@gmail.com";
        $headers = "From: $email_from \r\n";
        $headers.="Reply-To: $email\r\n";

        //$secretKey = "6Lf4O9oUAAAAAIy9C2Cn9BXm1x0VNynV9Q-vQDC2";
        $secretKey = "6LfhPdoUAAAAAHfLWo9BAG6OZAvsZyvM7QfryEWm";
        $responseKey = $_POST['g-recaptcha-response'];
        $userIP = $_SERVER['REMOTE_ADDR'];
        $url = "https://www.google.com/recaptcha/api/siteverify?
                secret=$secretKey&response=$responseKey&remoteip=$userIP";
        $response = file_get_contents($url);
        $responseKey = json_decode($response);

        if($response->success){
            mail($to_email, $email_subject, $email_body, $headers);
            echo "Message Sent Successfully";
        }
        else{
            echo "<span>Invalid Captcha, Please Try Again </span>";
        }
    }
?>