<?php

namespace FirstDataTest\Framework;

use PHPUnit_Framework_TestCase,
    FirstData\Model\Card\CreditCard,
    FirstData\Configuration\StandardConfiguration,
    FirstData\Model\Amount\ChargeTotal,
    FirstData\Adapter\Curl,
    FirstData\Adapter\Response\Xml,
    FirstData\Transaction\Result\SaleResult,
    FirstData\Transaction\Sale,
    FirstDataTest\Bootstrap;

class TestCase extends PHPUnit_Framework_TestCase
{

    public function getServiceLocator()
    {
        return Bootstrap::getServiceManager();
    }

    public function newCreditCard()
    {
        return new CreditCard();
    }

    public function newValidCreditCard()
    {
        $creditCard = $this->newCreditCard();
        $creditCard->setCsc(123);
        $creditCard->setExpirationMonth(10);
        $creditCard->setExpirationYear(14);
        $creditCard->setHolderName('John Doe');
        $creditCard->setNumber('4111111111111111');

        return $creditCard;
    }

    public function newStandardConfiguration()
    {
        return new StandardConfiguration();
    }

    public function newValidStandardConfiguration()
    {
        $path = realpath(dirname(__DIR__));

        $configuration = $this->newStandardConfiguration();
        $configuration->setApiUrl('https://ws.merchanttest.firstdataglobalgateway.com/fdggwsapi/services/order.wsdl');
        $configuration->setUsername('WS1909208425._.1');
        $configuration->setPassword('Nt0NqE25');
        $configuration->setStoreId('1909208425');
        $configuration->setSslKey($path . '/Assets/Certificates/1909208425/WS1909208425._.1.key');
        $configuration->setSslKeyPassword('ckp_1284146263');
        $configuration->setSslCert($path . '/Assets/Certificates/1909208425/WS1909208425._.1.pem');

        return $configuration;
    }

    public function newChargeTotalAmount()
    {
        return new ChargeTotal();
    }

    public function newValidChargeTotalAmount()
    {
        $amount = $this->newChargeTotalAmount();
        $amount->setAmount(10);

        return $amount;
    }

    public function newCurlAdapter()
    {
        return new Curl();
    }

    public function newValidCurlAdapter()
    {
        $adapter = $this->newCurlAdapter();
        $adapter->setConfiguration($this->newValidStandardConfiguration());

        return $adapter;
    }

    public function newXmlAdapterResponse()
    {
        return new Xml();
    }

    public function newValidXmlAdapterResponse()
    {
        $response = $this->newXmlAdapterResponse();

        return $response;
    }

    public function newTransactionSaleResult()
    {
        return new SaleResult();
    }

    public function newValidTransactionSaleResult()
    {
        $result = $this->newTransactionSaleResult();

        return $result;
    }

    public function newSaleTransaction()
    {
        return new Sale();
    }

    public function newValidSaleTransaction()
    {
        $transaction = $this->newSaleTransaction();

        return $transaction;
    }

    public function getValidVariablesForSaleTransaction()
    {
        return array(
            'card' => $this->newValidCreditCard(),
            'chargeTotal' => $this->newValidChargeTotalAmount()
        );
    }

    public function getValidSaleTransactionXml($variables)
    {
        $xml = '<?xml version="1.0"?>';
        $xml .= '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/" SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/">';
        $xml .= '<SOAP-ENV:Body>';
        $xml .= '<fdggwsapi:FDGGWSApiOrderRequest xmlns:fdggwsapi="http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi" xmlns:v1="http://secure.linkpt.net/fdggwsapi/schemas_us/v1">';
        $xml .= '<v1:Transaction>';
        $xml .= '<v1:CreditCardTxType>';
        $xml .= '<v1:Type>';
        $xml .= 'sale';
        $xml .= '</v1:Type>';
        $xml .= '</v1:CreditCardTxType>';
        $xml .= '<v1:CreditCardData>';
        $xml .= '<v1:CardNumber>' . $variables['card']->getNumber() . '</v1:CardNumber>';
        $xml .= '<v1:ExpMonth>' . $variables['card']->getExpirationMonth() . '</v1:ExpMonth>';
        $xml .= '<v1:ExpYear>' . $variables['card']->getExpirationYear() . '</v1:ExpYear>';
        $xml .= '<v1:CardCodeValue>' . $variables['card']->getCsc() . '</v1:CardCodeValue>';
        $xml .= '</v1:CreditCardData>';
        $xml .= '<v1:Payment>';
        $xml .= '<v1:ChargeTotal>' . $variables['chargeTotal']->getAmount() . '</v1:ChargeTotal>';
        $xml .= '</v1:Payment>';
        $xml .= '</v1:Transaction>';
        $xml .= '</fdggwsapi:FDGGWSApiOrderRequest>';
        $xml .= '</SOAP-ENV:Body>';
        $xml .= '</SOAP-ENV:Envelope>';

        return $xml;
    }

    public function newMockAdapterForSuccess()
    {
        $response = $this->newValidXmlAdapterResponse();
        $response->setValues(array(
            'OrderId' => 123,
            'TransactionID' => 321,
            'TransactionResult' => Sale::TRANSACTION_RESULT_APPROVED
        ));

        $adapter = $this->getMockForAbstractClass(
            'FirstData\Adapter\AbstractAdapter'
        );
        $adapter->expects($this->any())
                ->method('request')
                ->will($this->returnValue($response));

        return $adapter;
    }

    public function newMockAdapterForUnsuccess()
    {
        $response = $this->newValidXmlAdapterResponse();
        $response->setValues(array(
            'TransactionResult' => 'NOT_APPROVED',
            'ErrorMessage' => 'SGS-002303: Invalid credit card number.'
        ));

        $adapter = $this->getMockForAbstractClass(
            'FirstData\Adapter\AbstractAdapter'
        );
        $adapter->expects($this->once())
            ->method('request')
            ->will($this->returnValue($response));

        return $adapter;
    }

}
