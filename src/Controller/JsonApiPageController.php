<?php

namespace Drupal\axelerant_test\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Controller routines for axelerant_test module routes.
 * Requirement #6 : This module also provides a URL that responds with a JSON representation of a given node with the content type "page"
 * only if the previously submitted API Key and a node id (nid) of an appropriate node are present, otherwise it will respond with "access denied".
 */
class JsonApiPageController extends ControllerBase {

  /**
   * {@inheritdoc}
   * 
   * @param string $api_key
   *   A string to use, for API key.
   * @param integer $node_id
   *   A numeric to use, Node ID.
   */
  public function getData($api_key, $node_id) {
    $config = \Drupal::state();
    $site_api_key = $config->get('site_api_key'); // Get the Site API Key variable

    // Check if the API Key is Valid or not.
    if ($site_api_key == $api_key) {
      // Check if the Node ID is Numeric and greater than 0.
      if (is_numeric($node_id) && $node_id > 0) {
        if ($node = $this->getNode($node_id)) {
          // Return the JSON Response.
          $response = new JsonResponse([
            'data' => $node, 
            'method' => 'GET', 
            'status'=> 200
          ]);
        }
        else {
          $response = new JsonResponse([
            'data' => 'Access denied', 
            'method' => 'GET', 
            'status'=> 403
          ]);
        }
      } 
      else {
        $response = new JsonResponse([
          'data' => 'Access denied', 
          'method' => 'GET', 
          'status'=> 403
        ]);
      }
    }
    else {
      $response = new JsonResponse([
        'data' => 'Access denied', 
        'method' => 'GET', 
        'status'=> 403
      ]);
    }

    // Return the JSON Response.
    return $response;
  }
    
  /**
   * Utility: get node infos of given nid.
   */
  function getNode($nid) {
    $node = \Drupal\node\Entity\Node::load($nid);
    
    if (!empty($node) && $node->getType() === 'page') {
      $result = [];
      $result[] = [
        'id' => $node->id(),
        'title' => $node->getTitle(),
        'fields' => $this->getFields('page'),
      ];
          
      return $result;
    }
    else {
      return false;
    }
  }
  
  /**
   * Utility: Get fields of content type.
   */
  public function getFields($contentType) {
    $entityManager = \Drupal::service('entity.manager') ;

    $fields = [];
    $fields_tmp = [];
    if (!empty($contentType)) {
      $fields_tmp = $entityManager->getFieldDefinitions('node', $contentType);
    }

    $fields[0] = 'title';
    $cpt = 1;
    foreach($fields_tmp as $fieldsID => $field) {
      if( strpos($fieldsID, 'field_') !== false ) {
        //$fields[$fieldsID] = $field->getLabel();
        $fields[$cpt] = $fieldsID;
        $cpt++;
      }
    }

    return $fields;
  }
 
}
