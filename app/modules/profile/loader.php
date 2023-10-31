<?php

namespace App\Modules;

use Core\Views;

class Profile extends Views
{
    private static self|null $instance = null;
    private static string $page = "index";

    public static function start(array $get): array
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }

        $p = $get['p'] ?? "index";
        return self::getPageRequest($p);

    }

    /**
     * @param string $p ключ масиву
     * @return array
     */
    protected static function getPageRequest(string $p): array
    {
        return match ($p) {
            default => self::index()
        };

    }

    protected static function getContent($page = "index"): void
    {
        include("views/" . self::$page . ".php");
    }

    protected static function index(): array
    {
        self::$page = "profile";
        return [
            "module" => self::$instance,
            "title" => _("Profile"),
            "plugins" => ["footer" => ["customJSCode" => ["src" => "/js/modules/synchronizer.js"]]]
        ];
    }

}