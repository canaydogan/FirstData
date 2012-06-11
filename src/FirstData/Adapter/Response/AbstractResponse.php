<?php

namespace FirstData\Adapter\Response;

abstract class AbstractResponse
{

    /**
     * @var array
     */
    protected $_values = array();

    public function addValue($key, $value)
    {
        $this->_values[$key] = $value;
    }

    public function getValueByKey($key)
    {
        if (isset($this->_values[$key])) {
            return $this->_values[$key];
        }

        return null;
    }

    /**
     * @param array $values
     */
    public function setValues($values)
    {
        $this->_values = $values;
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->_values;
    }

}
