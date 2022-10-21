<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemplesController extends Controller
{
    public function index() {
        return view('admin/temples', ['temples' => []]);
    }

    public function show() {
        return view('temples/index', ['temples' => []]);
    }
}
