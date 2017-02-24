<?php

namespace Drupal\hello\Access;

use Drupal\Core\Access\AccessCheckInterface;
use Drupal\Core\Access\AccessResult;
use Symfony\Component\Routing\Route;
use Symfony\Component\HttpFoundation\Request;
use Drupal\Core\Session\AccountInterface;

class HelloAccessCheck implements AccessCheckInterface {

    public function applies(Route $route)
    {
        // TODO: Implement applies() method.
        return NULL;
    }

    public function access(Route $route, Request $request = NULL, AccountInterface $account){

        $param = $route->getRequirement('_access_hello');

        //kint($account);

        $user = \Drupal\user\Entity\User::load(\Drupal::currentUser()->id());

        //kint($user);

        $creation = $user->getCreatedTime();

        //kint($creation);

        $max = $param * 3600;

        if (time() - $creation < $max){

            return AccessResult::allowed();
        } else {

            return AccessResult::forbidden();

        }

    }
}
