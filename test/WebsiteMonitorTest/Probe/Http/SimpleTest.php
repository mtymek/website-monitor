<?php

namespace WebsiteMonitorTest\Probe\Http;

use PHPUnit_Framework_TestCase;
use Zend\Http\Client as HttpClient;
use Zend\Http\Response;

use WebsiteMonitor\Probe\Http\Simple;

class SimpleTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Simple
     */
    protected $probe;

    public function setUp()
    {
        $this->probe = new Simple();
    }

    public function testSetUrlProxiesToHttpClient()
    {
        $client = $this->getMock('Zend\Http\Client', array('setUri'));
        $client->expects($this->once())->method('setUri')
            ->with('http://test.com/foobar');
        $this->probe->setHttpClient($client);
        $this->probe->setUri('http://test.com/foobar');
    }

    public function testGetUrlProxiesToHttpClient()
    {
        $client = $this->getMock('Zend\Http\Client', array('getUri'));
        $client->expects($this->once())->method('getUri')
            ->will($this->returnValue('http://test.com/foobar'));
        $this->probe->setHttpClient($client);
        $uri = $this->probe->getUri();
        $this->assertEquals('http://test.com/foobar', $uri);
    }

    public function testConstructorAllowsPassingUri()
    {
        $probe = new Simple("http://domain.com/foo/bar/baz");
        $this->assertEquals("http://domain.com/foo/bar/baz", $probe->getUri());
    }

    public function testProbePreformsHttpRequestAndChecksResponseCode()
    {
        $response = $this->getMock('Zend\Http\Response', array('getStatusCode'));
        $response->expects($this->once())->method('getStatusCode')
            ->will($this->returnValue(200));
        $client = $this->getMock('Zend\Http\Client', array('send'));
        $client->expects($this->once())->method('send')
            ->will($this->returnValue($response));
        $this->probe->setHttpClient($client);
        $this->probe->probe();
    }

    /**
     * @expectedException \WebsiteMonitor\Exception\ProbeFailed\UnableToConnectException
     */
    public function testProbeThrowsExceptionWhenClientCantConnect()
    {
        $client = $this->getMock('Zend\Http\Client', array('send'));
        $client->expects($this->once())->method('send')
            ->will($this->throwException(new \Exception()));
        $this->probe->setHttpClient($client);
        $this->probe->probe();
    }
    /**
     * @expectedException \WebsiteMonitor\Exception\ProbeFailed\InvalidHttpResponseCodeException
     */
    public function testProbeThrowsExceptionWhenResponseCodeIsNot200()
    {
        $response = $this->getMock('Zend\Http\Response', array('getStatusCode'));
        $response->expects($this->once())->method('getStatusCode')
            ->will($this->returnValue(400));
        $client = $this->getMock('Zend\Http\Client', array('send'));
        $client->expects($this->once())->method('send')
            ->will($this->returnValue($response));
        $this->probe->setHttpClient($client);
        $this->probe->probe();
    }

}