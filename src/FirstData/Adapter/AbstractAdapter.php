<?php

namespace FirstData\Adapter;

use FirstData\Configuration\AbstractConfiguration;

abstract class AbstractAdapter
{

    abstract public function request($postFields);

    /**
     * @var AbstractConfiguration
     */
    protected $_configuration;

    /**
     * @param AbstractConfiguration $configuration
     */
    public function setConfiguration(AbstractConfiguration $configuration)
    {
        $this->_configuration = $configuration;
    }

    /**
     * @return AbstractConfiguration
     */
    public function getConfiguration()
    {
        return $this->_configuration;
    }

}
