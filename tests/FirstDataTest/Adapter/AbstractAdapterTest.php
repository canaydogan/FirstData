<?php

namespace FirstDataTest\Adapter;

use FirstDataTest\Framework\TestCase;

class AbstractAdapterTest extends TestCase
{

    protected $_adapter;

    public function setUp()
    {
        parent::setUp();
        $this->_adapter = $this->getMockForAbstractClass(
            'FirstData\Adapter\AbstractAdapter'
        );
    }

    public function testSetterAndGetter()
    {
        $configuration = $this->newValidStandardConfiguration();
        $this->_adapter->setConfiguration($configuration);

        $this->assertSame($configuration, $this->_adapter->getConfiguration());
    }

}
