Hi,

We received a pledge at Reform.to but there is not enough information to act on a verification.

Email: <?=$pledger->email; ?>

Name: <?=$pledger->full_name(); ?>

Title: <?=$pledger->title(); ?>

State: <?=$pledger->state; ?>

<?php
$n = 0;
foreach($pledges as $pledge):
$ref = $reforms->reforms[$pledge]; ?>
$n++;
<?=$n ?>. <?=$ref->title ?>. <?=$ref->description ?>
<?php endforeach; ?>
