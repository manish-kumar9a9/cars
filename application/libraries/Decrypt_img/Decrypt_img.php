<?php

class Decrypt_img {
    public function encrypt_img_convert_decrypt_img($url, $password) {
        ini_set('allow_url_fopen', '1');
		
	require_once("vendor/autoload.php");
	$string = file_get_contents($url); /* this function encrypt image change to string */
	
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    ),
);  

$string  = file_get_contents($url, false, stream_context_create($arrContextOptions));
	       
	$cryptor = new\RNCryptor\Decryptor();
        $plaintext = $cryptor->decrypt($string, $password); /* this function decypt string */
        $image = base64_encode($plaintext);
        if (!empty($image)) {
            return $image;
        } else {
            return false;
        }
    }

	
	public function encrypt_image($FILES , $password  ){
		require_once("vendor/autoload.php");
		if ($FILES["error"] > 0) {
			return ""; 
		}else {
			$string             = file_get_contents($FILES["tmp_name"]);   /*image change to string*/

			$cryptor            = new \RNCryptor\Encryptor();
			return $base64Encrypted    = $cryptor->encrypt($string, $password);    /*encypt string with password*/
			
			//$fileName           = rand(99,9999).date('dmyhis').".png";               /*randomly image name*/
			
			//file_put_contents('images/'.$fileName, $base64Encrypted);  /*this function save image in folder*/
		}		
	}
}
