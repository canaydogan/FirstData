<?php

namespace FirstData\Adapter;

use FirstData\Adapter\AbstractAdapter,
    RuntimeException,
    FirstData\Adapter\Response\Xml;

class Curl extends AbstractAdapter
{

    public function request($postFields)
    {
        $configuration = $this->getConfiguration();
        $userpwd = $configuration->getUsername() . ':' . $configuration->getPassword();

        $ch = curl_init($this->getConfiguration()->getApiUrl());
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSLKEY, $configuration->getSslKey());
        curl_setopt($ch, CURLOPT_SSLKEYPASSWD, $configuration->getSslKeyPassword());
        curl_setopt($ch, CURLOPT_SSLCERT, $configuration->getSslCert());
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: text/xml"));
        curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($ch, CURLOPT_USERPWD, $userpwd);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $xml = curl_exec($ch);

        if (!$xml)
            throw new RuntimeException("An error occured no response server!");

        $response = new Xml();
        $response->loadXml($xml);

        return $response;
    }

}
