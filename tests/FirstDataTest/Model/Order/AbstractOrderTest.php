<?php


namespace FirstDataTest\Model\Order;

use FirstDataTest\Framework\TestCase;

class AbstractOrderTest extends TestCase
{

    protected $_order;

    public function setUp()
    {
        parent::setUp();
        $this->_order = $this->getMockForAbstractClass(
            'FirstData\Model\Order\AbstractOrder'
        );
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Model\AbstractModel',
            $this->_order
        );
    }

    public function testSetterAndGetter()
    {
        $this->_order->setId('A-23232323');

        $this->assertEquals('A-23232323', $this->_order->getId());
    }

}