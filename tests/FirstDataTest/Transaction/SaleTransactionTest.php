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

    public function testDoTransactionWithNoAdapter()
    {
        $this->setExpectedException('RuntimeException', 'No Adapter');
        $variables = $this->getValidVariablesForSaleTransaction();
        $this->_transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoCard()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Card');
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForSaleTransaction();

        unset($variables['card']);
        $transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoChargeTotal()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Charge Total');
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForSaleTransaction();

        unset($variables['chargeTotal']);
        $transaction->doTransaction($variables);
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
        $this->assertNull($result->getErrorMessage());
        $this->assertNotNull($result->getApprovalCode());
    }

    public function testDoTransactionWithInvalidCardNumberViaMockAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForUnsuccess());

        $result = $transaction->doTransaction($variables);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getOrderId());
        $this->assertNull($result->getTransactionId());
        $this->assertEquals(
            'SGS-002303: Invalid credit card number.',
            $result->getErrorMessage()
        );
    }


    /**
     * Real World Test
     */
    public function _testDoTransactionWithValidVariablesViaFirstDataRealAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newValidCurlAdapter());

        $result = $transaction->doTransaction($variables);

        $this->assertTrue($result->isSuccess());
        $this->assertNotNull($result->getOrderId());
        $this->assertNotNull($result->getTransactionId());
        $this->assertNull($result->getErrorMessage());
        $this->assertNotNull($result->getApprovalCode());
    }

    public function _testDoTransactionWithInvalidVariablesViaFirstDataRealAdapter()
    {
        $variables = $this->getValidVariablesForSaleTransaction();
        $variables['card']->setNumber('411111111111111');

        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newValidCurlAdapter());

        $result = $transaction->doTransaction($variables);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getOrderId());
        $this->assertNull($result->getTransactionId());
        $this->assertNull($result->getApprovalCode());
        $this->assertEquals('SGS-002303: Invalid credit card number.', $result->getErrorMessage());
    }

    public function testGetAdapterViaLocator()
    {
        $transaction = $this->getServiceLocator()->get('FirstData\Transaction\SaleTransaction');
        $this->assertInstanceOf(
            'FirstData\Adapter\AbstractAdapter',
            $transaction->getAdapter()
        );
    }

}
