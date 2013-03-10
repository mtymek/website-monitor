<?php

namespace WebsiteMonitor;

use WebsiteMonitor\Exception\ProbeFailed\ProbeFailedException;

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
        // run probes
        $errors = array();
        foreach ($this->probes as $probe) {
            try {
                $probe->probe();
            } catch (ProbeFailedException $e) {
                $errors[] = $e->getMessage();
            }
        }

        // log status
        // ...

        // notify
        if (count($errors)) {
            $notifier = new Notifier\DBus();
            $notifier->notify($errors);
        }
    }
}