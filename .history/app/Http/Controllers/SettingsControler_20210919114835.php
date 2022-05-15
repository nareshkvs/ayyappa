<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsControler extends Controller
{
    public function index() {
        return view('settings');
    }
}
