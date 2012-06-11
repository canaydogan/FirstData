<?php

namespace FirstDataTest\Transaction\Result;

use FirstDataTest\Framework\TestCase;

abstract class AbstractResult extends TestCase
{

    abstract public function newResult();
    abstract public function newValidResult();

    protected $_result;

    public function setUp()
    {
        parent::setUp();
        $this->_result = $this->newResult();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Transaction\Result\AbstractResult',
            $this->_result
        );
    }

}
