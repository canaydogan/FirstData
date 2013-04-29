<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'first_data_configuration' => function ($sm) {
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
                $adapter->setConfiguration($sm->get('first_data_configuration'));
                return $adapter;
            },
            'FirstData\Transaction\SaleTransaction' => function($sm) {
                $transaction = new \FirstData\Transaction\SaleTransaction();
                $transaction->setAdapter($sm->get('FirstData\Adapter\Curl'));
                return $transaction;
            },
            'FirstData\Transaction\ReturnTransaction' => function($sm) {
                $transaction = new \FirstData\Transaction\ReturnTransaction();
                $transaction->setAdapter($sm->get('FirstData\Adapter\Curl'));
                return $transaction;
            }
        )
    )
);