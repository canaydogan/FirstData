<?php

namespace FirstDataTest\Model\Amount;

use FirstDataTest\Framework\TestCase;

class AbstractAmountTest extends TestCase
{

    protected $_amount;

    public function setUp()
    {
        parent::setUp();
        $this->_amount = $this->getMockForAbstractClass(
            'FirstData\Model\Amount\AbstractAmount'
        );
    }

    public function testSetterAndGetter()
    {
        $this->_amount->setAmount(10);

        $this->assertEquals(10, $this->_amount->getAmount());
    }

}
