<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
  <?= $this->element('header_links') ?>
</head>
    <style>
        .preview {
            max-width: 200px;
            max-height: 200px;
            margin-bottom: 10px;
        }

        .mt-10 {
            margin-top: 10px;
        }
    </style>
<body>
	<div id="container">
    <?= $this->element('navbar') ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->fetch('js'); ?>
</body>
</html>
