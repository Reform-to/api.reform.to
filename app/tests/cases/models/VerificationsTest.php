<?php

namespace app\tests\cases\models;

use app\models\Verifications;
use li3_fixtures\test\Fixtures;

class VerificationsTest extends \lithium\test\Unit {

    public function setUp() {
        Fixtures::config(array(
            'db' => array(
                'adapter' => 'Connection',
                'connection' => 'default',
                'fixtures' => array(
                    'Verifications' => 'app\tests\fixtures\VerificationsFixture'
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
            'pledger_id' => 2,
            'is_verified' => true
        );

        $verification = Verifications::create($data);

        $this->assertTrue($verification->validates());
        $this->assertTrue($verification->save());
    }

    public function testValidation() {
        $data = array();
        $verification = Verifications::create($data);

        $this->assertFalse($verification->validates());
        $this->assertFalse($verification->save());

        $errors = $verification->errors();
        $this->assertTrue(!empty($errors));

        $errors = $verification->errors();
        $this->assertTrue(!empty($errors));

        $data = array(
            'pledger_id' => '',
            'is_verified' => true
        );
        $verification = Verifications::create($data);

        $this->assertFalse($verification->validates());
        $this->assertFalse($verification->save());

        $errors = $verification->errors();
        $this->assertTrue(!empty($errors));
    }

}

?>
