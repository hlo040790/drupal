<?php

namespace Drupal\email_form\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\reusable_forms\Form\ReusableFormBase;


/**
 * Defines the EmailForm class.
 */
class EmailForm extends ReusableFormBase {

    /**
     * {@inheritdoc}.
     */
    public function getFormId() {
        return 'email_form';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['Courriel'] = array(
            '#type' => 'email',
            '#title' => $this->t('Courriel'),
        );

        $form = parent::buildForm($form, $form_state);

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
       $node = \Drupal::routeMatch()->getParameter('node');
       $aid = $node->id();
        $email = $form_state->getValue('Courriel');
        $database = \Drupal::database('user8');
        //kint($email);
        //die();
        $res = $database->insert('email_form')
            ->fields(array(
                'email ' => $email,
                'aid' => $aid))
            ->execute();

        $mailManager = \Drupal::service('plugin.manager.mail');
        $mailManager ->mail('example','example_email',$email,$langcode,$params, NULL,TRUE);
    }

    function example_mail($key, &$message, $params) {
        switch($key) {
            case 'exemple_mail':
                $message['from'] = 'example@example.fr';
                $message['subject'] = t('Example subject.');
                $message['body'] = check_markup(t('Example message body.'));
               break;
        }
    }
}
