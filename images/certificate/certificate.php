<?php

class Certificate{
function __construct($user_name, $title){
        $font = "C:\Users\sudhanshu\Downloads\arial\arial.ttf";
        $image = imagecreatefromjpeg("certificate.jpg");
        $color = imagecolorallocate($image, 19, 21, 22);
        imagettftext($image, 110, 0, 1230, 1180, $color, $font, $user_name);
        imagettftext($image, 60, 0, 2020, 1409, $color, $font, $title);
        $file = time();
        imagejpeg($image,'c/'.$file . ".jpg");
        imagedestroy($image);
        echo "<script> alert('Certificate click')</script>";

}

}
   $obj = new Certificate('xggggyz', 'ms word');


?>