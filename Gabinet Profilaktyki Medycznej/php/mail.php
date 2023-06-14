<?php

$name_surname = $_POST['Firstname'].$_POST['Surname'];



$file = "../pdfFile/".$name_surname.".pdf"; /* ścieżka do pliku */ 
$filename = $name_surname.".pdf"; /* nazwa pliku w wiadomości */

$date = $_POST['date'];


$content = file_get_contents($file);
$content = chunk_split(base64_encode($content));
$uid = md5(uniqid(time()));
$name = basename($file);

$from_name = $_POST['nurse'];
$from_mail = "ipz.gabinet@gmail.com";
$replyto = "ipz.gabinet@gmail.com";
$to = "czewho@gmail.com";
$subject = "Badanie - ".$name_surname;
$message = "Badanie z dnia: ".$date;

$header = "From: " . $from_name . " <" . $from_mail . ">\r\n" . 
   "Reply-To: " . $replyto . "\r\n" . 
   "MIME-Version: 1.0\r\n" . 
   "Content-Type: multipart/mixed; boundary=\"" . 
   $uid . "\"\r\n\r\n";

$str_message = "--" . $uid . "\r\n" . 
   "Content-type:text/plain; charset=utf-8\r\n" . 
   "Content-Transfer-Encoding: 7bit\r\n\r\n" . $message . 
   "\r\n\r\n" . "--" . $uid . "\r\n" . 
   "Content-Type: application/octet-stream; name=\"" . 
   $filename . "\"\r\n" . 
   "Content-Transfer-Encoding: base64\r\n" . 
   "Content-Disposition: attachment; filename=\"" . 
   $filename . "\"\r\n\r\n" . $content . "\r\n\r\n" . 
   "--" . $uid . "--";
if (mail($to, $subject, $str_message, $header))
{
echo "Wiadomość z załacznikiem wysłana poprawnie.";
}
else
{
echo "Błąd w wysyłaniu wiadomości.";
}

?>