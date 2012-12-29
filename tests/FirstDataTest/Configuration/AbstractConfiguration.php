<?php

namespace FirstDataTest\Configuration;

use FirstDataTest\Framework\TestCase;

abstract class AbstractConfiguration extends TestCase
{

    abstract public function newConfiguration();
    abstract public function newValidConfiguration();

    protected $_configuration;

    public function setUp()
    {
        parent::setUp();
        $this->_configuration = $this->newConfiguration();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Configuration\AbstractConfiguration',
            $this->_configuration
        );
    }

    public function testParametersViaLocator()
    {
        $configuration = $this->getServiceLocator()->get(get_class($this->_configuration));

        $this->assertNotNull($configuration->getApiUrl());
        $this->assertNotNull($configuration->getUsername());
        $this->assertNotNull($configuration->getPassword());
        $this->assertNotNull($configuration->getStoreId());
        $this->assertNotNull($configuration->getSslKey());
        $this->assertNotNull($configuration->getSslKeyPassword());
        $this->assertNotNull($configuration->getSslCert());
    }

}