<?php

namespace FirstDataTest\Model\Amount;

use FirstDataTest\Model\Amount\AbstractAmount;

class ChargeTotalTest extends AbstractAmount
{

    public function newAmount()
    {
        return $this->newChargeTotalAmount();
    }

    public function newValidAmount()
    {
        return $this->newValidChargeTotalAmount();
    }

}
