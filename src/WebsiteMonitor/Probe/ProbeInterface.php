<?php

namespace WebsiteMonitor\Probe;

interface ProbeInterface
{
    /**
     * Set probe name
     *
     * @param $name
     */
    public function setName($name);

    /**
     * Return probe name
     *
     * @return string
     */
    public function getName();

    /**
     * Perform test
     */
    public function probe();
}