<?php

namespace FirstDataTest\Adapter;

use FirstDataTest\Framework\TestCase;

abstract class AbstractAdapter extends TestCase
{

    abstract public function newAdapter();
    abstract public function newValidAdapter();

    protected $_adapter;

    public function setUp()
    {
        parent::setUp();
        $this->_adapter = $this->newAdapter();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Adapter\AbstractAdapter',
            $this->_adapter
        );
    }

    public function testGetConfigurationViaLocator()
    {
        $adapter = $this->getLocator()->get(get_class($this->_adapter));

        $this->assertInstanceOf(
            'FirstData\Configuration\AbstractConfiguration',
            $adapter->getConfiguration()
        );
    }

}
