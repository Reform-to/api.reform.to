Dear Candidate,

Thank you for taking the time to visit Reform.to and submitting your pledge to support fundamental reform.

I wanted to take this opportunity to confirm your pledge, and ask if we have permission to list you on Reform.to as a Reformer.

Can you confirm that you are <?=$pledger->full_name(); ?>, <?=$pledger->title(); ?> from <?=$pledger->state ?>, and intend to support the following fundamental reform?

<?php
$n = 0;
foreach($pledges as $pledge):
$ref = $reforms->reforms[$pledge]; ?>
$n++;
<?=$n ?>. <?=$ref->title ?>. <?=$ref->description ?>
<?php endforeach; ?>

Please do not hesitate to bring up any further questions or concerns. We look forward to hearing back from you.

Sincerely,
info@reform.to
