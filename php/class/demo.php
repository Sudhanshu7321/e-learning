<?php
require 'mail.php';

for($i=0;$i<1;$i++){
  $sub = $i.' ';
    $html = 'hehehheh';
    smtp_mailer('sudhanshugolu2003@gmail.com',$sub,$html);

}
echo '<script>alert("Done")</script>';  
           

?>