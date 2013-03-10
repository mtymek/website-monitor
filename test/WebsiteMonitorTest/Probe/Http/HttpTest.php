<?php

namespace WebsiteMonitorTest\Probe\Http;

use PHPUnit_Framework_TestCase;
use Zend\Http\Client as HttpClient;

class HttpTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Probe
     */
    protected $probe;

    public function setUp()
    {
        $this->probe = new Probe();
    }

    public function testHttpClientCanBePassedToProbe()
    {
        $client = $this->getMock('Zend\Http\Client');
        $this->probe->setHttpClient($client);
        $this->assertSame($client, $this->probe->getHttpClient());
    }

    public function testGetHttpClientCreatesDefaultInstance()
    {
        $client = $this->probe->getHttpClient();
        $this->assertInstanceOf('Zend\Http\Client', $client);
    }
}