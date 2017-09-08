<?php   
    $this->load->library('AES');

    $enc = $this->config->item('Authentication_key');
    //$enc = "6gxB5FTVv6zV3Sb/cv0+MQ==";
     //key for authentication SMBTHOR
    $aes = new AES('RAMAN',  "SUN", 128, 'ecb');

    //$enc = $aes->encrypt();echo $enc;die;

    $aes->setData($enc);

    $dec = $aes->decrypt();
    //echo "After encryption: ".$enc."<br/>";
    //echo "After decryption: ".$dec."<br/>";

    $server   = time();  //server timestamp

    //echo $server."<br/>";
    $diff = $server - $dec;

    //echo $diff;
    if($diff > 60)
    {
        echo json_encode(array('statusCode'=> 200,'Result' => array(),'Message' => 'Access Denied', 'Success'=> false));
        exit;  
    }
?>
