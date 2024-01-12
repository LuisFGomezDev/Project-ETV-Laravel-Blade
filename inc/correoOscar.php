<?PHP
require "PHPMailer_5.2.0/class.phpmailer.php";

  $mail = new phpmailer();
  $mail->PluginDir = "PHPMailer_5.2.0/";


  $mail->Username = "oscar.vargas@peoplecontact.com.co"; 
  $mail->Password = "abcd1234";

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = "oscar.vargas@peoplecontact.com.co";
  $mail->FromName = "Contacto Web";


 $cadena=$cadenaHTML."Oscar Eduardo Vargas Llanos. Adminsitrador. Pruebas"; 


$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  //$mail->Host       = "mail.yourdomain.com"; // SMTP server
  //$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "";                 // sets the prefix to the servier
  $mail->Host       = "smtpout.secureserver.net";      // sets GMAIL as the SMTP server
  $mail->Port       = 25;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "oscar.vargas@peoplecontact.com.co";  // GMAIL username
  $mail->Password   = "abcd1234";            // GMAIL password
  //$mail->AddReplyTo('oscar.vargas@utcondugaskima.com', 'Oscar Eduardo');
  //$mail->AddAddress('subgerente@tecnokima.com', 'Teresita Valdes Rendon');
  $mail->AddAddress('horka2000@hotmail.com', 'Oscar Eduardo Vargas');
  //$mail->AddAddress('ingenieria.auxiliar@tecnokima.com', 'Oscar Eduardo Vargas');
  
  //$mail->AddAddress('info@tecnokima.com', 'Informador Tecnokima');
  
   $mail->SetFrom('oscar.vargas@peoplecontact.com.co', 'Informador Uno27');
  //$mail->SetFrom('horka2000@hotmail.com', 'Oscar Eduardo Vargas Llanos');
  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->Subject = 'Usuario pagina Web';
  $mail->AltBody = 'Esto es un ejemplo'; // optional - MsgHTML will create an alternate automatically
  //$mail->MsgHTML(file_get_contents('contents.html'));
  $mail->MsgHTML($cadena);
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
    
  echo 'Correco electronico enviado';
} catch (phpmailerException $e) {
  //echo $e->errorMessage(); //Pretty error messages from PHPMailer.
    echo 'No se pudo enviar el correo electrónico:'.$e;

} catch (Exception $e) {
  //echo $e->getMessage(); //Boring error messages from anything else!.
  echo 'No se pudo enviar el correo electrónico:'.$e;  
}
?>