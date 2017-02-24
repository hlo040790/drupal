<?php

namespace Drupal\annonce\Entity;

use Drupal\views\EntityViewsData;
use Drupal\views\EntityViewsDataInterface;

/**
 * Provides the views data for the Annonce entity type.
 */
class AnnonceViewsData extends EntityViewsData implements EntityViewsDataInterface {
    /**
     * {@inheritdoc}
     */
    public function getViewsData() {
        $data = parent::getViewsData();

        $data['annonce_history']['table']['base'] = array(
            'field' => 'id',
            'title' => t('Annonce entity history'),
            'help' => t('The annonce entity ID.'),
        );

        $data['annonce_history']['hid'] = array(
            'title' => t('Entity ID.'),
            'help' => t('au secour.'),

            'field' => array(
                // ID of field handler plugin to use.
                'id' => 'standard',
            ),

            'sort' => array(
                // ID of sort handler plugin to use.
                'id' => 'standard',
            ),

            'filter' => array(
                // ID of filter handler plugin to use.
                'id' => 'string',
            ),

            'argument' => array(
                // ID of argument handler plugin to use.
                'id' => 'string',
            ),
        );

        $data['annonce_history']['uid'] = array(
            'title' => t('User ID'),
            'help' => t('au secour.'),

            'field' => array(
                // ID of field handler plugin to use.
                'id' => 'standard',
            ),

            'sort' => array(
                // ID of sort handler plugin to use.
                'id' => 'standard',
            ),

            'filter' => array(
                // ID of filter handler plugin to use.
                'id' => 'string',
            ),

            'argument' => array(
                // ID of argument handler plugin to use.
                'id' => 'string',
            ),
        );

        $data['annonce_history']['view_time'] = array(
            'title' => t('Timestamp of node update'),
            'help' => t('au secour.'),

            'field' => array(
                // ID of field handler plugin to use.
                'id' => 'date',
            ),

            'sort' => array(
                // ID of sort handler plugin to use.
                'id' => 'date',
            ),

            'filter' => array(
                // ID of filter handler plugin to use.
                'id' => 'date',
            ),

            'argument' => array(
                // ID of argument handler plugin to use.
                'id' => 'string',
            ),
        );

        $data['users_field_data']['table']['join'] = array(
            // Index this array by the table name to which this table refers.
            // 'left_field' is the primary key in the referenced table.
            // 'field' is the foreign key in this table.
            'tata' => array(
                'left_field' => 'uid',
                'field' => 'uid',
            ),
        );

        // Next, describe each of the individual fields in this table to Views. This
        // is done by describing $data['example_table']['FIELD_NAME']. This part of
        // the array may then have further entries:
        //   - title: The label for the table field, as presented in Views.
        //   - help: The description text for the table field.
        //   - relationship: A description of any relationship handler for the table
        //     field.
        //   - field: A description of any field handler for the table field.
        //   - sort: A description of any sort handler for the table field.
        //   - filter: A description of any filter handler for the table field.
        //   - argument: A description of any argument handler for the table field.
        //   - area: A description of any handler for adding content to header,
        //     footer or as no result behaviour.
        //
        // The handler descriptions are described with examples below.

        // Node ID table field.
        $data['users_field_data']['uid'] = array(
            'title' => t('Example content'),
            'help' => t('Some example content that references a node.'),
            // Define a relationship to the {node} table, so example_table views can
            // add a relationship to nodes. If you want to define a relationship the
            // other direction, use hook_views_data_alter(), or use the 'implicit' join
            // method described above.
            'relationship' => array(
                'base' => 'users_field_data', // The name of the table to join with.
                'base field' => 'uid', // The name of the field on the joined table.
                // 'field' => 'nid' -- see hook_views_data_alter(); not needed here.
                'handler' => 'views_handler_relationship',
                'label' => t('Default label for the relationship'),
                'title' => t('Title shown when adding the relationship'),
                'help' => t('More information on this relationship'),
            ),
        );




        return $data;
    }

}