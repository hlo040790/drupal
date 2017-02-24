<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\State\State;

/**
* Configure example settings for this site.
*/
class HelloAdminForm extends ConfigFormBase {
/**
* {@inheritdoc}
*/

    protected $state;

    public function __construct(state $state)
    {
        $this->state = $state;
    }

    public static function create(ContainerInterface $container){
        return new static(
            $container->get('state')
        );
    }


public function getFormId() {
return 'hello_admin_form';
}

/**
* {@inheritdoc}
*/
protected function getEditableConfigNames() {
return [
'hello.admin',
];
}

/**
* {@inheritdoc}
*/
public function buildForm(array $form, FormStateInterface $form_state) {
$config = $this->config('hello.admin');
//kint($config->get('selectionner une couleur'));
    $form['select_color'] = array(
        '#type' => 'select',
        '#title' => $this->t('selectionner une couleur'),
        '#default_value' => $config->get('block-color'),
        '#options' => [
            '1' => $this->t('vert'),
            '2' =>  $this->t('orange'),
            '3' => $this->t('bleu'),
        ],
);

return parent::buildForm($form, $form_state);
}

/**
* {@inheritdoc}
*/
public function submitForm(array &$form, FormStateInterface $form_state) {
// Retrieve the configuration
    $date = $this->state->set('select_color', $_SERVER['REQUEST_TIME']);
    //\Drupal::state()->set('select_color',$date);
// Retrieve the configuration
    $this->config('hello.admin')
        // Set the submitted configuration setting
        ->set('block-color', $form_state->getValue('select_color'))
        // You can set multiple configurations at once by making
        // multiple calls to set()
        ->save();

parent::submitForm($form, $form_state);
}

}