<?php

namespace app\models;

class Pledges extends \lithium\data\Model {

	public $validates = array(
		'reform_id' => array(
			array('notEmpty', 'message' => 'reform id is empty'),
    	),
		'pledger_id' => array(
			array('notEmpty', 'message' => 'pledger id is empty'),
    	)
	);

	protected $_schema  = array(
		'id'                   => array('type' => 'id'),
		'reform_id'            => array('type' => 'integer', 'null' => false),
		'pledger_id'           => array('type' => 'integer', 'null' => false),
		'date_created'         => array('type' => 'datetime', 'null' => false),
		'date_modified'        => array('type' => 'datetime', 'null' => false)
	);
}

/**
 * Date Modified Filter
 */

Pledges::applyFilter('save', function($self, $params, $chain) {
        // Custom pre-dispatch logic goes here
        date_default_timezone_set('UTC');

        // Check if this is a new record
        if(!$params['entity']->exists()) {
            // Set the date created
            $params['data']['date_created'] = date("Y-m-d H:i:s");
        }

        // Set the date modified
        $params['data']['date_modified'] = date("Y-m-d H:i:s");

        return $chain->next($self, $params, $chain);
});
?>
