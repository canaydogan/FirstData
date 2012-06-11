<?php

namespace FirstDataTest\Model\Card;

use FirstDataTest\Model\Card\AbstractCard;

class CreditCardTest extends AbstractCard
{

    public function newCard()
    {
        return $this->newCreditCard();
    }

    public function newValidCard()
    {
        return $this->newValidCreditCard();
    }


}
