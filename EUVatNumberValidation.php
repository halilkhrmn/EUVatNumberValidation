<?php

/**
 * User: hibrhmk
 * Date: 16.09.2021
 */


class EUVatNumberValidation
{
    public $debugMode = false;

    /**
     * EUVatNumberValidation constructor.
     */
    public function __construct()
    {
    }

    /**
     * check vat number
     *
     * @param $postParams
     * @param string $action
     * @return array
     */
    public function check($vatNumber = null, $countryISO2 = null)
    {
        try {
            if (!$vatNumber || !$countryISO2) return array(
                'success' => false,
                'msg' => 'Information is missing'
            );
            $result = false;
            $url = 'http://ec.europa.eu/taxation_customs/vies/viesquer.do?ms=' . $countryISO2 . '&iso=' . $countryISO2 . '&vat=' . $vatNumber . '&name=&companyType=&street1=&postcode=&city=&BtnSubmitVat=Verify';
            $response = file_get_contents($url);
            preg_match('/<span class="validStyle">([^<]+)<\/span>/', $response, $matches);
            if (isset($matches[0])) {
                if (strpos($matches[0], 'Yes') !== false) $result = true;
            }

            if ($this->debugMode) {
                return array(
                    'success' => true,
                    'vatNumber' => $vatNumber,
                    'countryISO2' => $countryISO2
                );
            } else {
                return array(
                    'success' => true,
                    'vatNumber' => $vatNumber,
                    'countryISO2' => $countryISO2
                );
            }
        } catch (\Throwable $th) {
            if ($this->debugMode) {
                return array(
                    'success' => false,
                    'msg' => $th->getMessage(),
                    'file' => $th->getFile(),
                    'line' => $th->getLine()
                );
            } else {
                return array(
                    'success' => false,
                    'msg' => 'An error occurred please try again'
                );
            }
        }
    }
}
