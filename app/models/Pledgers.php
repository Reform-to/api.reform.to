<?php

namespace app\models;

class Pledgers extends \lithium\data\Model {

    public $hasOne = array('Verifications');

    public $hasMany = array('Pledges');

	public $validates = array(
		'email' => array(
			array('notEmpty', 'message' => 'email is empty'),
			array('email', 'message' => 'email is not valid')
    	)
	);

	protected $_schema = array(
		'id'                   => array('type' => 'id'),
		'bioguide_id'          => array('type' => 'string', 'null' => false),
		'fec_id'               => array('type' => 'string', 'null' => false),
		'email'                => array('type' => 'string', 'null' => false),
		'first_name'           => array('type' => 'string', 'null' => false),
		'middle_name'          => array('type' => 'string', 'null' => false),
		'last_name'            => array('type' => 'string', 'null' => false),
		'suffix'               => array('type' => 'string', 'null' => false),
		'role'                 => array('type' => 'string', 'null' => false),
		'chamber'              => array('type' => 'string', 'null' => false),
		'state'                => array('type' => 'string', 'null' => false),
		'district'             => array('type' => 'string', 'null' => false),
		'date_created'         => array('type' => 'datetime', 'null' => false),
		'date_modified'        => array('type' => 'datetime', 'null' => false)
	);
}

/**
 * Date Modified Filter
 */

Pledgers::applyFilter('save', function($self, $params, $chain) {
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
