<?php

function delete_user_card($Api, $CardId) {
	$return = false;
	try {

		$Card = new \MangoPay\Card();
		$Card->Id = $CardId;
		$Card->Active = false;
		$Result = $Api->Cards->Update($Card);
		$return =  true;
	} catch (MangoPay\Libraries\ResponseException $e) {
		// handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

		if ($e->GetErrorDetails()->Type == "card_already_not_active") {
			 $return =  true;
		}
	} catch (MangoPay\Libraries\Exception $e) {
		//return $e;
	}
	return $return;
}
