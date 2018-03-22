<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Help me find a VM size in Azure!</title>
	
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<!-- <link href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.7/cerulean/bootstrap.min.css" rel="stylesheet" integrity="sha384-zF4BRsG/fLiTGfR9QL82DrilZxrwgY/+du4p/c7J72zZj+FLYq4zY00RylP9ZjiT" crossorigin="anonymous"> -->

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/assets/css/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/flat-ui.min.css" rel="stylesheet">
    <link rel="shortcut icon" href="/assets/img/favicon.ico">
    <!-- HTML5 shim, for IE6-8 support of HTML5 elements. All other JS at the end of file. -->
    <!--[if lt IE 9]>
      <script src="/assets/js/vendor/html5shiv.js"></script>
      <script src="/assets/js/vendor/respond.min.js"></script>
    <![endif]-->
	<script src="/assets/js/vendor/video.js"></script>
    <script src="/assets/js/flat-ui.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url(); ?>">Azure VM Chooser <?php echo getenv("VMCHOOSERTITLESUFFIX"); ?></a>
    </div>
	<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url()."vmchooser/"; ?>">VM Search</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url()."vmchooser/disk/"; ?>">Disk Config</a></li>
      </ul>
	    <ul class="nav navbar-nav">
        <li><a href="<?php echo base_url()."vmchooser/csv/"; ?>">Bulk Mapping</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="https://vmchooser.portal.azure-api.net/">For Developers (API)</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
          <li><a href="https://aka.ms/vmchooserdev">Preview Edition</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo base_url()."vmchooser/about/"; ?>">About</a></li>
      </ul>
    </div>
  </div>
</nav>


        