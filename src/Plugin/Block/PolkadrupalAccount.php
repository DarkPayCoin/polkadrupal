<?php

namespace Drupal\polkadrupal\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides a 'PolkadrupalAccount' Block.
 *
 * @Block(
 *   id = "polkadrupal_account_template",
 *   admin_label = @Translation("Polkadrupal Sign Message Example"),
 *   category = @Translation("Polkadrupal"),
 * )
 */
class PolkadrupalAccount extends BlockBase implements ContainerFactoryPluginInterface {

/**
   * DarkFacts constructor.
   *
   * @param array $configuration
   * @param $plugin_id
   * @param $plugin_definition
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
    );
  }
  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {

    return [
        '#theme' => 'polkadrupal_account_template', // custom tpl
        '#block_txt' => 'Owned accounts listed through browser extension :',
        '#title' => 'PolkaDrupal sign message example',
        '#attached' => [
          'library' => [
            'polkadrupal/polkadrupal',
            'polkadrupal/polkadrupal_js',
          ],
        ],
    ];
  }

}
