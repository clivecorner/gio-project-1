<?php

declare (strict_types = 1);

namespace App\Controllers;

use App\View;

class HomeController
{
    public function index(): View
    {
        return View::make('index');
    }

    public function test(): View
    {
        return View::make('test');
    }
}
