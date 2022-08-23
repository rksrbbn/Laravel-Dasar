<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function createSession(Request $request): string
    {
        $request->session()->put('User-Id', 'khannedy');
        $request->session()->put('Is-Member', 'true');

        return "OK";
    }

    public function getSession(Request $request): string
    {
        $userId = $request->session()->get('UserId');
        $isMember = $request->session()->get('IsMember');

        return "User Id : ${userId}, Is Member : ${isMember}";
    }
}
