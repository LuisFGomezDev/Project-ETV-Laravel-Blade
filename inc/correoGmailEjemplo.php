<?PHP
require "./PHPMailer_5.2.0/class.phpmailer.php";

  $mail = new phpmailer();
  $mail->PluginDir = "PHPMailer_5.2.0/";


  $mail->Username = "info@tecnokima.com"; 
  $mail->Password = "web*123*";

  //Indicamos cual es nuestra dirección de correo y el nombre que 
  //queremos que vea el usuario que lee nuestro correo
  $mail->From = "info@tecnokima.com";
  $mail->FromName = "Contacto Web";


 $cadena="Usuario escribio en pagina web:<br><p>&nbsp;</p>
Nombre:".str_replace("'","",$_POST['nombre'])."<br>
Correo:&nbsp;".str_replace("'","",$_POST['correo'])."<br>
Telefono:&nbsp;".str_replace("'","",$_POST['telefono'])."<br><p>&nbsp;</p>
<b>Asunto</b>:<br><p>&nbsp;</p>".str_replace("'","",$_POST['nota'])."<br><p>&nbsp;</p>"; 


$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch

$mail->IsSMTP(); // telling the class to use SMTP

try {
  //$mail->Host       = "mail.yourdomain.com"; // SMTP server
  $mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
  $mail->SMTPAuth   = true;                  // enable SMTP authentication
  $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
  $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
  $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
  $mail->Username   = "info@tecnokima.com";  // GMAIL username
  $mail->Password   = "web*123*";            // GMAIL password
  //$mail->Timeout=30;
  //$mail->AddReplyTo('oscar.vargas@utcondugaskima.com', 'Oscar Eduardo');
    
  $mail->AddAddress('horka2000@hotmail.com', 'Oscar Eduardo Vargas');
  
  
  $mail->SetFrom('info@tecnokima.com', 'Informador Tecnokima');
  //$mail->SetFrom('horka2000@hotmail.com', 'Oscar Eduardo Vargas Llanos');
  //$mail->AddReplyTo('name@yourdomain.com', 'First Last');
  $mail->Subject = 'Prueba Sistemas';
  $mail->AltBody = 'Excelente el trabajo'; // optional - MsgHTML will create an alternate automatically
  //$mail->MsgHTML(file_get_contents('contents.html'));
  $mail->MsgHTML($cadena);
  //$mail->AddAttachment('images/phpmailer.gif');      // attachment
  //$mail->AddAttachment('images/phpmailer_mini.gif'); // attachment
  $mail->Send();
  echo "Gracias por Escribir";
} catch (phpmailerException $e) {
  //echo $e->errorMessage(); //Pretty error messages from PHPMailer.
    echo "No se pudo enviar correo:".$e->errorMessage();

} catch (Exception $e) {
  //echo $e->getMessage(); //Boring error messages from anything else!.
  echo "No se pudo enviar correo:".$e->getMessage();
}
?>