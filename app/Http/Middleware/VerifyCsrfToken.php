<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
<<<<<<< HEAD
    
    protected $except = [
=======
   protected $except = [
>>>>>>> 0be18580eb9602488629a4aa4abc70954cd33ea8
        '/pay-via-ajax', '/success','/cancel','/fail','/ipn'
    ];
}
