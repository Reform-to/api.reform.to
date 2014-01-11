<?php

namespace app\tests\cases\models;

use app\models\Pledges;
use li3_fixtures\test\Fixtures;

class PledgesTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Pledges' => 'app\tests\fixtures\PledgesFixture'
                )
            )
        ));
        Fixtures::save('db');
    }

    public function tearDown() {
        Fixtures::clear('db');
    }

    public function testSave() {
        $data = array(
            'reform_id' => 1,
            'pledger_id' => 1
        );

        $pledge = Pledges::create($data);

        $this->assertTrue($pledge->validates());
        $this->assertTrue($pledge->save());
    }

    public function testValidation() {
        $data = array();
        $pledge = Pledges::create($data);

        $this->assertFalse($pledge->validates());
        $this->assertFalse($pledge->save());

        $data = array(
            'reform_id' => '',
            'pledger_id' => '1'
        );
        $pledge = Pledges::create($data);

        $this->assertFalse($pledge->validates());
        $this->assertFalse($pledge->save());

        $errors = $pledge->errors();
        $this->assertTrue(!empty($errors));

        $data = array(
            'reform_id' => '1',
            'pledger_id' => ''
        );
        $pledge = Pledges::create($data);

        $this->assertFalse($pledge->validates());
        $this->assertFalse($pledge->save());

        $errors = $pledge->errors();
        $this->assertTrue(!empty($errors));
    }

}

?>
