<?php

namespace app\tests\fixtures;

class VerificationsFixture extends \li3_fixtures\test\Fixture {

    protected $_model = 'app\models\Verifications';

	protected $_fields = array(
		'id'                   => array('type' => 'id'),
		'pledger_id'           => array('type' => 'integer'),
        'is_verified'          => array('type' => 'boolean'),
		'date_created'         => array('type' => 'datetime'),
		'date_modified'        => array('type' => 'datetime')
	);

    protected $_records = array(
        array(
            'id'                    => 1,
            'pledger_id'            => 1,
            'is_verified'           => true,
            'date_created'          => '2014-01-27 11:11:11',
            'date_modified'         => '2014-01-27 11:11:11'
        )
    );


}
