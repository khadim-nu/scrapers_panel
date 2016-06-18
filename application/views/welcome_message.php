<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 40px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>
<center>
	<h1>OZONE PLAY</h1>
        <br><br><br><br>
        <h2>Admin Pannel</h2>
        <a href="<?= base_url(); ?>admin/login">Login</a> <br>
        <a href="<?= base_url(); ?>admin/register">Register</a>
        <br><br><br><br>
        <h2>Developer Pannel</h2>
        <a href="<?= base_url(); ?>developer/login">Login</a> <br>
        <a href="<?= base_url(); ?>developer/register">Register</a>
        <br><br><br><br>
        <h2>Player Pannel</h2>
        <a href="<?= base_url(); ?>player/login">Login</a> <br>
        <a href="<?= base_url(); ?>player/register">Register</a>
</center>
</body>
</html>