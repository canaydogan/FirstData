<?php

namespace FirstDataTest\Adapter\Response;

use FirstDataTest\Framework\TestCase;

abstract class AbstractResponse extends TestCase
{

    abstract public function newResponse();
    abstract public function newValidResponse();

    protected $_response;

    public function setUp()
    {
        parent::setUp();
        $this->_response = $this->newResponse();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Adapter\Response\AbstractResponse',
            $this->_response
        );
    }

}
