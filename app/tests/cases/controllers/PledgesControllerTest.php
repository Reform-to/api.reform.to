<?php

namespace app\tests\cases\controllers;

use app\controllers\PledgesController;
use app\models\Pledgers;
use app\models\Pledges;
use lithium\action\Request;
use li3_fixtures\test\Fixtures;

class PledgesControllerTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Pledgers' => 'app\tests\fixtures\PledgersFixture',
                    'Pledges' => 'app\tests\fixtures\PledgesFixture'
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
        $controller = new PledgesController(array('request' => $request));

        $result = $controller->index();
        $this->assertTrue(array_key_exists('pledges', $result));
    }

	public function testView() {}

	public function testAdd() {
        $this->assertEqual(2, count(Pledgers::all()));
        $this->assertEqual(1, count(Pledges::all()));
        $request = new Request();
        $request->data = array(
            'email' => 'new@example.com',
            'reforms' => array(1, 3)
        );
        $controller = new PledgesController(array('request' => $request));

        $result = $controller->add();

        $this->assertTrue(array_key_exists('pledge', $result));
        $this->assertEqual($request->data['email'], $result['pledge']['email']);
        $this->assertEqual(3, count(Pledgers::all()));
        $this->assertEqual(3, count(Pledges::all()));
    }

	public function testEdit() {}

	public function testDelete() {}
}

?>
