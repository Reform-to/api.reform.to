<?php

namespace app\tests\fixtures;

class PledgesFixture extends \li3_fixtures\test\Fixture {

    protected $_model = 'app\models\Pledges';

	protected $_fields = array(
		'id'                   => array('type' => 'id'),
		'reform_id'            => array('type' => 'integer'),
		'pledger_id'           => array('type' => 'integer'),
		'date_created'         => array('type' => 'datetime'),
		'date_modified'        => array('type' => 'datetime')
	);

    protected $_records = array(
        array(
            'id'                    => 1,
            'reform_id'             => 3,
            'pledger_id'            => 1,
            'date_created'          => '2014-01-20 11:11:11',
            'date_modified'         => '2014-01-20 11:11:11'
        )
    );

}

?>
