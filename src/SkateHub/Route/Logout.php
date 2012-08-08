<?php
namespace SkateHub\Route;

use Respect\Rest\Routable;

class Logout implements Routable
{
    public function get()
    {
        session_destroy();
        header('Location: /');
    }
}