<?php

namespace FirstDataTest\Adapter\Response;

use FirstDataTest\Framework\TestCase;

class AbstractResponseTest extends TestCase
{

    protected $_response;

    public function setUp()
    {
        parent::setUp();
        $this->_response = $this->getMockForAbstractClass(
            'FirstData\Adapter\Response\AbstractResponse'
        );
    }

    public function testCreation()
    {
        $this->assertInternalType('array', $this->_response->getValues());
    }

    public function testSetterAndGetter()
    {
        $values = array(1, 2, 3);
        $this->_response->setValues($values);

        $this->assertSame($values, $this->_response->getValues());
    }

    public function testAddValue()
    {
        $this->_response->addValue('key', 'value');

        $values = $this->_response->getValues();

        $this->assertCount(1, $values);
        $this->assertEquals('value', $values['key']);
    }

    public function testGetValueByKey()
    {
        $this->_response->addValue('key', 'value');

        $this->assertEquals('value', $this->_response->getValueByKey('key'));
        $this->assertNull($this->_response->getValueByKey('invalidkey'));
    }

}
