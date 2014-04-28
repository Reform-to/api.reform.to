<?php

namespace app\controllers;

use app\models\Pledgers;

class ReformersController extends \lithium\action\Controller {

	protected function _init() {
		// the negotiate option tells li3 to serve up the proper content type
		$this->_render['negotiate'] = true; parent::_init();
	}

    public function index() {

        $pledgers = Pledgers::find('all', array(
            'with' => array(
                'Pledges',
                'Verifications'
            ),
            'conditions' => array(
                'Verifications.is_verified' => true
            )
        ));

        $reformers = $pledgers->map(function($pledger) {
            $reforms = $pledger->pledges->map(function($pledge) {
                return (int) $pledge->reform_id;
            });

            $reformer = array(
                'bioguide_id' => $pledger->bioguide_id,
                'fec_id' => $pledger->fec_id,
                'reforms' => $reforms
            );

            return $reformer;
        });

        return compact('reformers');
    }

}

?>
