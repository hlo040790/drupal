<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * An example controller.
 */
class HelloController extends ControllerBase
{

    public function content($param)
    {
        $user = $this ->currentUser();
        //kint($user);
        $userName = $user->getAccountName();
        return array('#markup' => $this->t('Votre nom d\'utilisateur est ' .$userName.' <br/> votre param est '.$param));

    }
}