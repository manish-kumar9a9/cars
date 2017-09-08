<?php 
	//include google api files
	require_once 'src/Google_Client.php';
	require_once 'src/contrib/Google_Oauth2Service.php';
	
	class Google_au extends Google_Client {
		
		public function name(){
			
			echo "start working";
			
		}
	}

