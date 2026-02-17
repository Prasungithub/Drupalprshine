<?php

namespace Drupal\pr_module\Controller;

use Drupal\Core\Database\Database;

class EventsController {

  public function events() {
		
	$connection = Database::getConnection();

    /*$query = $connection->select('node_field_data', 'nfd')
      ->fields('nfd', [])
      ->condition('nfd.type', 'event')
      ->condition('nfd.status', 1);

    $allEvents = $query->execute()->fetchAll();
	
	$outputallEvents = [];
    foreach ($allEvents as $erow) {
      $outputallEvents[] = [ 
			'title' => $erow->title 
		];
    }*/
	
	//echo "<pre/>";
	//print_r($outputallEvents);
	//die('27');
	
	
	$query = \Drupal::database()->select('node_field_data', 'nfd')
	  ->fields('nfd', ['nid'])
	  ->condition('nfd.status', 1)
	  ->condition('nfd.type', 'event');

	$nids = $query->execute()->fetchCol();
	$allNodes = \Drupal\node\Entity\Node::loadMultiple($nids);
	
	/*foreach ($allNodes as $node) {
	  echo $title = $node->getTitle();
	//  echo $body = $node->get('body')->value; 
	  // ... other fields as needed
	  // Do something with the blog post data
	}*/

	
	echo "<pre/>";
	print_r($allNodes);
	die('46');	
	
	
    $someinfo = "Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, 
when an unknown printer took a galley of type and scrambled it to make a type specimen book. 
It has survived not only five centuries, but also the leap into electronic typesetting,
remaining essentially unchanged. It was popularized in the 1960s with the release of Letraset
sheets containing Lorem Ipsum passages, and more recently with desktop publishing software
like Aldus PageMaker including versions of Lorem Ipsum.";

    return [
		'#theme' => 'events',
		'#allevents' => $allEvents,
		'#someinfo' => $someinfo
	  ];
  }
}
