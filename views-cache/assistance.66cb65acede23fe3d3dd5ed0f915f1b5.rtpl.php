<?php if(!class_exists('Rain\Tpl')){exit;}?> 
<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Assistência Técnica</h2>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="single-product-area">
    <div class="container">
        <div class="box">                
            <div class="col-md-6">

                <?php if( $errorRegister != '' ){ ?>

                <div class="alert alert-danger">
                    <?php echo htmlspecialchars( $errorRegister, ENT_COMPAT, 'UTF-8', FALSE ); ?>

                </div>
                <?php } ?>


               <!-- <form id="register-form-wrap" action="/register" class="register" method="post"> -->
                    <form action="/assistance" id="login-form-wrap" class="register" method="post">

                    <h2>Informações</h2>

                    <p class="form-row form-row-first">
                        <label for="nome">Nome <span class="required">*</span>
                        </label>
                        <input type="text" id="name" name="name"  style="width:490px; class="input-text" value="">
                    </p>

                    
                    <p class="form-row form-row-first"> 
                        <label for="email">E-mail <span class="required">*</span>
                        </label>
                        <input type="email" id="email" name="email" style="width:490px; class="input-text" value="">
                    </p>

                    <p class="form-row form-row-first">
                        <label for="nome">Telefone<span class="required">*</span>
                        </label>
                        <input type="text" id="phone" name="phone"  style="width:490px; class="input-text" value="">
                    </p>
                    <p class="form-row form-row-first">
                        <label for="nome">Tipo de Produto<span class="required">*</span>
                        </label>
                        <input type="text" id="desnameproduct" name="desnameproduct"  style="width:490px; class="input-text" value="">
                    </p>
                    
                     <p class="form-row form-row-first">
                        <label for="exampleFormControlTextarea1">Descrição do Problema <span class="required">*</span>
                        </label>
                        <textarea class="form-control" id="description" name="description" rows="9"></textarea>
                    </p>

                    <div class="clear"></div>

                    <p class="form-row">
                        <input type="submit" value="Enviar" name="enviar" onclick="return confirm('Deseja Realmente Enviar Essas Informações?')" class="button">
                    </p>

                    <div class="clear"></div>
                </form>               
            </div>
        </div>
    </div>
</div>