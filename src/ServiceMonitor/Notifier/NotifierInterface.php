<?php

namespace ServiceMonitor\Notifier;

interface NotifierInterface
{
    public function notify($message);
}