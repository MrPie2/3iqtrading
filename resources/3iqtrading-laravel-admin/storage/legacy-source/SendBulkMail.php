<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMalier\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
$message=$_POST['htmlcontent'];
$Subject=$_POST['Subject'];
$email=array($_POST['SendTo']);
include('../Connect.php');
$sql="select * from email";
$query=mysqli_query($Conn, $sql);

while($row=mysqli_fetch_array($query, MYSQLI_ASSOC)){
$sendTo= $row['email'];

// Instantiation and passing [ICODE]true[/ICODE] enables exceptions
$mail = new PHPMailer(true);

try {
        //Server settings
    $mail->SMTPDebug = 0;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'mail.malta-fxpro.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'info@malta-fxpro.com';                     // SMTP username
    $mail->Password   = 'MaltafxPro123#@';                               // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, [ICODE]ssl[/ICODE] also accepted
    $mail->Port       = 26;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('info@malta-fxpro.com', 'Maltafxpro');
    $mail->addAddress($sendTo);     // Add a recipient



    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $Subject;
    $mail->Body    = '<html>
<head>
	<TITLE>Untitled-1</TITLE>
	<META http-equiv="Content-Type" Content="text/html; charset=utf-8">
<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=0.5" />



</head>

<style type="text/css">

</style>
<body bgcolor="#FFFFFF">

<div style="padding: 10px; background: #eee;">
<div class="mailbody" style=" background: #fff; border-top: 10px solid #0095eb; border-bottom: 10px solid  #0095eb;"><div class="" style="background-image: url(https://nairametrics.com/wp-content/uploads/2020/04/investments-are-unreliable-.jpg?w=900); background-size: cover; padding: 20px; background-repeat: no-repeat; background-position: center center;"><div style="color: #fff; font-size: 8pt" align="center"><h3>Maltafxpro</h3></div><div align="center"><h3 style="margin-top: 1cm; color: #fff;">'.$Subject.'</h3></div></div>

<div style="padding: 20px; line-height: 30px; font-size: 13pt">'.$message.'
<br>

<br>
</div>
</div>
<div class="mailfooter" align="center" style="padding: 20px;">
<address style="color: #555; padding: 20px">
 MALTA FX PRO © 2013 - 2022. All Rights Reserved.National Association of Forex & Crypto-currency Dealers Crypto Investment Globe Ltd is registered in, 8827 Walnut wood St. Washington, DC 20406, United States | Company Registration Number: C/56519 MFSA License Number: IS/56519.
</address>
<hr>
<p style="color: #555; padding: 20px">
To unsubscribe from this type of email, click <br><a href="#">UNSUBSCRIBE</a><br>
</p>

</div>
</div>


</body>
</html>';
$mail->send();

   

} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

}


if($mail){
echo 1;
}else{
 echo 0;   
}
?>
