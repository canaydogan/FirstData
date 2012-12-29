<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'FirstData\Configuration\StandardConfiguration' => function ($sm) {
                $configuration = new \FirstData\Configuration\StandardConfiguration();
                $configuration->setApiUrl('https://ws.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl');
                $configuration->setUsername('');
                $configuration->setPassword('');
                $configuration->setStoreId('');
                $configuration->setSslKey('');
                $configuration->setSslKeyPassword('');
                $configuration->setSslCert('');

                return $configuration;
            },
            'FirstData\Adapter\Curl' => function($sm) {
                $adapter = new \FirstData\Adapter\Curl();
                $adapter->setConfiguration($sm->get('FirstData\Configuration\StandardConfiguration'));
                return $adapter;
            },
            'FirstData\Transaction\Sale' => function($sm) {
                $transaction = new \FirstData\Transaction\Sale();
                $transaction->setAdapter($sm->get('FirstData\Adapter\Curl'));
                return $transaction;
            }
        )
    )
);
/*
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
);*/