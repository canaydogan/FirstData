<?php

namespace FirstData\Model\Amount;

abstract class AbstractAmount
{

    /**
     * @var float
     */
    protected $_amount;

    /**
     * @param float $amount
     */
    public function setAmount($amount)
    {
        $this->_amount = $amount;
    }

    /**
     * @return float
     */
    public function getAmount()
    {
        return $this->_amount;
    }
}
