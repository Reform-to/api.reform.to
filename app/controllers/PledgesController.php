<?php

namespace app\controllers;

use app\models\Pledgers;
use app\models\Pledges;
use lithium\action\DispatchException;
use lithium\analysis\Logger;
use li3_mailer\action\Mailer;

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
            $pledges = array();
			if ($pledger->save($this->request->data)) {

                if (isset($this->request->data['reforms'])) {
                    $pledges = $this->request->data['reforms'];
                    foreach ($pledges as $reform) {
                        $pledge = Pledges::create(array(
                            'reform_id' => $reform,
                            'pledger_id' => $pledger->id
                        ));
                        $pledge->save();
                    }
                }
			}
            $pledge = $this->request->data;

            $reforms_json = file_get_contents("http://reforms.reform.to/us/b5/", "r");
            $reforms = json_decode($reforms_json);

            // Only send an email if enough data was submitted
            $p = $pledger;
            if ($p->email && $p->full_name() && $p->title() && $p->state) {
                $success = Mailer::deliver('pledges', ['to' => $p->email,  'subject' => 'Verify Your Reform.to Pledge', 'data' => compact('pledger', 'pledges', 'reforms')]);
            } else {
                // Otherwise send the info to the main account
                $success = Mailer::deliver('errors', ['to' => 'info@reform.to', 'cc' => '', 'subject' => 'Reform.to Pledge Notice', 'data' => compact('pledger', 'pledges', 'reforms')]);

            }

            $this->_render['template'] = 'add';
		    return compact('pledge');
		}

        return compact('pledges');
    }

}

?>
