<?php

namespace app\resources\migration;

class Verifications extends \li3_migrations\models\Migration {

	protected $_fields = array(
		'id'                   => array('type' => 'id'),
		'pledger_id'           => array('type' => 'integer'),
        'is_verified'          => array('type' => 'boolean'),
		'date_created'         => array('type' => 'datetime'),
		'date_modified'        => array('type' => 'datetime')
	);

	protected $_records = array();

	protected $_source = 'verifications';

	public function up() {
		return $this->save();
	}

	public function down() {
		return $this->drop();
	}

}

?>
