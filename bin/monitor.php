<?php

chdir(dirname(__DIR__));

require 'vendor/autoload.php';

$probe = new WebsiteMonitor\Probe\Http\Simple('http://mateusztymek.pl');
$website = new WebsiteMonitor\Website\Website();
$website->setName("MateuszTymek.pl");
$website->addProbe($probe);
$monitor = new WebsiteMonitor\Monitor();
$monitor->addWebsite($website);
$monitor->monitor();