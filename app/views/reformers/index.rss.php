<?php foreach($reformers as $reformer):
    $pubDate = new DateTime($reformer->verification->date_modified);
    $from_state = $reformer->state ? "from $reformer->state" : '';
    $description = implode(array_filter(array(
        $reformer->title(),
        $reformer->full_name(),
        $from_state,
        'has pledged support for fundamental reform.'
    )), " ");
?>

    <item>
        <title><?=$reformer->full_name(); ?></title>
         <description><?=$description; ?></description>
         <link><?=$reformer->url(); ?></link>
         <pubDate><?=$pubDate->format(DateTime::RSS); ?></pubDate>
         <guid isPermaLink="true"><?=$reformer->url(); ?></guid>
    </item>
<?php endforeach; ?>
