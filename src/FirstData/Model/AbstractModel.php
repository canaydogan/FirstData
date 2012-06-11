<?php

namespace FirstData\Model;

abstract class AbstractModel
{

    public function __construct(array $options = null)
    {
        $this->init();
        if (is_array($options)) {
            $this->setOptions($options);
        }
    }

    public function init(){}

    public function setOptions(array $options)
    {
        $methods = get_class_methods($this);
        foreach ($options as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (in_array($method, $methods)) {
                $this->$method($value);
            }
        }
        return $this;
    }

}