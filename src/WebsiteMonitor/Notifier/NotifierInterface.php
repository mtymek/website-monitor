<?php

namespace WebsiteMonitor\Notifier;

interface NotifierInterface
{
    public function notify($message);
}