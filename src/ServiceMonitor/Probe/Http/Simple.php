<?php

namespace ServiceMonitor\Probe\Http;

use ServiceMonitor\Exception\ProbeFailed\InvalidHttpResponseCodeException;

class Simple extends Http
{

    public function __construct($uri = null)
    {
        if (null !== $uri) {
            $this->setUri($uri);
        }
    }

    public function setUri($uri)
    {
        $this->getHttpClient()->setUri($uri);
        return $this;
    }

    public function getUri()
    {
        return $this->getHttpClient()->getUri();
    }

    public function probe()
    {
        $response = $this->getHttpClient()->send();
        if ($response->getStatusCode() !== 200) {
            throw new InvalidHttpResponseCodeException();
        }
    }
}