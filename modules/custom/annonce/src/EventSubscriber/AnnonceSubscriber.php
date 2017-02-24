<?php

namespace Drupal\annonce\EventSubscriber;

use Drupal\Core\Database\Connection;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\EventDispatcher\Event;
use Drupal\Core\Routing\CurrentRouteMatch;
use Drupal\Core\Session\AccountProxy;


/**
 * Event subscriptions for events dispatched by SimpleFbConnect.
 */
class AnnonceSubscriber implements EventSubscriberInterface {


    protected $currentUser;
    protected $routeMatch;
    protected $database;

    /**
     * Constructor.
     */
    public function __construct(AccountProxy $current_user, CurrentRouteMatch $current_route_match, Connection $database) {
        $this->currentUser = $current_user;
        $this->routeMatch = $current_route_match;
        $this->database = $database;
    }
    /**
     * Returns an array of event names this subscriber wants to listen to.
     *
     * @return array
     *   The event names to listen to
     */
    static function getSubscribedEvents() {
        $events['kernel.request'][] = ['kernel_event'];
        $events['kernel.request'][] = ['entity_annonce'];

        return $events;
    }

    public function kernel_event(Event $event)
    {
        $current_user = $this->currentUser->getDisplayName();
     //   $route_name = $this->routeMatch->getRouteName();
        //kint($route_name);
        drupal_set_message('Entity for ' . $current_user, 'status', TRUE);


    }

   public function entity_annonce(Event $event) {


        if ($this->routeMatch->getRouteName() == 'entity.annonce.canonical' ){


            $current_user = $this->currentUser->id();
            $route_name = $this->routeMatch->getRouteName();
            $annonce = $this->routeMatch->getParameter('annonce');
            $id = $annonce->id();
            $date = date('Y-m-d');
            //kint($id);


            //kint($route_name);

            $this->database->insert('annonce_history')
                ->fields(array(
                    'uid' => $current_user,
                    'nid' => $id,
                    'view_time' => time(),
                ))
                ->execute();



        }




       /*switch ($route_name) {
           case 'entity.annonce.canonical':
               drupal_set_message('Entity for ' . $current_user, 'status', TRUE);
               $this->database->insert('annonce_history')
                   ->fields(array(
                       'uid' => $username,
                       'nid' => $id,
                       'view_time' => time(),
                   ))
                   ->execute();
           case 'entity.node.canonical':
               drupal_set_message('Event for ' . $current_user, 'status', TRUE);

       }*/




    }



}