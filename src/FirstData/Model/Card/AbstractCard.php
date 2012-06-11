<?php

namespace FirstData\Model\Card;

use FirstData\Model\AbstractModel;

abstract class AbstractCard extends AbstractModel
{

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    protected $holderName;

    /**
     * @var string
     */
    protected $expirationMonth;

    /**
     * @var int
     */
    protected $expirationYear;

    /**
     * @Element\Property({"required" = true})
     * @Validator\NotEmpty()
     * @var string
     */
    protected $csc;

    /**
     * @param string $cvv
     */
    public function setCsc($cvv)
    {
        $this->csc = $cvv;
    }

    /**
     * @return string
     */
    public function getCsc()
    {
        return $this->csc;
    }

    /**
     * @param string $expirationMonth
     */
    public function setExpirationMonth($expirationMonth)
    {
        $this->expirationMonth = $expirationMonth;
    }

    /**
     * @return string
     */
    public function getExpirationMonth()
    {
        return $this->expirationMonth;
    }

    /**
     * @param int $expirationYear
     */
    public function setExpirationYear($expirationYear)
    {
        if (4 === strlen($expirationYear)) {
            $expirationYear = substr($expirationYear, 2);
        }
        $this->expirationYear = $expirationYear;
    }

    /**
     * @return int
     */
    public function getExpirationYear()
    {
        return $this->expirationYear;
    }

    /**
     * @param string $holderName
     */
    public function setHolderName($holderName)
    {
        $this->holderName = $holderName;
    }

    /**
     * @return string
     */
    public function getHolderName()
    {
        return $this->holderName;
    }

    /**
     * @param string $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return string
     */
    public function getNumber()
    {
        return $this->number;
    }

}
