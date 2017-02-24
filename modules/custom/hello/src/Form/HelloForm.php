<?php

namespace Drupal\hello\Form;
use Drupal\Core\Ajax\AjaxResponse;
use Drupal\Core\Ajax\CssCommand;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Ajax\HtmlCommand;

/**
 * Implements an example form.
 */
class HelloForm extends FormBase {

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'hello_form';
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['first_value'] = array(
            '#type' => 'number',
            '#title' => $this->t('first value'),
            '#ajax' => array(
                'callback' => array($this, 'validateTextAjax'),
                'event' => 'change',
            ),
            '#suffix' => '<span class="text-message"></span>',
        );
        $form['operation'] = array(
            '#type' => 'radios',
            '#title' => $this->t('operation'),
            '#default_value' => 1,
            '#options' => array('+' => $this->t('ajouter'),
                                '-' => $this->t('soustract'),
                                '*' => $this->t('Multiply'),
                                '/' => $this->t('divide')),
        );
        $form['second_value'] = array(
            '#type' => 'number',
            '#title' => $this->t('second value'),
        );

        $form['actions']['#type'] = 'actions';
        $form['actions']['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('calculate'),
            '#button_type' => 'primary',
            '#states' => array(
                'disabled' => array(
                    ':input[name = "first_value"]' =>array('value'=> 0)
                ),
            ),
        );

        if (!empty($form_state->getTemporaryValue('resultat'))) {

            $form['resultat'] = array(
                '#markup' => '<br/><h2>Le resultat est :'.$form_state->getTemporaryValue('resultat').'</h2>');
        }


        return $form;
    }

    public function validateTextAjax(array &$form, FormStateInterface $form_state) {
        $css = ['border' => '2px solid green'];
        $message = 'Ajax message: veuillez saisir un nombre ' . $form_state->getValue('text');

        $response = new AjaxResponse();
        $response ->addCommand(new CssCommand('#edit-first-value', $css));
        $response ->addCommand(new HtmlCommand('.text-message', $message));

        return $response;
    }



    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
        $resultat = "";
        $operation = $form_state->getValue('operation');
        $first_value = $form_state->getValue('first_value');
        $second_value = $form_state->getValue('second_value');

            if(!is_numeric($first_value)) {
                $form_state->setErrorByName('first_value', t('field must be numeric'));
            }

            if(!is_numeric($second_value)) {
                $form_state->setErrorByName('second_value', t('field must be numeric'));
            }

            if($second_value == 0 && $operation == '/') {
                $form_state->setErrorByName('second_value', t('0 can not be divide'));
            }



        switch ($operation) {
                case '+':
                    $resultat =  $first_value + $second_value;
                    break;
                case '-':
                    $resultat =  $first_value - $second_value;
                    break;
                case '*':
                    $resultat =  $first_value * $second_value;
                    break;
                case '/':
                    $resultat =  $first_value / $second_value;
                    break;
                default:
                    echo 'merci de choisir une operation';

            }
            $form_state->setValue('resultat', $resultat);
            return $resultat;



        /*if (strlen($form_state->getValue('phone_number')) < 3) {
            $form_state->setErrorByName('phone_number', $this->t('The phone number is too short. Please enter a full phone number.'));
        }*/
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $resultat = $form_state->getValue('resultat');
        $form_state->setTemporary(array('resultat' => $resultat));
        $form_state->setRebuild();
        return $form;

        //drupal_set_message($this->t('le resultat de votre calcul est', array('@resultat' => $form_state->getValue('resultat'))));
    }


}