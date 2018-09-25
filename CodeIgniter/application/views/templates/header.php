<?php
$base_url = $this->config->item('base_url');
if (!isset($title)) {
	$title = '留言板';
}
?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<title><?php echo $title; ?></title>
	<style type="text/css" media="screen">@import "<?php echo $base_url; ?>static/css/layout.css";</style>
</head>
<body>
<div id="Header">留言板</div>
<div id="Content">