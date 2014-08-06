<p>Dear Candidate,</p>

<p>Thank you for taking the time to visit Reform.to and submitting your pledge to support fundamental reform.</p>

<p>I wanted to take this opportunity to confirm your pledge, and ask if we have permission to list you on Reform.to as a Reformer.</p>

<p>Can you confirm that you are <?=$pledger->full_name(); ?>, <?=$pledger->title(); ?> from <?=$pledger->state ?>, and intend to support the following fundamental reform?</p>

<p>
<?php
$n = 0;
foreach($pledges as $pledge):
$n++;
$ref = $reforms->reforms[$pledge]; ?>
<?=$n ?>. <?=$ref->title ?>. <?=$ref->description ?><br/>
<?php endforeach; ?>
</p>

<p>Please do not hesitate to bring up any further questions or concerns. We look forward to hearing back from you.</p>

<p>
Sincerely,<br/>
info@reform.to
</p>
