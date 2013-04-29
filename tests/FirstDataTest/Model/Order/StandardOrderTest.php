<?php


namespace FirstDataTest\Model\Order;

use FirstDataTest\Model\Order\AbstractOrder;

class StandardOrderTest extends AbstractOrder
{

    public function newOrder()
    {
        return $this->newStandardOrder();
    }

    public function newValidOrder()
    {
        return $this->newValidStandardOrder();
    }

}