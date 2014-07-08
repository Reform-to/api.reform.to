<?php foreach($reformers as $reformer): ?>
    <?php $pubDate = new DateTime($reformer->verification->date_modified); ?>
    <item>
        <title><?=$reformer->full_name(); ?></title>
         <description><?=$reformer->full_name(); ?> has pledged support for fundamental reform.</description>
         <link><?=$reformer->url(); ?></link>
         <pubDate><?=$pubDate->format(DateTime::RSS); ?></pubDate>
         <guid isPermaLink="true"><?=$reformer->url(); ?></guid>
    </item>
<?php endforeach; ?>
