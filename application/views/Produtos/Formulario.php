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
        <h6 class="align-middle m-0 font-weight-bold text-primary"><?=!empty($produto_id) ? "Editar" : (isset($somente_visualizar) ? "Visualizar" : "Adicionar Novo")?> Produto</h6>
        <div>
            <a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>
            <?php if (!isset($somente_visualizar)) {?>
                <a class="btn btn-primary text-white" id="salvar" > Salvar </a>
            <?php }?>
        </div>
    </div>
    <div class="card-body">
        <form id="formulario" method="post" action="/produtos/salvar">
            <input type="hidden" name="produto_id" value="<?=!empty($produto_id) ? $produto_id : 0?>" />

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Nome* </label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?=!empty($produto->nome) ? $produto->nome : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <label> Fornecedor </label>
                    <select name="fornecedor_id" id="fornecedor_id" class="form-control form-control-chosen" <?=isset($somente_visualizar) ? "disabled" : ""?>>
                        <option value="" <?=!empty($produto->fornecedor_id) ? "" : "selected"?>>Selecione uma opção</option>
                        <?php foreach($fornecedores as $fornecedor) { ?>
                            <option value="<?=$fornecedor->fornecedor_id?>" <?=!empty($produto->fornecedor_id) && $fornecedor->fornecedor_id ? "selected" : ""?>> <?=$fornecedor->nome?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 col-xs-12">
                    <label> Categoria </label>
                    <select name="categoria_id" id="categoria_id" class="form-control form-control-chosen" <?=isset($somente_visualizar) ? "disabled" : ""?>>
                        <option value="" <?=!empty($produto->categoria_id) ? "" : "selected"?>>Selecione uma opção</option>
                        <?php foreach($categorias as $categoria) { ?>
                            <option value="<?=$categoria->categoria_id?>" <?=!empty($produto->categoria_id) && $categoria->fornecedor_id ? "selected" : ""?>> <?=$categoria->nome?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Peso Líquido </label>
                        <input type="number" name="peso_liquido" id="peso_liquido" class="form-control" value="<?=!empty($produto->peso_liquido) ? $produto->peso_liquido : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Peso Bruto </label>
                        <input type="number" name="peso_bruto" id="peso_bruto" class="form-control" value="<?=!empty($produto->peso_bruto) ? $produto->peso_bruto : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Preço de Venda* </label>
                        <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="preco_venda" id="preco_venda" class="form-control" value="<?=!empty($produto->preco_venda) ? $produto->preco_venda : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Preço de Custo* </label>
                        <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="preco_custo" id="preco_custo" class="form-control" value="<?=!empty($produto->preco_custo) ? $produto->preco_custo : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Estoque* </label>
                        <input type="text" oninput="this.value=this.value.replace(/[^0-9]/g,'');" name="estoque" id="estoque" class="form-control" value="<?=!empty($produto->estoque) ? $produto->estoque : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label> Descrição </label>
                        <textarea name="descricao" id="descricao" class="form-control"></textarea>
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <div class="form-group">
                        <label> Observação </label>
                        <textarea name="observacao" id="observacao" class="form-control"></textarea>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>