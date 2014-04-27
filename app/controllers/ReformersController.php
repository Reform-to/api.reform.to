<?php

namespace app\controllers;

use app\models\Pledgers;

class ReformersController extends \lithium\action\Controller {

	protected function _init() {
		// the negotiate option tells li3 to serve up the proper content type
		$this->_render['negotiate'] = true; parent::_init();
	}

    public function index() {
        $reformers = array();
        return compact('reformers');
    }

}

?>
