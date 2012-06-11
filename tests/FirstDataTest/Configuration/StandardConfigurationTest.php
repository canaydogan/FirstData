<?php

namespace FirstDataTest\Configuration;

use FirstDataTest\Configuration\AbstractConfiguration;

class StandardConfigurationTest extends AbstractConfiguration
{

    public function newConfiguration()
    {
        return $this->newStandardConfiguration();
    }

    public function newValidConfiguration()
    {
        return $this->newValidStandardConfiguration();
    }

}
