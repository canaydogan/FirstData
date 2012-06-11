<?php

namespace FirstDataTest\Model\Amount;

use FirstDataTest\Framework\TestCase;

abstract class AbstractAmount extends TestCase
{

    abstract public function newAmount();
    abstract public function newValidAmount();

    protected $_amount;

    public function setUp()
    {
        parent::setUp();
        $this->_amount = $this->newAmount();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Model\Amount\AbstractAmount',
            $this->_amount
        );
    }

}
