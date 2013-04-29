<?php


namespace FirstData\Model\Order;

use FirstData\Model\AbstractModel;

abstract class AbstractOrder extends AbstractModel
{

    /**
     * @var string
     */
    protected $_id;

    /**
     * @param string $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->_id;
    }

}