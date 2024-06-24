<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
  <?= $this->element('header_links') ?>
</head>
<body>
	<div id="container">
    <?= $this->element('navbar') ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->fetch('js'); ?>
</body>
</html>
