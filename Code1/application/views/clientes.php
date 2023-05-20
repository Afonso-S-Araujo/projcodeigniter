<?php $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
			<div class="inner">
				<h1 class="menu">Menu</h1>
				<nav>
					<?php $this->load->view('comuns/menu'); ?>
				</nav>
			</div>
		</div>
		 <div class="column">
			<table>
				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Last</th>
						<th>Email</th>
					</tr>
			     </thead>
			     <tbody>
	<?php foreach ($clientes as $cliente): ?>	
		 <tr>
			<td><?=$cliente->id ?></td>
			<td><?=$cliente->first_name ?></td>
			<td><?=$cliente->last_name?></td>
			<td><?=$cliente->email ?></td>
		 </tr>
    <?php endforeach; ?>	
			     </tbody>
			 </table>
			  <p><?php echo $links; ?></p>
		</div>
<?php $this->load->view('comuns/footer'); ?>