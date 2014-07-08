<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2013, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Application &gt; <?php echo $this->title(); ?></title>
	<?php echo $this->html->style(array('bootstrap.min', 'lithified', 'reformed')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->styles(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
    <?php echo $this->html->link('Reformers Feed', '/reformers/index.rss', array('type' => 'rss')); ?>
	<link href='http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:800|Open+Sans:300' rel='stylesheet' type='text/css'>
</head>

<body class="lithified">
	<div class="container-narrow">

		<div class="masthead">
        <a href="http://reform.to"><strong>Reform.to</strong></a>
        &middot;
        <a href="/reformers">Reformers</a>
		</div>

		<hr>

		<div class="content">
			<?php echo $this->content(); ?>
		</div>

		<hr>

		<div class="footer">
		</div>

	</div>
</body>
</html>
