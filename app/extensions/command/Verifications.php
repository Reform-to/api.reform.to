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
        $this->out('letter --id=1');
    }

    public function show() {
        $pledgers = Pledgers::find('all', array(
            'with' => array(
                'Pledges',
                'Verifications'
            )
        ));

        $info = array(
            array(" ID", "FEC/Bio ID", "Email", "Name", "Role", "Chamber", "State", "Status", "Pledges"),
            array(" --", "----------", "-----", "----", "----", "-------", "-----", "------", "-------")
        );

        foreach ($pledgers as $p) {
            $reforms = array();
            foreach ($p->pledges as $pledge) {
                array_push($reforms, $pledge->reform_id);
            }

            $info[] = array(
                str_pad($p->id, 3, " ", STR_PAD_LEFT),
                implode(array_filter(array($p->bioguide_id, $p->fec_id))),
                $p->email,
                $p->full_name(),
                $p->role,
                $p->chamber,
                $p->state,
                $p->verification->is_verified ? 'Verified' : 'Unverified',
                //$p->date_created,
                implode($reforms, ', ')
            );
        }
        $this->columns($info);
    }


    public function letter() {
        $pledger_id = $this->id;


        $pledger = Pledgers::find('first', array(
            'with' => array('Pledges'),
            'conditions' => array(
                'id' => $pledger_id
            )
        ));

        if (!empty($pledger)) {

            $p = $pledger;

            $nl = $this->nl();
            if ($p->chamber === 'house') {
                $chamber = "the House of Representatives";
            } else if ($p->chamber === 'senate') {
                $chamber = "the Senate";
            }

            if ($p->role === 'candidate') {
                $role = "candidate for";
            } else if ($p->role === 'congress') {
                $chamber = "member of";
            }

            $full_name = $p->full_name();
            $state = $p->state;

            $this->out("To: $p->email");
            $this->out("Subject: Verify Your Reform.to Pledge" . $nl);

            $this->out("Dear Candidate,". $nl);
            $this->out("Thank you for taking the time to visit Reform.to and submitting your pledge to support fundamental reform." . $nl);
            $this->out("I wanted to take this opportunity to confirm your pledge, and ask if we have permission to list you on Reform.to as a Reformer." . $nl);
            $this->out("Can you confirm that you are $full_name, $role $chamber from $state, and intend to support the following fundamental reform?" . $nl);

            $reforms_json = file_get_contents("http://reforms.reform.to/us/b5/", "r");
            $reforms = json_decode($reforms_json);

            $n = 0;
            foreach($p->pledges as $pledge) {
                $n++;
                $r_id = $pledge->reform_id;
                $ref = $reforms->reforms[$r_id];
                $this->out("$n. $ref->title. $ref->description ($ref->id)");
            }

            $this->out($nl . "Please do not hesitate to bring up any further questions or concerns. We look forward to hearing back from you." . $nl);
            $this->out("Sincerely," . $nl . "info@reform.to" . $nl);


        } else {
            $this->out("Could not find pledger with ID " . $pledger_id);
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

