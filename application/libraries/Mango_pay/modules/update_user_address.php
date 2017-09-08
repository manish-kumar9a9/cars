<?php

function update_user_address($Api, $data = array()) {
    try {

        $UserNatural = new \MangoPay\UserNatural();
        $UserNatural->Tag = $data['Tag'];
        $UserNatural->Address = new \MangoPay\Address();
        $UserNatural->Address->AddressLine1 = $data['AddressLine1'];
        $UserNatural->Address->City = $data['City'];
        $UserNatural->Address->PostalCode = $data['PostalCode'];
        $UserNatural->Address->Country = $data['Country'];
        $UserNatural->Id = $data['Id'];
        $Result = $Api->Users->Update($UserNatural);
    } catch (MangoPay\Libraries\ResponseException $e) {
        return false;
        //'handle/log the response exception with code ' .$e->GetCode() . ', message ' . $e->GetMessage() . 'and error(s)' . $e->GetErrorDetails();
    } catch (MangoPay\Libraries\Exception $e) {
        return false;
        //handle/log the exception echo $e->GetMessage();
    }
    return true;
}
