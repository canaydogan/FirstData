<?php

namespace FirstData\Adapter\Response;

use FirstData\Adapter\Response\AbstractResponse,
    DOMDocument;

class Xml extends AbstractResponse
{

    public function loadXml($xml)
    {
        $dom = new DOMDocument();
        $dom->loadXML($xml);

        foreach ($dom->getElementsByTagNameNS('http://secure.linkpt.net/fdggwsapi/schemas_us/fdggwsapi', '*') as $element) {
            $this->addValue($element->localName, $element->nodeValue);
        }
    }

}
