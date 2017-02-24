<?php

namespace Drupal\hello\Controller;

use Drupal\Core\Controller\ControllerBase;


/**
 * An example controller.
 */
class UpdateHistoryController extends ControllerBase
{

    public function content($node)
    {
        $database = \Drupal::database();
        $update_row = $database->select('hello_node_history', 'w')
            ->fields('w',['uid','update_time'])
            ->condition('nid', $node)
            ->execute()->fetchAll();

        $header = ['Update_autor','Update_time'];

        $output = array();

            foreach ($update_row as $update_rows ){
                $account = \Drupal\user\Entity\User::load($update_rows->uid);
                $name=$account->getUsername();
                $date = \Drupal::service('date.formatter')->format($update_rows->update_time,'medium');
                $output[] = [
                    'update_autor'=> $name,
                    'update_time' => $date,
                ];
        }

        $storage = \Drupal::entityTypeManager()->getStorage('node')->load($node);
        $node = $storage->getTitle();
        $count = count($update_row);

        $build[] = array(
            '#theme' => 'hello',
            '#node'  => $node,
            '#count' =>$count,

        );

        $build['table'] = [
            '#type' => 'table',
            '#header'=> $header,
            '#rows'  => $output,
        ];



        return $build;






    }
}
