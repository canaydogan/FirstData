<?php

namespace FirstDataTest\Transaction\Result;

use FirstDataTest\Transaction\Result\AbstractResult;

class ReturnResultTest extends AbstractResult
{

    public function newResult()
    {
        return $this->newTransactionReturnResult();
    }

    public function newValidResult()
    {
        return $this->newValidTransactionReturnResult();
    }

}
