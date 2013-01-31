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
        $this->_result->setErrorMessage('SGS-002303: Invalid credit card number.');

        $this->assertTrue($this->_result->isSuccess());
        $this->assertEquals(1234, $this->_result->getOrderId());
        $this->assertEquals(4321, $this->_result->getTransactionId());
        $this->assertEquals(
            'SGS-002303: Invalid credit card number.',
            $this->_result->getErrorMessage()
        );
    }

}
