/**
 * @file
 * Provides Google Analytics opt-out.
 *
 * This file does not use behaviors. The GA variable
 * should be set on early stage of page load.
 */

var cookie_condition = document.cookie.match(/^(.*;)?\s*analytics_disable\s*=\s*[^;]+(.*)?$/);
var force_condition = document.getElementById("ga_disable").getAttribute("data-force") === '1';

// Check all conditions.
if (cookie_condition || force_condition) {
  var ga_id = document.getElementById("ga_disable").getAttribute("data-id");
  window['ga-disable-' + ga_id] = true;
  console.log("Google Analytics opt-out activated for " + ga_id + '.');
}
