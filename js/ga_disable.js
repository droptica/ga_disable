/**
 * @file
 * Provides Google Analytics opt-out.
 *
 * This file does not use behaviors. The GA variable
 * should be set on early stage of page load.
 */

if (document.cookie.match(/^(.*;)?\s*analytics_disable\s*=\s*[^;]+(.*)?$/)) {
  var ga_id = document.getElementById("ga_disable").getAttribute("data-id");
  window['ga-disable-' + ga_id] = true;
  console.log("Google Analytics opt-out activated for " + ga_id + '.');
}
