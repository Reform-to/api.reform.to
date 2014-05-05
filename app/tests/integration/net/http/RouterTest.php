<?php

namespace app\tests\integration\net\http;

use lithium\net\http\Router;
use lithium\action\Request;
use lithium\core\Libraries;

class RouterTest extends \lithium\test\Unit {

    public function setUp() {
        Router::reset();

        $config = Libraries::get('app');
        $file = "{$config['path']}/config/routes.php";
        file_exists($file) ? call_user_func(function() use ($file) { include $file; }) : null;
    }

    public function tearDown() {
    }

    public function testPledgesIndexRoute() {

        $expected = array('controller' => 'Pledges', 'action' => 'index', 'args' => array());

        $request = new Request(array('url' => '/pledges'));

        $result = Router::process($request);
        $this->assertEqual($expected, $result->params);

    }

    public function testPledgesAddRoute() {

        $expected = array('controller' => 'Pledges', 'action' => 'add', 'args' => array());

        $request = new Request(array('url' => '/pledges/add'));

        $result = Router::process($request);
        $this->assertEqual($expected, $result->params);

    }

    public function testReformersIndexRoute() {

        $expected = array('controller' => 'Reformers', 'action' => 'index', 'args' => array());

        $request = new Request(array('url' => '/reformers'));

        $result = Router::process($request);
        $this->assertEqual($expected, $result->params);

    }

    /**
     * We should be able to participate in content negotiation by using the
     * Accept header. However, some clients don't have an easy time with this.
     * To be practical, we can also use a file extension as a way to
     * communicate the desired media type.
     */

    public function testReformersWithMediaType() {

        $expected = array('controller' => 'Reformers', 'action' => 'index', 'args' => array(0 => ''), 'type' => 'json');

        $request = new Request(array('url' => '/reformers/index.json'));

        $result = Router::process($request);
        $this->assertEqual($expected, $result->params);

    }

}

?>
