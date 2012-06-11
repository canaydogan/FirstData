<?php

namespace FirstDataTest\Transaction;

use FirstDataTest\Framework\TestCase;

abstract class AbstractTransaction extends TestCase
{

    abstract public function newTransaction();
    abstract public function newValidTransaction();

    protected $_transaction;

    public function setUp()
    {
        parent::setUp();
        $this->_transaction = $this->newTransaction();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Transaction\AbstractTransaction',
            $this->_transaction
        );
    }

}
