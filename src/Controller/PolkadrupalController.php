<?php
/**
 * @file
 * Contains \Drupal\polkadrupal\Controller\HelloController.
 */
namespace Drupal\polkadrupal\Controller;
class PolkadrupalController {
  public function content() {
    return array(
      '#type' => 'markup',
      '#markup' => t('PolkaDot integration for Drupal'),
    );
  }
}