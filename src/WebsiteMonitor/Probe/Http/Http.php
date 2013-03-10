<?php

namespace WebsiteMonitor\Probe\Http;

use WebsiteMonitor\Probe\AbstractProbe;
use Zend\Http\Client as HttpClient;

abstract class Http extends AbstractProbe
{

    /**
     * @var HttpClient
     */
    protected $httpClient;

    /**
     * @param \Zend\Http\Client $httpClient
     * @return $this Provides fluent interface
     */
    public function setHttpClient($httpClient)
    {
        $this->httpClient = $httpClient;
        return $this;
    }

    /**
     * @return \Zend\Http\Client
     */
    public function getHttpClient()
    {
        if (null === $this->httpClient) {
            $this->httpClient = new HttpClient();
        }
        return $this->httpClient;
    }

}