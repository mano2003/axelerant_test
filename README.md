# Site API KEY - Overview

This is the Git repo of Axelerant Test module.

## Features

A new form text field named "Site API Key" needs to be added to the "Site Information" form with the default value of “No API Key yet”.

When this form is submitted, the value that the user entered for this field should be saved as the system variable named "siteapikey".

A Drupal message should inform the user that the Site API Key has been saved with that value.

When this form is visited after the "Site API Key" is saved, the field should be populated with the correct value.

The text of the "Save configuration" button should change to "Update Configuration".

This module also provides a URL that responds with a JSON representation of a given node with the content type "page" only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".

## Usage

Enable module axelerant_test

Login as Admin and go to admin/config/system/site-information

Add a new API Key and submit the Site information form.

Go to the endpoint http://localhost/{your-site}/page_json/{api_key}/{node_id}

## Example URL

http://localhost/page_json/FOOBAR12345/17

### Spent Time

Overall time for coding 5hrs.

### References

Hook Form Alter - https://api.drupal.org/api/drupal/core%21lib%21Drupal%21Core%21Form%21form.api.php/function/hook_form_alter/8.8.x

Drupal set message - https://stefvanlooveren.me/blog/drupal-8-messenger-api-how-set-message-examples

Drupal variable - https://www.drupal.org/docs/8/converting-drupal-7-modules-to-drupal-8/step-4-convert-drupal-7-variables-to-drupal-8

EntityQueries - https://www.kgaut.net/blog/2017/drupal-8-les-entityquery-par-lexemple.html

Json API - Contenta CMS (https://github.com/contentacms/contenta_jsonapi)
