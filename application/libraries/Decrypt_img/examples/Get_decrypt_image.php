<?php

class Get_decrypt_image extends CI_Controller {

    public function decrypt_image($url, $password) {
        require __DIR__ . 'vendor/autoload.php';

        $string = file_get_contents($url); /* this function encrypt image change to string */
        $cryptor = new\RNCryptor\Decryptor();
        $plaintext = $cryptor->decrypt($string, $password); /* this function decypt string */
        $image = base64_encode($plaintext);
        return $image;
    }

}
