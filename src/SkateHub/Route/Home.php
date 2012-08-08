<?php
namespace Application\Route;

use \InvalidArgumentException as Argument;
use \RuntimeException as Runtime;
use Doctrine\ORM\EntityManager;
use Respect\Rest\Routable;
use Respect\Config\Container;
use SkateHub\Entity\User;

class Home implements Routable
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function get()
    {
        
    }

    public function post()
    {
        
    }
}