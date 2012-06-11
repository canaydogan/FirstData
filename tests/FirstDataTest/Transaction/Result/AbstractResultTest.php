<?php

namespace FirstDataTest\Transaction\Result;

use FirstDataTest\Framework\TestCase;

class AbstractResultTest extends TestCase
{

    protected $_result;

    public function setUp()
    {
        parent::setUp();
        $this->_result = $this->getMockForAbstractClass(
            'FirstData\Transaction\Result\AbstractResult'
        );
    }

    public function testCreation()
    {
        $this->assertFalse($this->_result->isSuccess());
    }

    public function testSetterAndGetter()
    {
        $this->_result->setSuccess(true);
        $this->_result->setOrderId(1234);
        $this->_result->setTransactionId(4321);

        $this->assertTrue($this->_result->isSuccess());
        $this->assertEquals(1234, $this->_result->getOrderId());
        $this->_result->getTransactionId(4321, $this->_result->getTransactionId());
    }

}
