<?php

function update_a_wallet($Api,$data=array()){
  try {
  $Wallet = new \MangoPay\Wallet();
  $Wallet->Tag = "custom meta";
  $Wallet->Description = "random";
  $Wallet->Id = 17397554;

  $Result = $Api->Wallets->Update($Wallet);

  } catch(MangoPay\Libraries\ResponseException $e) {
  // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

  } catch(MangoPay\Libraries\Exception $e) {
  // handle/log the exception $e->GetMessage()

  }

  echo "<pre>";
  print_r($Result);
}
