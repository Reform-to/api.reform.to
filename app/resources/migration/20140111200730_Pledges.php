<?php

namespace app\resources\migration;

class Pledges extends \li3_migrations\models\Migration {

	protected $_fields = array(
		'id'                   => array('type' => 'id'),
		'reform_id'            => array('type' => 'integer', 'null' => false),
		'pledger_id'           => array('type' => 'integer', 'null' => false),
		'date_created'         => array('type' => 'datetime', 'null' => false),
		'date_modified'        => array('type' => 'datetime', 'null' => false)
	);

	protected $_records = array();

	protected $_source = 'pledges';

	public function up() {
		return $this->save();
	}

	public function down() {
		return $this->drop();
	}

}

?>
