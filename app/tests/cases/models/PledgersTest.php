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

    public function testFullName() {
        $pledger = Pledgers::first();
        $this->assertEqual('First M. Last', $pledger->full_name());
    }

    public function testTitle() {
        $a = Pledgers::create(array(
            'role' => 'congress',
            'chamber' => 'house'
        ));
        $this->assertEqual('Representative', $a->title());

        $b = Pledgers::create(array(
            'role' => 'congress',
            'chamber' => 'senate'
        ));
        $this->assertEqual('Senator', $b->title());

        $c = Pledgers::create(array(
            'role' => 'candidate',
            'chamber' => 'house'
        ));
        $this->assertEqual('House candidate', $c->title());

        $d = Pledgers::create(array(
            'role' => 'candidate',
            'chamber' => 'senate'
        ));
        $this->assertEqual('Senate candidate', $d->title());
    }

    public function testUrl() {
        $bio = Pledgers::find('first', array(
            'conditions' => array(
                'bioguide_id' => 'A000001'
            )
        ));

        $this->assertEqual('http://reform.to/#/legislators/A000001', $bio->url());

        $fec = Pledgers::find('first', array(
            'conditions' => array(
                'fec_id' => 'S4XX00001'
            )
        ));

        $this->assertEqual('http://reform.to/#/candidates/S4XX00001', $fec->url());

    }

}

?>
