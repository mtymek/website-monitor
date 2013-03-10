<?php

namespace WebsiteMonitor\Website;

use WebsiteMonitor\Exception\ProbeFailed\ProbeFailedException;
use WebsiteMonitor\Probe\ProbeInterface;

class Website
{
    /**
     * @var ProbeInterface[]
     */
    protected $probes = array();

    /**
     * Errors gathered from probes
     * @var string[]
     */
    protected $errors = array();

    /**
     * @var string
     */
    protected $name;

    /**
     * Add new probe
     * @param ProbeInterface $probe
     */
    public function addProbe(ProbeInterface $probe)
    {
        $this->probes[] = $probe;
    }

    /**
     * Run all probes
     */
    public function monitor()
    {
        $this->clearErrors();
        foreach ($this->probes as $probe) {
            try {
                $probe->probe();
            } catch (ProbeFailedException $e) {
                $this->errors[] = $e->getMessage();
            }
        }
    }

    /**
     *
     */
    public function clearErrors()
    {
        $this->errors = array();
    }

    /**
     * @return string[]
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    public function getProbes()
    {
        return $this->probes;
    }

}