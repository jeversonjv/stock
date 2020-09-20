<div class="card shadow mb-4">

    <?php if ($this->session->flashdata("mensagemErro")) {?>
        <div class="col-lg-12 mb-2 mt-2 text-center">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <?=$this->session->flashdata("mensagemErro")?>
                </div>
            </div>
        </div>
    <?php }?>

    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="align-middle m-0 font-weight-bold text-primary"><?=!empty($categoria_id) ? "Editar" : (isset($somente_visualizar) ? "Visualizar" : "Adicionar Nova")?> Categoria</h6>
        <div>
            <a class="btn btn-secondary text-white" onClick="window.history.back()"> Voltar </a>
            <?php if (!isset($somente_visualizar)) {?>
                <a class="btn btn-primary text-white" id="salvar" > Salvar </a>
            <?php }?>
        </div>
    </div>
    <div class="card-body">
        <form id="formulario" method="post" action="/categorias/salvar">
            <input type="hidden" name="categoria_id" value="<?=!empty($categoria_id) ? $categoria_id : 0?>" />

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label> Nome* </label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?=!empty($categoria->nome) ? $categoria->nome : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-8 col-xs-12">
                    <div class="form-group">
                        <label> Descrição </label>
                        <input type="descricao" name="descricao" id="descricao" class="form-control" value="<?=!empty($categoria->descricao) ? $categoria->descricao : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>