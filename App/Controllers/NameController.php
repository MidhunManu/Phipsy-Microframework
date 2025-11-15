<?php

namespace App\Controllers;

use Core\Controller;

class NameController extends Controller
{
    public function index()
    {
        return $this->view('home', [
            'message' => 'micro framework',
        ]);
    }
}
