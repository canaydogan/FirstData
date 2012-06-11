<?php

return array(
    'di' => array(
        'instance' => array(
            'FirstData\Configuration\StandardConfiguration' => array(
                'parameters' => array(
                    'apiUrl' => 'https://ws.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl',
                    'username' => '',
                    'password' => '',
                    'storeId' => '',
                    'sslKey' => '',
                    'sslKeyPassword' => '',
                    'sslCert' => ''
                )
            ),
            'FirstData\Adapter\Curl' => array(
                'parameters' => array(
                    'configuration' => 'FirstData\Configuration\StandardConfiguration'
                )
            ),
            'FirstData\Transaction\Sale' => array(
                'parameters' => array(
                    'adapter' => 'FirstData\Adapter\Curl'
                )
            )
        )
    )
);