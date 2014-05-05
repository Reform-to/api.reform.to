<?php

namespace app\controllers;

use app\models\Pledgers;
use app\models\Pledges;
use lithium\action\DispatchException;
use lithium\analysis\Logger;

class PledgesController extends \lithium\action\Controller {

	protected function _init() {
		// the negotiate option tells li3 to serve up the proper content type
		$this->_render['negotiate'] = true; parent::_init();
	}

    public function index() {
        $pledges = array();

        // Post is Create
		if ($this->request->data) {
			Logger::info(serialize($this->request->data));

		    $pledger = Pledgers::create();
			if ($pledger->save($this->request->data)) {

                if (isset($this->request->data['reforms'])) {
                    $reforms = $this->request->data['reforms'];
                    foreach ($reforms as $reform) {
                        $pledge = Pledges::create(array(
                            'reform_id' => $reform,
                            'pledger_id' => $pledger->id
                        ));
                        $pledge->save();
                    }
                }
			}
            $pledge = $this->request->data;
		    return compact('pledge');
		}

        return compact('pledges');
    }

}

?>
