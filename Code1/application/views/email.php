<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Welcome to CodeIgniter</title>
	</head>
<body>
	<div id="container">
		<form action="<?=base_url('email/send')?>" method="post" enctype="multipart/form-data">
			<div>
				<label>para</label>
				<input type="text"  name="para" />
			</div>
			<div>
				<label>para</label>
				<input type="text"  name="assunto" />
			</div>
			<div>
				<label>para</label>
				<input type="text"  name="msg" />
			</div>
			<input type="submit"  value="Processar" />
		</form>
	</div>
</body>