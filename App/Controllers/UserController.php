<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = (new User)->all();

        return $this->view('users', [
            'users' => $users,
        ]);
    }

    public function show(Request $request)
    {
         $id = $request->param('id');

        $user = (new User)->find($id);

        if (!$user) {
            return $this->view('user', [
                'error' => "User not found"
            ]);
        }

        return $this->view('user', [
            'user' => $user
        ]);
    }
}