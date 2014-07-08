<?php echo '<?xml version="1.0" encoding="UTF-8" ?>'; ?>
    <rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
        <channel>
        <atom:link href="http://<?php echo $this->request()->env('HTTP_HOST'); ?>/reformers/index.rss" rel="self" type="application/rss+xml" />
            <title>Reform.to Reformers</title>
            <description></description>
            <link>http://reform.to/</link>
            <lastBuildDate><?= date(DATE_RSS); ?></lastBuildDate>
            <pubDate><?= date(DATE_RSS); ?></pubDate>
            <?= $this->content(); ?>
        </channel>
    </rss>
