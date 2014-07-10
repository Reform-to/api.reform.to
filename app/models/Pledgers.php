<?php

namespace app\models;

class Pledgers extends \lithium\data\Model {

    public $hasOne = array('Verifications');

    public $hasMany = array('Pledges');

	public $validates = array();

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

    public function full_name($entity) {
        return implode(array_filter(array(
            $entity->first_name,
            $entity->middle_name,
            $entity->last_name,
            $entity->suffix
        )), ' ');
    }

    public function title($entity) {
        if ($entity->role == 'congress') {
            if ($entity->chamber == 'house') {
                return 'Representative';
            }
            if ($entity->chamber == 'senate') {
                return 'Senator';
            }
        }

        if ($entity->role == 'candidate') {
            if ($entity->chamber == 'house') {
                return 'House candidate';
            }
            if ($entity->chamber == 'senate') {
                return 'Senate candidate';
            }
        }
    }

    public function url($entity) {
        if ($entity->bioguide_id) {
            return 'http://reform.to/#/legislators/' . $entity->bioguide_id;
        } elseif ($entity->fec_id) {
            return 'http://reform.to/#/candidates/' . $entity->fec_id;
        }
    }
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
