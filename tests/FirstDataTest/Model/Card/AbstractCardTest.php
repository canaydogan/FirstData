<?php

namespace FirstDataTest\Model\Card;

use FirstDataTest\Framework\TestCase;

class AbstractCardTest extends TestCase
{

    protected $_card;

    public function setUp()
    {
        parent::setUp();
        $this->_card = $this->getMockForAbstractClass(
            'FirstData\Model\Card\AbstractCard'
        );
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Model\AbstractModel',
            $this->_card
        );
    }

    public function testSetterAndGetter()
    {
        $this->_card->setNumber(4111111111111111);
        $this->_card->setHolderName('John Doe');
        $this->_card->setExpirationMonth(10);
        $this->_card->setExpirationYear(13);
        $this->_card->setCsc(123);

        $this->assertEquals(
            4111111111111111,
            $this->_card->getNumber()
        );
        $this->assertEquals('John Doe', $this->_card->getHolderName());
        $this->assertEquals(10, $this->_card->getExpirationMonth());
        $this->assertEquals(13, $this->_card->getExpirationYear());
        $this->assertEquals(123, $this->_card->getCsc());
    }

    public function testSetExpiration()
    {
        $this->_card->setExpirationYear(2012);
        $this->assertEquals(12, $this->_card->getExpirationYear());

        $this->_card->setExpirationYear(14);
        $this->assertEquals(14, $this->_card->getExpirationYear());
    }

}