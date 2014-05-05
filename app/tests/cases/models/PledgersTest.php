<?php

namespace app\tests\cases\models;

use app\models\Pledgers;
use li3_fixtures\test\Fixtures;

class PledgersTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Pledgers' => 'app\tests\fixtures\PledgersFixture'
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
            'email' => 'new@example.com',
            'first' => 'First',
            'last' => 'Last'
        );
        $pledger = Pledgers::create($data);

        $this->assertTrue($pledger->validates());
        $this->assertTrue($pledger->save());
    }

}

?>
