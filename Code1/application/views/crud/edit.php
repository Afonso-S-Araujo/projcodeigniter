<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title><?=$title;?></title>
</head>
<body>
    <div id="container">
    	<form action="<?php echo base_url('crud/saveEdit')?>" method="post">
    		<input type="hidden" name="id" value="<?php echo $user->id ?>" />
    		<div>
    			<div>
    				<input type="text" name="email" value="<?php echo $user->email ?>" placeholder="Enter email" />
    			</div>
    			<div>
    				<input type="text" name="username" value="<?php echo $user->username ?>" placeholder="Enter username" />
    			</div>
    			<div>
    				<input type="text" name="fullname" value="<?php echo $user->fullname ?>" placeholder="Enter fullname" />
    			</div>
    			<div>
    				<button type="submit">Submit</button>
    			</div>
    		</div>
    	</form>
    </div>
</body>
</html>








