<?php

namespace Drupal\config_override;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Config\ConfigFactoryOverrideInterface;
use Drupal\Core\Config\StorageInterface;



/**
* Example configuration override.
*/
class Overrider implements ConfigFactoryOverrideInterface {

public function loadOverrides($names) {

$overrider = array();

if (\Drupal::currentUser()->isAnonymous()) {
        $overrider['system.site'] = ['name' => 'Drupal 8'];
    }else {
        $overrider['system.site'] = ['name' => 'Intranet drupal 8'];
    }
return $overrider;
}

/**
* {@inheritdoc}
*/
public function getCacheSuffix() {
return 'ConfigExampleOverrider';
}

/**
* {@inheritdoc}
*/
public function getCacheableMetadata($name) {
return new CacheableMetadata();
}

/**
* {@inheritdoc}
*/
public function createConfigObject($name, $collection = StorageInterface::DEFAULT_COLLECTION) {
return NULL;
}

}