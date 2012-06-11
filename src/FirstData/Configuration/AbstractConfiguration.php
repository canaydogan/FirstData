<?php

namespace FirstData\Configuration;

abstract class AbstractConfiguration
{

    /**
     * @var string
     */
    protected $_apiUrl;

    /**
     * @var string
     */
    protected $_username;

    /**
     * @var string
     */
    protected $_password;

    /**
     * @var string
     */
    protected $_storeId;

    /**
         * @var string
     */
    protected $_sslKey;

    /**
     * @var string
     */
    protected $_sslKeyPassword;

    /**
     * @var string
     */
    protected $_sslCert;

    /**
     * @param string $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
        $this->_apiUrl = $apiUrl;
    }

    /**
     * @return string
     */
    public function getApiUrl()
    {
        return $this->_apiUrl;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->_password = $password;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * @param string $sslCert
     */
    public function setSslCert($sslCert)
    {
        $this->_sslCert = $sslCert;
    }

    /**
     * @return string
     */
    public function getSslCert()
    {
        return $this->_sslCert;
    }

    /**
     * @param string $sslKey
     */
    public function setSslKey($sslKey)
    {
        $this->_sslKey = $sslKey;
    }

    /**
     * @return string
     */
    public function getSslKey()
    {
        return $this->_sslKey;
    }

    /**
     * @param string $sslKeyPassword
     */
    public function setSslKeyPassword($sslKeyPassword)
    {
        $this->_sslKeyPassword = $sslKeyPassword;
    }

    /**
     * @return string
     */
    public function getSslKeyPassword()
    {
        return $this->_sslKeyPassword;
    }

    /**
     * @param string $storeId
     */
    public function setStoreId($storeId)
    {
        $this->_storeId = $storeId;
    }

    /**
     * @return string
     */
    public function getStoreId()
    {
        return $this->_storeId;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->_username = $username;
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->_username;
    }

}