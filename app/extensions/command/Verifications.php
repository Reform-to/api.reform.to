<?php

namespace app\extensions\command;

use app\models\Pledgers;

class Verifications extends \lithium\console\Command {

    public $id;
    public $is_verified;

    public function run() {
        $this->out('show');
        $this->out('verify --id=1');
        $this->out('unverify --id=1');
    }

    public function show() {
        $pledgers = Pledgers::find('all', array(
            'with' => array(
                'Pledges',
                'Verifications'
            )
        ));

        $this->out("ID  | FEC/Bioguide ID | Email | Name | Role | Chamber | State | Status | Date | Pledges\n");

        foreach ($pledgers as $p) {
            $reforms = array();
            foreach ($p->pledges as $pledge) {
                array_push($reforms, $pledge->reform_id);
            }

            $info = array(
                str_pad($p->id, 3, " ", STR_PAD_LEFT),
                implode(array_filter(array($p->bioguide_id, $p->fec_id))),
                $p->email,
                $p->full_name(),
                $p->role,
                $p->chamber,
                $p->state,
                $p->verification->is_verified ? 'Verified' : 'Unverified',
                $p->date_created,
                implode($reforms, ', ')
            );
            $this->out(implode($info, " | "));
        }
    }

    public function verify() {

        $pledger_id = $this->id;
        $is_verified = true;

        $this->_verify($pledger_id, $is_verified);

    }

    public function unverify() {

        $pledger_id = $this->id;
        $is_verified = false;

        $this->_verify($pledger_id, $is_verified);

    }

    protected function _verify($pledger_id, $is_verified) {

        $pledger = Pledgers::find('first', array(
            'with' => array('Verifications'),
            'conditions' => array(
                'id' => $pledger_id
            )
        ));

        if (!empty($pledger)) {

            if (!empty($pledger->verification->id)) {
                $verification = $pledger->verification;
                $verification->is_verified = $is_verified;
                $verification->save();
            } else {
                $verification = \app\models\Verifications::create(array(
                    'pledger_id' => $pledger->id,
                    'is_verified' => $is_verified
                ));
                $verification->save();
            }

            $this->out("Updated pledger " . $pledger_id);
        } else {
            $this->out("Could not find pledger with ID " . $pledger_id);
        }


    }

}
?>

