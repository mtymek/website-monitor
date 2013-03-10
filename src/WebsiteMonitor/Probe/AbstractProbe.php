<?php

namespace WebsiteMonitor\Probe;

abstract class AbstractProbe implements ProbeInterface
{
    protected $name;

    public function __construct($name = null)
    {
        $this->name = $name;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

}