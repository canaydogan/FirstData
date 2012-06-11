<?php

namespace FirstData\Adapter\Response;

use FirstDataTest\Adapter\Response\AbstractResponse;

class XmlTest extends AbstractResponse
{

    protected $_approvedXml = '<SOAP-ENV:Envelope xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/"><SOAP-ENV:Header/><SOAP-ENV:Body><fdggwsapi:FDGGWSApiOrderResponse xmlns:fdggwsapi="http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi"><fdggwsapi:CommercialServiceProvider>CSI</fdggwsapi:CommercialServiceProvider><fdggwsapi:TransactionTime>Mon Jun 11 05:08:59 2012</fdggwsapi:TransactionTime><fdggwsapi:TransactionID>15953530</fdggwsapi:TransactionID><fdggwsapi:ProcessorReferenceNumber>OK242C</fdggwsapi:ProcessorReferenceNumber><fdggwsapi:ProcessorResponseMessage>APPROVED</fdggwsapi:ProcessorResponseMessage><fdggwsapi:ErrorMessage/><fdggwsapi:OrderId>A-394708a7-0594-4259-9c10-7b759157d54a</fdggwsapi:OrderId><fdggwsapi:ApprovalCode>OK242C0015953530: X:</fdggwsapi:ApprovalCode><fdggwsapi:AVSResponse> X</fdggwsapi:AVSResponse><fdggwsapi:TDate>1339405737</fdggwsapi:TDate><fdggwsapi:TransactionResult>APPROVED</fdggwsapi:TransactionResult><fdggwsapi:ProcessorResponseCode>A</fdggwsapi:ProcessorResponseCode><fdggwsapi:ProcessorApprovalCode/><fdggwsapi:CalculatedTax/><fdggwsapi:CalculatedShipping/><fdggwsapi:TransactionScore>100</fdggwsapi:TransactionScore><fdggwsapi:FraudAction>ACCEPT</fdggwsapi:FraudAction><fdggwsapi:AuthenticationResponseCode/></fdggwsapi:FDGGWSApiOrderResponse></SOAP-ENV:Body></SOAP-ENV:Envelope>';

    public function newResponse()
    {
        return $this->newXmlAdapterResponse();
    }

    public function newValidResponse()
    {
        return $this->newValidXmlAdapterResponse();
    }

    public function testLoadXmlWithApprovedXml()
    {
        $this->_response->loadXml($this->_approvedXml);

        $this->assertEquals('APPROVED', $this->_response->getValueByKey('TransactionResult'));
        $this->assertEquals(
            'A-394708a7-0594-4259-9c10-7b759157d54a',
            $this->_response->getValueByKey('OrderId')
        );
    }

}
