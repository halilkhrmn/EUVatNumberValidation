<?php
//Samples
$vatnumberInput = "57753302306";
$countryISO2 = "FR";


//Code begin
$country = $countryISO2;
$vatnumber = $vatnumberInput;
$url = 'http://ec.europa.eu/taxation_customs/vies/viesquer.do?ms=' . $country . '&iso=' . $country . '&vat=' . $vatnumber . '&name=&companyType=&street1=&postcode=&city=&BtnSubmitVat=Verify';
$response = file_get_contents($url);
preg_match('/<span class="validStyle">([^<]+)<\/span>/', $response, $matches);
$status = false;
if(isset($matches[0])){
    if (strpos($matches[0], 'Yes') !== false) $status = true;
}

print_r(array('rsp' => $status,'link' => $url));
