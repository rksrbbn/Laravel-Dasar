<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RedirectController extends Controller
{
    public function redirectHello()
    {
        return \Illuminate\Support\Facades\URL::current();
    }
}
