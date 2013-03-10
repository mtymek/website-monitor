<?php

namespace ServiceMonitor;

use ServiceMonitor\Exception\ProbeFailed\ProbeFailedException;

class Monitor
{
    /**
     * @var Probe\ProbeInterface[]
     */
    protected $probes = array();

    public function addProbe(Probe\ProbeInterface $probe)
    {
        $this->probes[] = $probe;
    }

    public function monitor()
    {
        $errors = array();
        foreach ($this->probes as $probe) {
            try {
                $probe->probe();
            } catch (ProbeFailedException $e) {
                $errors[] = $e->getMessage();
            }
        }
        if (count($errors)) {
            $notifier = new Notifier\DBus();
            $notifier->notify($errors);
        }
    }
}