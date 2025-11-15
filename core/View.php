<?php

namespace Core;

class View
{
    public static string $basePath;

    public static function make(string $view, array $data = [])
    {
        $path = self::$basePath . "/" . $view . ".php";

        if (!file_exists($path)) {
            throw new \Exception("View not found: $path");
        }

        extract($data);
        include $path;
    }
}
