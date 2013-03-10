<?php

namespace ServiceMonitor\Probe\Http;

use ServiceMonitor\Probe\ProbeInterface;
use Zend\Http\Client as HttpClient;

abstract class Http implements ProbeInterface
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