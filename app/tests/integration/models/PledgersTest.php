<?php

namespace app\tests\integration\models;

use app\models\Pledges;
use app\models\Pledgers;
use app\models\Verifications;
use li3_fixtures\test\Fixtures;

class PledgersTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Pledges' => 'app\tests\fixtures\PledgesFixture',
                    'Pledgers' => 'app\tests\fixtures\PledgersFixture',
                    'Verifications' => 'app\tests\fixtures\VerificationsFixture'
                )
            )
        ));
        Fixtures::save('db');
    }

    public function tearDown() {
        Fixtures::clear('db');
    }

    public function testWithVerifications() {

        $pledger = Pledgers::find('first', array(
            'with' => array('Verifications')
        ));

        $this->assertTrue(!empty($pledger->verification->id));

    }

    public function testWithPledges() {

        $pledger = Pledgers::find('first', array(
            'with' => array('Pledges')
        ));

        $this->assertEqual(2, $pledger->pledges->count());
    }
}

?>
