<?php

namespace FirstDataTest\Configuration;

use FirstDataTest\Framework\TestCase;

class AbstractConfigurationTest extends TestCase
{

    protected $_configuration;

    public function setUp()
    {
        parent::setUp();
        $this->_configuration = $this->getMockForAbstractClass(
            'FirstData\Configuration\AbstractConfiguration'
        );
    }

    public function testSetterAndGetter()
    {
        $this->_configuration->setApiUrl('https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl');
        $this->_configuration->setUsername('WS1909208425._.1');
        $this->_configuration->setPassword('Nt0NqE25');
        $this->_configuration->setStoreId('1909208425');
        $this->_configuration->setSslKey('ssl.key');
        $this->_configuration->setSslKeyPassword('ckp_1284146263');
        $this->_configuration->setSslCert('ssl.pem');

        $this->assertEquals(
            'https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl',
            $this->_configuration->getApiUrl()
        );
        $this->assertEquals('WS1909208425._.1', $this->_configuration->getUsername());
        $this->assertEquals('Nt0NqE25', $this->_configuration->getPassword());
        $this->assertEquals('1909208425', $this->_configuration->getStoreId());
        $this->assertEquals('ssl.key', $this->_configuration->getSslKey());
        $this->assertEquals('ckp_1284146263', $this->_configuration->getSslKeyPassword());
        $this->assertEquals('ssl.pem', $this->_configuration->getSslCert());
    }

}
