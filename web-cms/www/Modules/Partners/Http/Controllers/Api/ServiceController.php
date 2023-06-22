<?php

namespace Modules\Partners\Http\Controllers\Api;

use Illuminate\Routing\Controller;

class ServiceController extends Controller
{
    protected $DOMAIN, $IPs, $CODE;

    protected function __construct($code, $ips, $domain)
    {
        $this->CODE = $code;
        $this->DOMAIN = $domain;
        $this->IPs = $ips;
    }

    protected function check_code_partner() {
        
    }
    
}
