WebsiteMonitor
==============

Library for testing website availability.

Note: project is at its very early stage of development.

Example usage
-------------

```php
$probe = new WebsiteMonitor\Probe\Http\Simple('http://mateusztymek.pl');
$website = new WebsiteMonitor\Website\Website();
$website->setName("MateuszTymek.pl");
$website->addProbe($probe);
$monitor = new WebsiteMonitor\Monitor();
$monitor->addWebsite($website);
$monitor->monitor();
```