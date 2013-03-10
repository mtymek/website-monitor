<?php

namespace WebsiteMonitor\Probe\Http;

use WebsiteMonitor\Exception\ProbeFailed\InvalidHttpResponseCodeException;
use WebsiteMonitor\Exception\ProbeFailed\UnableToConnectException;
use Exception;

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
        $uri = $this->getUri();
        try {
            $response = $this->getHttpClient()->send();
        } catch (Exception $e) {
            throw new UnableToConnectException("Unable to connect to '$uri': " . $e->getMessage());
        }
        $code = $response->getStatusCode();
        if ($code !== 200) {
            throw new InvalidHttpResponseCodeException("Invalid response code ($code) when probing '$uri'.");
        }
    }
}