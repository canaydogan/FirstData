<?php

namespace FirstDataTest\Transaction;

use FirstDataTest\Transaction\AbstractTransaction;

class ReturnTransactionTest extends AbstractTransaction
{

    public function newTransaction()
    {
        return $this->newReturnTransaction();
    }

    public function newValidTransaction()
    {
        return $this->newValidReturnTransaction();
    }

    public function testToXml()
    {
        $variables = $this->getValidVariablesForReturnTransaction();
        $xml = $this->_transaction->toXml($variables);

        $this->assertEquals($this->getValidReturnTransactionXml($variables), $xml);
    }

    public function testDoTransactionWithNoAdapter()
    {
        $this->setExpectedException('RuntimeException', 'No Adapter');

        $variables = $this->getValidVariablesForReturnTransaction();
        $this->_transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoChargeTotal()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Charge Total');

        $this->_transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForReturnTransaction();
        unset($variables['chargeTotal']);
        $this->_transaction->doTransaction($variables);
    }

    public function testDoTransactionWithNoOrder()
    {
        $this->setExpectedException('InvalidArgumentException', 'No Order');

        $this->_transaction->setAdapter($this->newMockAdapterForSuccess());
        $variables = $this->getValidVariablesForReturnTransaction();
        unset($variables['order']);
        $this->_transaction->doTransaction($variables);
    }

    public function testDoTransactionWithValidVariablesViaMockAdapter()
    {
        $variables = $this->getValidVariablesForReturnTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForSuccess());

        $result = $transaction->doTransaction($variables);

        $this->assertTrue($result->isSuccess());
        $this->assertNotNull($result->getTransactionId());
        $this->assertNull($result->getErrorMessage());
        $this->assertNotNull($result->getApprovalCode());
    }

    public function testDoTransactionWithInvalidCardNumberViaMockAdapter()
    {
        $variables = $this->getValidVariablesForReturnTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newMockAdapterForUnsuccess());

        $result = $transaction->doTransaction($variables);

        $this->assertFalse($result->isSuccess());
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
        $variables = $this->getValidVariablesForReturnTransaction();
        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newValidCurlAdapter());

        $result = $transaction->doTransaction($variables);

        $this->assertTrue($result->isSuccess());
        $this->assertNotNull($result->getTransactionId());
        $this->assertNull($result->getErrorMessage());
        $this->assertNotNull($result->getApprovalCode());
    }

    public function _testDoTransactionWithInvalidVariablesViaFirstDataRealAdapter()
    {
        $variables = $this->getValidVariablesForReturnTransaction();
        $variables['order']->setId('invalid id');

        $transaction = $this->newValidTransaction();
        $transaction->setAdapter($this->newValidCurlAdapter());

        $result = $transaction->doTransaction($variables);

        $this->assertFalse($result->isSuccess());
        $this->assertNull($result->getTransactionId());
        $this->assertNull($result->getApprovalCode());
        $this->assertEquals('SGS-005002: The transaction was not found in the database.', $result->getErrorMessage());
    }

    public function testGetAdapterViaLocator()
    {
        $transaction = $this->getServiceLocator()->get('FirstData\Transaction\ReturnTransaction');
        $this->assertInstanceOf(
            'FirstData\Adapter\AbstractAdapter',
            $transaction->getAdapter()
        );
    }

}