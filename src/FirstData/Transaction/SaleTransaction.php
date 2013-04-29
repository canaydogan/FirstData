<?php

namespace FirstData\Transaction;

use FirstData\Transaction\AbstractTransaction;
use FirstData\Transaction\Result\SaleResult;
use RuntimeException;
use InvalidArgumentException;

class SaleTransaction extends AbstractTransaction
{

    public function toXml($variables)
    {
        $chargeTotal = $variables['chargeTotal']->getAmount();

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
        $xml .= '<v1:ChargeTotal>' . $chargeTotal . '</v1:ChargeTotal>';
        $xml .= '</v1:Payment>';
        $xml .= '</v1:Transaction>';
        $xml .= '</fdggwsapi:FDGGWSApiOrderRequest>';
        $xml .= '</SOAP-ENV:Body>';
        $xml .= '</SOAP-ENV:Envelope>';

        return $xml;
    }

    /**
     * @return \FirstData\Transaction\Result\AbstractResult
     */
    public function doTransaction(array $variables)
    {
        if (null === $this->getAdapter()) {
            throw new RuntimeException('No Adapter');
        }

        if (!isset($variables['card']) || !$variables['card']) {
            throw new InvalidArgumentException('No Card');
        }

        if (!isset($variables['chargeTotal']) || !$variables['chargeTotal']) {
            throw new InvalidArgumentException('No Charge Total');
        }

        $result = new SaleResult();
        $xml = $this->toXml($variables);
        $response = $this->getAdapter()->request($xml);

        if (self::TRANSACTION_RESULT_APPROVED === $response->getValueByKey('TransactionResult')) {
            $result->setSuccess(true);
            $result->setOrderId($response->getValueByKey('OrderId'));
            $result->setTransactionId($response->getValueByKey('TransactionID'));
            $result->setApprovalCode($response->getValueByKey('ApprovalCode'));
        } else {
            $result->setErrorMessage($response->getValueByKey('ErrorMessage'));
        }

        return $result;
    }

}
