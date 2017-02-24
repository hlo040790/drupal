<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Access\AccessException;
use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Session\AccountInterface;
use Drupal\node\Plugin\views\filter\Access;

/**
 * Provides a session block
 *
 * @Block(
 *   id = "session_block",
 *   admin_label = @Translation("Session")
 * )
 */
class SessionBlock extends BlockBase
{

    /**
     * Provides a session block
     *Implements Drupal\core\Block\BlockBase::build().
     */

    protected function blockAccess(AccountInterface $account)
    {
    // La même vérification pour un utilisateur précis.
        if ($account->hasPermission('ma permission')){
            return AccessResult::allowed();
        }

        return AccessResult::forbidden();

    }

    public function build()
    {
        $database = \Drupal::database('user8');
        $session_num = $database->select('sessions', 'w')
            ->fields('w', array('uid'))
            ->countQuery()
            ->execute()
            ->fetchField();
       // $results = db_select('sessions')->fields(NULL, array('uid'))->countQuery()->execute()->fetchField();
        return array(
            '#type' => 'markup',
            '#markup' => 'Il y a actuellement '.$session_num.' sessions actives ',
        );


    }
}