<?php
/**
 * Routes declaration.
 *
 * Respect/Rest is used as a Front Controller to all requests. For more 
 * information on how it works head to http://github.com/Respect/Rest.
 *
 * @author Augusto Pascutti <augusto@phpsp.org.br>
 */
require 'bootstrap.php';

$auth                = new SkateHub\Route\Routine\Auth;
$authenticated       = function() use($auth) { return $auth(); };
$r                   = new Respect\Rest\Router();
$r->isAutoDispatched = false;
// Routes ----------------------------------------------------------------------

$r->get('/', 'SkateHub\Route\Home');

// Routines --------------------------------------------------------------------

// Appends API version variable and logged user identity for ALL routes
$r->always('Through', function() {
    return function($data) {
        if (!is_array($data)) {
            return $data;
        }
        $data['version'] = RANKING_VERSION;
        if (isset($_SESSION['user'])) {
            $data['user'] = $_SESSION['user'];
        }
        return $data;
    };
});
// Content negotiation setup for ALL routes
$r->always('Accept', array(
    'text/html'        => new Ranking\Route\Routine\Twig,
    'text/plain'       => $json = new Ranking\Route\Routine\Json,
    'application/json' => $json,
    'text/json'        => $json
));

echo $r->run();