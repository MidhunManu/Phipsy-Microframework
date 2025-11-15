<?php

// namespace Core;

// use Core\View;

// class Controller
// {
//     public function view(string $name, array $data = [])
//     {
//         return View::make($name, $data);
//     }
// }


namespace Core;

class Controller
{
    public function view(string $name, array $data = [])
    {
        return View::make($name, $data);
    }
}
