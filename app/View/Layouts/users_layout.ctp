<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $this->fetch('title'); ?>
	</title>
  <?= $this->element('header_links') ?>
  <style>
    .ui-datepicker {
        font-size: 14px;
    }
    .ui-datepicker-header {
        background-color: #007bff; /* Customize header background */
        color: white; /* Customize header text color */
    }
    .ui-datepicker-calendar td {
        padding: 5px; /* Adjust cell padding */
    }
    .ui-datepicker-calendar .ui-state-default {
        background-color: #f0f0f0; /* Customize default date cell background */
        border: 1px solid #ccc; /* Add border to date cells */
        color: #333; /* Customize default date cell text color */
    }
    .ui-datepicker-calendar .ui-state-hover {
        background-color: #007bff; /* Customize hover state */
        color: white; /* Customize hover text color */
    }

    .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .message-list {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .message-item {
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }
        .message-item:last-child {
            border-bottom: none;
        }
        .message-sender {
            font-weight: bold;
        }
        .message-date {
            color: #777;
            font-size: 0.9em;
        }
        .message-content {
            margin-top: 5px;
        }
        .message-actions {
            float: right;
        }
</style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>
<body>
	<div id="container">
    <?= $this->element('navbar') ?>
		<?php echo $this->fetch('content'); ?>
	</div>
	<?php echo $this->fetch('js'); ?>
	<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js" integrity="sha256-0YPKAwZP7Mp3ALMRVB2i8GXeEndvCq3eSl/WsAl1Ryk="   crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://rawgit.com/moment/moment/2.2.1/min/moment.min.js"></script>
</body>
</html>
