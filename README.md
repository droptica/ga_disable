# Google Analytics Disable
Developed by

<a href="https://www.droptica.com/"><img src="https://www.droptica.com/themes/custom/bs/images/logo-droptica.svg" width="200" ></a>

This Drupal 8 module allows you to opt-out of Google Analytics under the following conditions:
* The `analytics_disable` cookie is set. Go to `/ga_disable/set_cookie` to set the cookie for the session. Go to `/ga_disable/remove_cookie` to remove it.

## Installation
* In your console run `composer require droptica/ga_disable`.
* Enable the `GA Disable` module on `admin/modules` page.
* Go to `Configuration > Development > GA Disable` in Drupal top menu and enter Google Analytics ID that has to be blocked.
* Save the changes and clear all caches.
