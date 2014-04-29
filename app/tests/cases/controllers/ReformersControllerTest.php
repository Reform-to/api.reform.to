<?php

namespace app\tests\cases\controllers;

use app\controllers\ReformersController;
use app\models\Pledgers;
use app\models\Pledges;
use app\model\Verifications;
use lithium\action\Request;
use li3_fixtures\test\Fixtures;

class ReformersControllerTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Pledgers' => 'app\tests\fixtures\PledgersFixture',
                    'Pledges' => 'app\tests\fixtures\PledgesFixture',
                    'Verifications' => 'app\tests\fixtures\VerificationsFixture'
                )
            )
        ));
        Fixtures::save('db');
    }

    public function tearDown() {
        Fixtures::clear('db');
    }

    public function testIndex() {
        $request = new Request();
        $request->data = array();
        $controller = new ReformersController(array('request' => $request));

        $result = $controller->index();
        $this->assertTrue(array_key_exists('reformers', $result));

        $reformers = $result['reformers'];

        // From the fixtures, there is only one pledger who is a verified reformer
        $this->assertEqual(1, sizeof($reformers));

        $reformer = $reformers->first();

        $this->assertTrue(array_key_exists('bioguide_id', $reformer));
        $this->assertTrue(array_key_exists('fec_id', $reformer));
        $this->assertTrue(array_key_exists('reforms', $reformer));

        $this->assertEqual(2, sizeof($reformer['reforms']));

        $reformers_json = '[{"bioguide_id":"A000001","fec_id":"","first_name":"First","middle_name":"M.","last_name":"Last","suffix":"","state":"MA","reforms":[3,4]}]';

        $this->assertEqual(
            $reformers_json,
            $reformers->to('json')
        );

    }

}
