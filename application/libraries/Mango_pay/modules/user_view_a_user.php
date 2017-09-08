<?php

function view_user($Api,$data=array()){

  try {

  $UserId = 17397177;
  $Result = $Api->Users->Get($UserId);

  } catch(MangoPay\Libraries\ResponseException $e) {
  // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

  } catch(MangoPay\Libraries\Exception $e) {
  // handle/log the exception $e->GetMessage()

  }
  echo "<pre>";
  print_r($Result);
}
