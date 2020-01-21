<?php

namespace Drupal\ga_disable\Controller;

use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\PageCache\ResponsePolicy\KillSwitch;

/**
 * Class CookieController.
 *
 * @package Drupal\ga_disable\Controller
 */
class CookieController extends ControllerBase {

  /**
   * @var Drupal\Core\PageCache\ResponsePolicy\KillSwitch
   */
  protected $killSwitch;

  /**
   * @inheritdoc
   */
  public static function create(ContainerInterface $container) {
    $kill_switch = $container->get('page_cache_kill_switch');

    return new static($kill_switch);
  }

  /**
   * CookieController constructor.
   *
   * @param \Drupal\Core\PageCache\ResponsePolicy\KillSwitch $kill_switch
   */
  public function __construct(KillSwitch $kill_switch) {
    $this->killSwitch = $kill_switch;
  }

  /**
   * Sets a cookie and redirects to the frontpage.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function setCookie() {
    $cookie_domains = array_map('trim', explode("\n", $this->config('ga_disable.settings')->get('cookie_domains')));
    setcookie("analytics_disable", TRUE, 0, '/');
    foreach (array_filter($cookie_domains) as $domain) {
      setcookie("analytics_disable", TRUE, 0, '/', $domain);
    }
    $this->killSwitch->trigger();
    return $this->redirect('<front>');
  }

  /**
   * Removes a cookie and redirects to the frontpage.
   *
   * @return \Symfony\Component\HttpFoundation\RedirectResponse
   */
  public function removeCookie() {
    $cookie_domains = array_map('trim', explode("\n", $this->config('ga_disable.settings')->get('cookie_domains')));
    setcookie("analytics_disable", FALSE, time() - 3600, '/');
    foreach (array_filter($cookie_domains) as $domain) {
      setcookie("analytics_disable", TRUE, time() - 3600, '/', $domain);
    }
    $this->killSwitch->trigger();
    return $this->redirect('<front>');
  }

}
