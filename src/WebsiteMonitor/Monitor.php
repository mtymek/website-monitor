<?php

namespace WebsiteMonitor;

use WebsiteMonitor\Exception\ProbeFailed\ProbeFailedException;
use WebsiteMonitor\Website\Website;

class Monitor
{

    /**
     * @var Website[]
     */
    protected $websites;

    /**
     * @param Website $website
     */
    public function addWebsite(Website $website)
    {
        $this->websites[] = $website;
    }

    public function monitor()
    {
        $errors = array();

        foreach ($this->websites as $website) {
            $website->monitor();
            $errors = $errors + $website->getErrors();
        }

        if (count($errors)) {
            $notifier = new Notifier\DBus();
            $notifier->notify($errors);
        }
    }
}