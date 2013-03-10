<?php

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$monitor = new ServiceMonitor\Monitor();
$probe = new ServiceMonitor\Probe\Http\Simple('http://mateusztymek.pl');
$monitor->addProbe($probe);
$monitor->monitor();