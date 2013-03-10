<?php

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$monitor = new WebsiteMonitor\Monitor();
$probe = new WebsiteMonitor\Probe\Http\Simple('http://mateusztymek.pl');
$monitor->addProbe($probe);
$monitor->monitor();