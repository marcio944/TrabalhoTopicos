<?php if(!class_exists('Rain\Tpl')){exit;}?><!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Pedidos de Assistência Técnica
  </h1>
  <ol class="breadcrumb">
    <li><a href="/maitenance"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><a href="/maitenance/products">Assistência Técnica</a></li>
  </ol>
</section>

<!-- Main content -->
<section class="content">

  <div class="row">
  	<div class="col-md-12">
  		<div class="box box-primary">
            
            <!--<div class="box-header">
              <a href="/admin/products/create" class="btn btn-success">Cadastrar Produto</a>
            </div> -->

            <div class="box-body no-padding">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th style="width:20px">#</th>
                    <th>Nome </th>
                    <th>E-Mail</th>
                    <th>Telefone</th>
                    <th>Produto</th>
                    <th>Descrição</th>
                    <th style="width: 300px">&nbsp;</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $counter1=-1;  if( isset($maitenance) && ( is_array($maitenance) || $maitenance instanceof Traversable ) && sizeof($maitenance) ) foreach( $maitenance as $key1 => $value1 ){ $counter1++; ?>

                  <tr>
                    <td><?php echo htmlspecialchars( $value1["idassistance"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["desname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["desemail"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["nrphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["desnameproduct"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                    <td><?php echo htmlspecialchars( $value1["description"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>

                    <td>
                      <?php if( $value1["instatus"] == 0 ){ ?>

                      <a href="/maitenance/products/<?php echo htmlspecialchars( $value1["idname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="btn btn-warning-xs"><i class="fa fa-edit"></i>Responder</a>
                      <?php } ?>

                      <a href="/maitenance/products/<?php echo htmlspecialchars( $value1["idname"], ENT_COMPAT, 'UTF-8', FALSE ); ?>/delete" onclick="return confirm('Deseja realmente excluir este registro?')" class="btn btn-success.xs"><i class="fa fa-trash"></i> Excluir</a>
                    </td>
                   
                    </td> 
                  </tr>
                  <?php } ?>

                </tbody>
              </table>
            </div>
            <!-- /.box-body -->
          </div>
  	</div>
  </div>

</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->