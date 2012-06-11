<?php

namespace FirstDataTest\Model;

use FirstDataTest\Framework\TestCase;

class AbstractModelTest extends TestCase
{

    protected $_model;

    public function setUp()
    {
        $this->_model = $this->getMock('FirstData\Model\AbstractModel', array(
            'setTestProperty'
        ));
    }

    public function testOptionsIsSet()
    {
        $this->_model->expects($this->once())
            ->method('setTestProperty');

        $this->_model->setOptions(array(
            'testProperty' => 'some property'
        ));
    }

}