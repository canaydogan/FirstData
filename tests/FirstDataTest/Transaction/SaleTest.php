<?php

namespace FirstDataTest\Transaction;

use FirstDataTest\Transaction\AbstractTransaction;

class SaleTest extends AbstractTransaction
{

    public function newTransaction()
    {
        return $this->newSaleTransaction();
    }

    public function newValidTransaction()
    {
        return $this->newValidSaleTransaction();
    }

    public function testToXml()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $xml = $this->_transaction->toXml($variables);

        $this->assertEquals($this->getValidSaleTransactionXml($variables), $xml);
    }

    public function testDoTransactionWithValidVariablesViaMockAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());

        $result = $transaction->doTransaction($variables);

        $this->assertTrue($result->isSuccess());
        $this->assertNotNull($result->getOrderId());
        $this->assertNotNull($result->getTransactionId());
    }

    public function testDoTransactionWithInvalidCardNumberViaMockAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $variables['card']->setNumber('invalidnumber');
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForUnsuccess());

        $result = $transaction->doTransaction($variables);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getOrderId());
        $this->assertNull($result->getTransactionId());
    }

    public function testDoTransactionWithNoAdapter()
    {
        $this->setExpectedException('RuntimeException', 'No Adapter');
        $variables = $this->getValidVariablesForSaleTransaction();
        $this->_transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoCard()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Card Model');
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForSaleTransaction();

        unset($variables['card']);
        $transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoChargeTotal()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Charge Total Model');
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForSaleTransaction();

        unset($variables['chargeTotal']);
        $transaction->doTransaction($variables);
    }

    /**
     * Real World Test
     */
    public function testDoTransactionWithValidVariablesViaFirstDatRealAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newValidCurlAdapter());

        $result = $transaction->doTransaction($variables);

        $this->assertTrue($result->isSuccess());
        $this->assertNotNull($result->getOrderId());
        $this->assertNotNull($result->getTransactionId());
    }

    public function testGetAdapterViaLocator()
    {
        $transaction = $this->getLocator()->get('FirstData\Transaction\Sale');
        $this->assertInstanceOf(
            'FirstData\Adapter\AbstractAdapter',
            $transaction->getAdapter()
        );
    }

}
