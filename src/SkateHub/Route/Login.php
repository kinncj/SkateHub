<?php
namespace SkateHub\Route;

use \InvalidArgumentException as Argument;
use \RuntimeException as Runtime;
use Doctrine\ORM\EntityManager;
use Respect\Rest\Routable;
use Respect\Config\Container;
use SkateHub\Entity\User;

class Login implements Routable
{
    /**
     * @var Doctrine\ORM\EntityManager
     */
    protected $em;

    public function __construct(EntityManager $em=null) 
    {
        if (is_null($em)) {
            $c        = new Container(APPLICATION_CONF.DS.'Doctrine.ini');
            $this->em = $c->entityManager;
        }
    }

    public function get()
    {
        
    }

    public function post()
    {
        
    }
}