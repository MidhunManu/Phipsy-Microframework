<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = (new User)->all();

        return $this->view('users', [
            'users' => $users,
        ]);
    }
}