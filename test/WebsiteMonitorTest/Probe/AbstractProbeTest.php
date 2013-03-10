<?php

namespace WebsiteMonitorTest\Probe;

use PHPUnit_Framework_TestCase;

class AbstractProbeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Probe
     */
    protected $probe;

    public function setUp()
    {
        $this->probe = new Probe();
    }

    public function testProbeNameCanBeSet()
    {
        $this->probe->setName('foobar');
        $this->assertEquals("foobar", $this->probe->getName());
    }
}