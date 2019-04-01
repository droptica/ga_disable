<?php

namespace Drupal\ga_disable\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Defines a form that configures forms module settings.
 */
class ModuleConfigurationForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'ga_disable_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      'ga_disable.settings',
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('ga_disable.settings');
    $form['ga_id'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Google Analytics ID'),
      '#description' => $this->t('Enter the ID used by Google Analytics, like UA-1234567-8.'),
      '#default_value' => $config->get('ga_id'),
    ];
    $form['dev_environments'] = array(
      '#type' => 'textarea',
      '#title' => $this->t('Dev environments'),
      '#default_value' => $config->get('dev_environments'),
      '#description' => $this->t('Enter the list of environments for which GA will be always disabled (in this case the cookie will be bypassed). The environment is taken from `ENV` system variable. Please put one environment in the row.'),
      '#rows' => 5,
    );
    $form['help'] = [
      '#type' => 'item',
      '#title' => t('Setting the cookie'),
      '#markup' => t('Click <a href="/ga_disable/set_cookie">here</a> to set the cookie for the session. Click <a href="/ga_disable/remove_cookie">here</a> to remove it.'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('ga_disable.settings')
      ->set('ga_id', $form_state->getValue('ga_id'))
      ->set('dev_environments', $form_state->getValue('dev_environments'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
