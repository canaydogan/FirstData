<?php

namespace FirstData\Transaction\Result;

abstract class AbstractResult
{

    /**
     * @var boolean
     */
    protected $_success = false;

    /**
     * @var string
     */
    protected $_orderId;

    /**
     * @var string
     */
    protected $_transactionId;

    /**
     * @return boolean
     */
    public function isSuccess()
    {
        return $this->_success;
    }

    /**
     * @param string $orderId
     */
    public function setOrderId($orderId)
    {
        $this->_orderId = $orderId;
    }

    /**
     * @return string
     */
    public function getOrderId()
    {
        return $this->_orderId;
    }

    /**
     * @param boolean $success
     */
    public function setSuccess($success)
    {
        $this->_success = $success;
    }

    /**
     * @param string $transactionId
     */
    public function setTransactionId($transactionId)
    {
        $this->_transactionId = $transactionId;
    }

    /**
     * @return string
     */
    public function getTransactionId()
    {
        return $this->_transactionId;
    }
}