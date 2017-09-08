<?php

function create_a_legal_user($Api,$data=array()){

  try {
  $UserLegal = new \MangoPay\UserLegal();
  $UserLegal->Tag = "custom meta";
  $UserLegal->HeadquartersAddress = new \MangoPay\Address();
  $UserLegal->HeadquartersAddress->AddressLine1 = "1 Mangopay Street";
  $UserLegal->HeadquartersAddress->AddressLine2 = "The Loop";
  $UserLegal->HeadquartersAddress->City = "Paris";
  $UserLegal->HeadquartersAddress->Region = "Ile de France";
  $UserLegal->HeadquartersAddress->PostalCode = "75001";
  $UserLegal->HeadquartersAddress->Country = "FR";
  $UserLegal->LegalPersonType = "BUSINESS";
  $UserLegal->Name = "Mangopay Ltd";
  $UserLegal->LegalRepresentativeAddress = new \MangoPay\Address();
  $UserLegal->LegalRepresentativeAddress->AddressLine1 = "1 Mangopay Street";
  $UserLegal->LegalRepresentativeAddress->AddressLine2 = "The Loop";
  $UserLegal->LegalRepresentativeAddress->City = "Paris";
  $UserLegal->LegalRepresentativeAddress->Region = "Ile de France";
  $UserLegal->LegalRepresentativeAddress->PostalCode = "75001";
  $UserLegal->LegalRepresentativeAddress->Country = "FR";
  $UserLegal->LegalRepresentativeBirthday = 1463496101;
  $UserLegal->LegalRepresentativeCountryOfResidence = "ES";
  $UserLegal->LegalRepresentativeNationality = "FR";
  $UserLegal->LegalRepresentativeEmail = "support@mangopay.com";
  $UserLegal->LegalRepresentativeFirstName = "Joe";
  $UserLegal->LegalRepresentativeLastName = "Blogs";
  $UserLegal->Email = "support@mangopay.com";

  $Result = $Api->Users->Create($UserLegal);

  } catch(MangoPay\Libraries\ResponseException $e) {
  // handle/log the response exception with code $e->GetCode(), message $e->GetMessage() and error(s) $e->GetErrorDetails()

  } catch(MangoPay\Libraries\Exception $e) {
  // handle/log the exception $e->GetMessage()

  }
  echo "<pre>";
  print_r($Result);
}
