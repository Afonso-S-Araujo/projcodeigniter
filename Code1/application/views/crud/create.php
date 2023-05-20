<?php $this->load->view('comuns/header'); ?>
    <div id="container">
    	<form action="<?php echo base_url('crud/save')?>" method="post">
    		<div>
    			<div>
    				<input type="text" name="email" placeholder="Enter email" />
    			</div>
    			<div>
    				<input type="text" name="username" placeholder="Enter username" />
    			</div>
    			<div>
    				<input type="text" name="fullname" placeholder="Enter fullname" />
    			</div>
    			<div>
    				<button type="submit">Submit</button>
    			</div>
    		</div>
    	</form>
    </div>
<?php $this->load->view('comuns/footer'); ?>







