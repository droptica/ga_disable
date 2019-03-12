<?php

namespace Drupal\ga_disable\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Class CookieController.
 *
 * @package Drupal\ga_disable\Controller
 */
class CookieController extends ControllerBase {

  /**
   * Sets a cookie and redirects to the frontpage.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function setCookie() {
    setcookie("analytics_disable", TRUE, 0, '/');
    \Drupal::messenger()->addStatus($this->t('The GA opt-out cookie has been set.'));
    \Drupal::service('page_cache_kill_switch')->trigger();
    return $this->redirect('<front>');
  }

  /**
   * Removes a cookie and redirects to the frontpage.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function removeCookie() {
    setcookie("analytics_disable", FALSE, time() - 3600, '/');
    \Drupal::messenger()->addStatus($this->t('The GA opt-out cookie has been removed.'));
    \Drupal::service('page_cache_kill_switch')->trigger();
    return $this->redirect('<front>');
  }
}
