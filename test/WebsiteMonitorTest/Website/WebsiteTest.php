<?php

namespace WebsiteMonitorTest\Website;

use PHPUnit_Framework_TestCase;
use WebsiteMonitor\Website\Website;
use WebsiteMonitor\Exception\ProbeFailed\ProbeFailedException;

class WebsiteTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Website
     */
    protected $website;

    public function setUp()
    {
        $this->website = new Website();
    }

    public function testAddProbe()
    {
        $probe = $this->getMock('WebsiteMonitor\Probe\AbstractProbe');
        $this->website->addProbe($probe);
        $probes = $this->website->getProbes();
        $this->assertSame($probe, $probes[0]);
    }

    public function testMonitorRunsEachProbe()
    {
        $probe1 = $this->getMock('WebsiteMonitor\Probe\AbstractProbe', array('probe'));
        $probe1->expects($this->once())->method('probe');
        $this->website->addProbe($probe1);
        $probe2 = $this->getMock('WebsiteMonitor\Probe\AbstractProbe', array('probe'));
        $probe2->expects($this->once())->method('probe');
        $this->website->addProbe($probe2);
        $this->website->monitor();
    }

    public function testMonitorGathersErrors()
    {
        $probe1 = $this->getMock('WebsiteMonitor\Probe\AbstractProbe', array('probe'));
        $probe1->expects($this->once())->method('probe')
            ->will($this->throwException(new ProbeFailedException("message")));
        $this->website->addProbe($probe1);
        $this->website->monitor();
        $this->assertEquals(array('message'), $this->website->getErrors());
    }

    public function testProbeNameCanBeSet()
    {
        $this->website->setName('foobar');
        $this->assertEquals("foobar", $this->website->getName());
    }

}