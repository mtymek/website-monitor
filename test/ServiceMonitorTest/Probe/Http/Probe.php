<?php
/**
 * Created by JetBrains PhpStorm.
 * User: mat
 * Date: 3/10/13
 * Time: 9:54 PM
 * To change this template use File | Settings | File Templates.
 */

namespace ServiceMonitorTest\Probe\Http;

use ServiceMonitor\Probe\Http\Http as AbstractHttpProbe;

class Probe extends AbstractHttpProbe
{
    public function probe()
    {
        // just a mock
    }
}