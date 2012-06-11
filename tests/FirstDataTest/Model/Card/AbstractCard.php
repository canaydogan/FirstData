<?php

namespace FirstDataTest\Model\Card;

use FirstDataTest\Framework\TestCase;

abstract class AbstractCard extends TestCase
{

    abstract public function newCard();
    abstract public function newValidCard();

    protected $_card;

    public function setUp()
    {
        parent::setUp();
        $this->_card = $this->newCard();
    }

    public function testCreation()
    {
        $this->assertInstanceOf(
            'FirstData\Model\Card\AbstractCard',
            $this->_card
        );
    }

}
