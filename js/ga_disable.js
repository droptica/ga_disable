/**
 * @file
 * Provides Google Analytics opt-out.
 *
 * This file does not use behaviors. The GA variable
 * should be set on early stage of page load.
 */

if (document.cookie.match(/^(.*;)?\s*analytics_disable\s*=\s*[^;]+(.*)?$/)) {
  window['ga-disable-' + drupalSettings.ga_disable.ga_id] = true;
  console.log("Google Analytics opt-out activated.");
}
