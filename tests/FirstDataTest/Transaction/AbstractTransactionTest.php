<?php

namespace FirstDataTest\Transaction\Result;

use FirstDataTest\Framework\TestCase;

class AbstractTransactionTest extends TestCase
{

    protected $_transaction;

    public function setUp()
    {
        parent::setUp();
        $this->_transaction = $this->getMockForAbstractClass(
            'FirstData\Transaction\AbstractTransaction'
        );
    }

    public function testSetterAndGetter()
    {
        $adapter = $this->newValidCurlAdapter();
        $this->_transaction->setAdapter($adapter);

        $this->assertSame($adapter, $this->_transaction->getAdapter());
    }

}
