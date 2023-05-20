<?php $this->load->view('comuns/header'); ?>
	<body>
		<div id="container">
		
		<? 
			if(isset($info))
				echo $info;
		?>
			<div class="inner">
				<h1 class="menu">Menu</h1>
				<nav>
					<?php $this->load->view('comuns/menu'); ?>
				</nav>
			</div>
			
			<!--
			Exemplo de Upload
			-->
<form action="<?=base_url('baseupload/upload')?>" method="POST" enctype="multipart/form-data">
	<label>Selecione uma imagem
		<input type="file" name="image" />
	</label>
	
	  <div class="checkbox">
          <label>
			 <input type="checkbox" name="thumbnail"> Criar thumbnail
		 </label>
	</div>	
	<div class="form-group">
          <label>Largura da Imagem após redimensionar (em pixels)</label>
          <input type="number" name="width" class="form-control"/>
     </div>
	 <div class="form-group">
          <label>Altura da Imagem após redimensionar (em pixels)</label>
          <input type="number" name="height" class="form-control" />
     </div>
	 <div class="checkbox">
          <label>
            <input type="checkbox" name="ratio"> Manter proporção
          </label>
        </div>
	 <div class="form-group">
          <label>Rodar Imagem?
  <select name="rotation" class="form-control">
	<option value="">Não Rodar</option>
	<option value="90">90 graus</option>
	<option value="180">180 graus</option>
	<option value="270">270 graus</option>
	<option value="hor">Na Horizontal</option>
    <option value="vrt">Na vertical</option>
   </select>
		</label>
     </div>  
	 <div class="checkbox">
          <label>
            <input type="checkbox" name="crop"> Recortar imagem?
          </label>
        </div>
	 <div class="checkbox">
          <label>
            <input type="checkbox" name="watermark"> Inserir marca d'água
          </label>
        </div>
	<input type="submit" value="Processar" />
</form>
		</div>	
<?php $this->load->view('comuns/footer'); ?>