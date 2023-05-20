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
    	<a href="<?php echo base_url('crud/create/')?>">Add User</a>
    	<table>
    		<thead>
    			<tr>
    				<th>Id</th>
    				<th>Name</th>
    				<th>Email</th>
    				<th>Fullname</th>
    				<th>Edit</th>
    				<th>Del</th>
    			</tr>
    		</thead>
    		<tbody>
    		<?php if($users):?>
        		<?php foreach ($users as $user): ?>
        			<tr>
        				<td><?php echo $user->id;?></td>
        				<td><?php echo $user->username;?></td>
        				<td><?php echo $user->email;?></td>
        				<td><?php echo $user->fullname;?></td>
        				<td>
        					<a href="<?php echo base_url('crud/edit/'.$user->id)?>">Edit</a>
        				</td>
        				<td>
        					<form action="<?php echo base_url('crud/delete/'.$user->id)?>" method="post">
        						<button type="submit">Delete</button>
        					</form>
        				</td>
        			</tr>
        		<?php endforeach; ?>
    		<?php endif; ?>
    		</tbody>
    	</table>
    </div>
</body>
</html>








