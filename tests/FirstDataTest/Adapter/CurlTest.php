<?php

namespace FirstDataTest\Adapter;

use FirstDataTest\Adapter\AbstractAdapter;

class CurlTest extends AbstractAdapter
{

    public function newAdapter()
    {
        return $this->newCurlAdapter();
    }

    public function newValidAdapter()
    {
        return $this->newValidCurlAdapter();
    }

    /**
     * @todo bunu kaldir veya daha iyi bir hale sok.
     */
    public function _testRequest()
    {
        $adapter = $this->newValidCurlAdapter();
        $xml = '';
        $xml .= '<fdggwsapi:FDGGWSApiOrderRequest xmlns:fdggwsapi="http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi" xmlns:v1="http://secure.linkpt.net/fdggwsapi/schemas_us/v1">';
        $xml .= '<v1:Transaction>';
        $xml .= '<v1:CreditCardTxType>';
        $xml .= '<v1:Type>';
        $xml .= 'sale';
        $xml .= '</v1:Type>';
        $xml .= '</v1:CreditCardTxType>';
        $xml .= '<v1:CreditCardData>';
        $xml .= '<v1:CardNumber>4111111111111111</v1:CardNumber>';
        $xml .= '<v1:ExpMonth>12</v1:ExpMonth>';
        $xml .= '<v1:ExpYear>13</v1:ExpYear>';
        $xml .= '<v1:CardCodeValue>123</v1:CardCodeValue>';
        $xml .= '</v1:CreditCardData>';
        $xml .= '<v1:Payment>';
        $xml .= '<v1:ChargeTotal>10</v1:ChargeTotal>';
        $xml .= '</v1:Payment>';
        $xml .= '</v1:Transaction>';
        $xml .= '</fdggwsapi:FDGGWSApiOrderRequest>';
        echo $adapter->request('<?xml version="1.0"?><SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/"><SOAP-ENV:Body>' . $xml . '</SOAP-ENV:Body></SOAP-ENV:Envelope>');
    }

}