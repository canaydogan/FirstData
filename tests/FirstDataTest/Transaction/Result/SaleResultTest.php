<?php

namespace FirstDataTest\Transaction\Result;

use FirstDataTest\Transaction\Result\AbstractResult;

class SaleResultTest extends AbstractResult
{

    public function newResult()
    {
        return $this->newTransactionSaleResult();
    }

    public function newValidResult()
    {
        return $this->newValidTransactionSaleResult();
    }

}
