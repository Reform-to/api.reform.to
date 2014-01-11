<?php

namespace app\tests\fixtures;

class PledgersFixture extends \li3_fixtures\test\Fixture {

    protected $_model = 'app\models\Pledgers';

	protected $_fields = array(
		'id'                   => array('type' => 'id'),
		'bioguide_id'          => array('type' => 'string'),
		'fec_id'               => array('type' => 'string'),
		'email'                => array('type' => 'string'),
		'first_name'           => array('type' => 'string'),
		'middle_name'          => array('type' => 'string'),
		'last_name'            => array('type' => 'string'),
		'suffix'               => array('type' => 'string'),
		'role'                 => array('type' => 'string'),
		'chamber'              => array('type' => 'string'),
		'state'                => array('type' => 'string'),
		'district'             => array('type' => 'string'),
		'date_created'         => array('type' => 'datetime'),
		'date_modified'        => array('type' => 'datetime')
	);

    protected $_records = array(
        array(
            'id'                    => 1,
            'bioguide_id'           => 'A000001',
            'fec_id'                => '',
            'email'                 => 'test@reform.to',
            'first_name'            => 'First',
            'middle_name'           => 'M.',
            'last_name'             => 'Last',
            'suffix'                => '',
            'role'                  => 'congress',
            'chamber'               => 'house',
            'state'                 => 'MA',
            'district'              => '1',
            'date_created'          => '2014-01-20 11:11:11',
            'date_modified'         => '2014-01-20 11:11:11'

        ),
        array(
            'id'                    => 2,
            'bioguide_id'           => '',
            'fec_id'                => 'S4XX00001',
            'email'                 => 'test@example.org',
            'first_name'            => 'First',
            'middle_name'           => 'M.',
            'last_name'             => 'Last',
            'suffix'                => '',
            'role'                  => 'candidate',
            'chamber'               => 'senate',
            'state'                 => 'MA',
            'district'              => '',
            'date_created'          => '2014-01-22 13:13:13',
            'date_modified'         => '2014-01-22 13:13:13'

        )
    );

}

?>
