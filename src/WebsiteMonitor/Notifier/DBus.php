<?php

namespace WebsiteMonitor\Notifier;

class DBus implements NotifierInterface
{
    public function notify($message)
    {
        if (is_array($message)) {
            $message = implode('\n', $message);
        }
        exec("notify-send WebsiteMonitor '$message'");
    }
}