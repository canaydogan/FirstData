<?php

namespace FirstData\Transaction;

use FirstData\Adapter\AbstractAdapter,
    FirstData\Transaction\Result\AbstractResult;

abstract class AbstractTransaction
{

    const TRANSACTION_RESULT_APPROVED = 'APPROVED';

    /**
     * @abstract
     * @return \FirstData\Transaction\Result\AbstractResult
     */
    abstract public function doTransaction(array $variables);

    /**
     * @var AbstractAdapter
     */
    protected $_adapter;

    /**
     * @param AbstractAdapter $adapter
     */
    public function setAdapter($adapter)
    {
        $this->_adapter = $adapter;
    }

    /**
     * @return AbstractAdapter
     */
    public function getAdapter()
    {
        return $this->_adapter;
    }

}
