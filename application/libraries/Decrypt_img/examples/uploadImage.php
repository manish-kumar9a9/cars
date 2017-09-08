<?php
date_default_timezone_set('Asia/Kolkata');

require __DIR__ . '/../vendor/autoload.php';
$password   = "thepasswordkeyisthis";           /*randamly generate image password */

if (isset($_POST["upload"])) {
    if ($_FILES["file"]["error"] > 0) {
        echo "Error: " . $_FILES["file"]["error"] . "<br>";
    }else {
        $string             = file_get_contents($_FILES["file"]["tmp_name"]);   /*image change to string*/

        $cryptor            = new \RNCryptor\Encryptor();
        $base64Encrypted    = $cryptor->encrypt($string, $password);    /*encypt string with password*/

        $fileName           = date('hi').".png";               /*randomly image name*/
        file_put_contents('images/'.$fileName, $base64Encrypted);  /*this function save image in folder*/
        die;
    }
}

?>
