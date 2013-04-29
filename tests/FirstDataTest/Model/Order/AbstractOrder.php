<?php


namespace FirstDataTest\Model\Order;

use FirstDataTest\Framework\TestCase;

abstract class AbstractOrder extends TestCase
{

    abstract public function newOrder();
    abstract public function newValidOrder();

    protected $_order;

    public function setUp()
    {
        $this->_order = $this->newOrder();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Model\Order\AbstractOrder',
            $this->_order
        );
    }

}