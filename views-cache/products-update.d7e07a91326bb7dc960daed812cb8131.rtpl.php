<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    
    Pedido de Assistência Técnica Nº <?php echo htmlspecialchars( $maitenance["idassistance"], ENT_COMPAT, 'UTF-8', FALSE ); ?>

    
  </h1>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Responder Solicitação</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" action="/maitenance/products/<?php echo htmlspecialchars( $maitenance["idassistance"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" method="post" enctype="multipart/form-data">
          <div class="box-body">

            <p>
            <div class="form-group">
              <label for="desname">Nome</label>
              <input type="text" class="form-control" id="desname" style="width: 400px"; name="desname" placeholder="Digite o nome do produto" disabled="" value="<?php echo htmlspecialchars( $maitenance["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </p>
          <p>
            <div class="form-group">
              <label for="desemail">E-Mail</label>
              <input type="text" class="form-control" id="desemail" style="width: 400px"; name="desemail"  disabled="" value="<?php echo htmlspecialchars( $maitenance["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

          </p>
          <p>
            <div class="form-group">
              <label for="vlwidth">Telefone</label>
              <input type="text" class="form-control" id="vlwidth" name="phone" style="width: 400px"; disabled="" value="<?php echo htmlspecialchars( $maitenance["nrphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>

          </p>
          <p>
            <div class="form-group">
              <label for="vlheight">Tipo de Produto</label>
              <input type="text" class="form-control" id="vlheight" name="tipo" style="width: 400px"; disabled="" value="<?php echo htmlspecialchars( $maitenance["desnameproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </p>
          <p>
            <div class="form-group">
              <label for="vllength">Descrição do Problema</label>
              <input type="text-area" class="form-control" id="vllength" name="descricao"  style="width: 400px;  height: 100px"  disabled="" value="<?php echo htmlspecialchars( $maitenance["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
            </div>
          </p>
            <p>
            <div class="form-group">
              <label for="resposta">Respostas</label>
              <input type="text" class="form-control" id="resposta" name="resposta"  style="width: 400px; height: 100px"; value="">
            </div>
          </p>
            
          </div>
          </div>
      
          <!-- /.box-body -->
   
          <div class="box-footer">
            <button type="submit" class="btn btn-primary" onclick="return confirm('Deseja Realmente Enviar Essas Informações?')" >Enviar</button>
          </div>
        </form>
      </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<script>
document.querySelector('#file').addEventListener('change', function(){
  
  var file = new FileReader();

  file.onload = function() {
    
    document.querySelector('#image-preview').src = file.result;

  }

  file.readAsDataURL(this.files[0]);

});
</script>