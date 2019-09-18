<?php

/**
 * @file
 * Enables modules and site configuration for a standard site installation.
 */

use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter() for install_configure_form().
 *
 * Allows the profile to alter the site configuration form.
 */
function cadets_canada_form_install_configure_form_alter(&$form, FormStateInterface $form_state) {

  // Account information defaults.
  $form['admin_account']['account']['name']['#default_value'] = 'ccadmin';
  $form['site_information']['site_mail']['#default_value'] = 'eric_bremner@bell.net';
  $form['admin_account']['account']['mail']['#default_value'] = 'eric_bremner@bell.net';

  // Date/time settings.
  $form['regional_settings']['site_default_country']['#default_value'] = 'CA';
  $form['regional_settings']['date_default_timezone']['#default_value'] = 'America/Toronto';

  // Update notification defaults.
  $form['update_notifications']['enable_update_status_emails']['#default_value'] = 0;
}
