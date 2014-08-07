<p>Hi,</p>

<p>We received a pledge at Reform.to but there is not enough information to act on a verification.</p>

<p>
Email: <?=$pledger->email; ?><br/>
Name: <?=$pledger->full_name(); ?><br/>
Title: <?=$pledger->title(); ?><br/>
State: <?=$pledger->state; ?>
</p>

<p>
<?php
$n = 0;
foreach($pledges as $pledge):
$n++;
$ref = $reforms->reforms[$pledge]; ?>
<?=$n ?>. <?=$ref->title ?>. <?=$ref->description ?><br/>
<?php endforeach; ?>
</p>
