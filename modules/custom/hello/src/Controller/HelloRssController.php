<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\HttpFoundation\Response;

/**
 * An example controller.
 */
class HelloRssController extends ControllerBase
{

    public function content()
    {
        $response = new Response();
        $response->setContent('<?xml> Mon flux xml </xml>');
        // kint($response);
        return $response;

    }
}