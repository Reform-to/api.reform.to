<?php

namespace app\resources\migration;

class Pledgers extends \li3_migrations\models\Migration {

	protected $_fields = array(
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

	protected $_records = array();

	protected $_source = 'pledgers';

	public function up() {
		return $this->save();
	}

	public function down() {
		return $this->drop();
	}

}

?>
