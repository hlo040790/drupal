<?php

namespace Drupal\hello\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Datetime\DateFormatter;
//use Drupal\Core\Session\AccountProxy;
/**
 * Provides a hello block
 *
 * @Block(
 *   id = "hello_block",
 *   admin_label = @Translation("Hello!")
 * )
 */
class HelloBlock extends BlockBase implements ContainerFactoryPluginInterface
{
    protected $dateFormatter;
    //protected $accountUser;

    public function __construct(DateFormatter $dateFormatter, array $configuration, $plugin_id, $plugin_definition)
    {
       // $this->accountProxy = $accountUser;
        $this->dateFormatter = $dateFormatter;
        parent::__construct($configuration, $plugin_id, $plugin_definition);
    }

    public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition ){
    return new static(
        $container->get('date.formatter'),
        /*$container->get('current_user'),*/
        $configuration,
        $plugin_id,
        $plugin_definition
    );
}

    /**
     * Provides a hello block
     *Implements Drupal\core\Block\BlockBase::build().
     */
    public function build()
    {
        /*$date = date('H\Hi s\s');*/

        //$user = $this->accountUser->getDisplayName();
        $date = $this->dateFormatter->format(time(),'dateservice');
        return array(
            '#type' => 'markup',
            '#markup' => 'Bienvenue sur notre site. Il est ' . $date,
            '#cache' => array(
                '#keys' => ['hello_1'],
                'max-age' =>'10',
            ),
        );


    }
}