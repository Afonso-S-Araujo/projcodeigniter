<?
/*$this->router->fetch_class() : É responsável por verificar se a
	classe chamada é Raiz.
$this->router->fetch_method(): se existe o metodo na classe.
	*/
?>
<ul class="nav menu-nav">
	<li class="
	<?=($this->router->fetch_class() == 'Raiz' && $this->router->fetch_method() == 'index')? 'active' : null;?>
	"><a href="<?=base_url()?>">Home</a></li>
	<li class="<?=($this->router->fetch_class() == 'Raiz' && $this->router->fetch_method() == 'empresa')? 'active' : null;?>"><a href="<?=base_url('empresa')?>">A Empresa</a></li>
	<li class="<?=($this->router->fetch_class() == 'Raiz' && $this->router->fetch_method() == 'servicos')? 'active' : null;?>"><a href="<?=base_url('servicos')?>">Serviços</a></li>
	<li class="">Contatos</li>
	<!-- Para os exemplos de UPLOAD -->
	<li class="">Upload</li>
	<li class="">Download</li>	
</ul>
