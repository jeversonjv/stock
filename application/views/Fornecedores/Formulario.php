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
        <h6 class="align-middle m-0 font-weight-bold text-primary"><?=!empty($fornecedor_id) ? "Editar" : (isset($somente_visualizar) ? "Visualizar" : "Adicionar Novo")?> Fornecedor</h6>
        <div>
            <a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>
            <?php if (!isset($somente_visualizar)) {?>
                <a class="btn btn-primary text-white" id="salvar" > Salvar </a>
            <?php }?>
        </div>
    </div>
    <div class="card-body">
        <form id="formulario" method="post" action="/fornecedores/salvar">
            <input type="hidden" name="fornecedor_id" value="<?=!empty($fornecedor_id) ? $fornecedor_id : 0?>" />

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Nome* </label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?=!empty($fornecedor->nome) ? $fornecedor->nome : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> E-mail* </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?=!empty($fornecedor->email) ? $fornecedor->email : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Telefone </label>
                        <input type="text" name="telefone" id="telefone" class="form-control" value="<?=!empty($fornecedor->telefone) ? $fornecedor->telefone : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Celular* </label>
                        <input type="text" name="celular" id="celular" class="form-control" value="<?=!empty($fornecedor->celular) ? $fornecedor->celular : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> CNPJ* </label>
                        <input type="text" name="cnpj" id="cnpj" class="form-control" value="<?=!empty($fornecedor->cnpj) ? $fornecedor->cnpj : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
            </div>

            <h6 class="align-middle m-0 font-weight-bold">Endereço do Fornecedor</h6>
            <hr/>
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> CEP </label>
                        <input type="text" name="cep" id="cep" class="form-control" value="<?=!empty($fornecedor->cep) ? $fornecedor->cep : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label> Endereço </label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="<?=!empty($fornecedor->endereco) ? $fornecedor->endereco : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Bairro </label>
                        <input type="text" name="bairro" id="bairro" class="form-control" value="<?=!empty($fornecedor->bairro) ? $fornecedor->bairro : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Número </label>
                        <input type="text" name="numero" id="numero" class="form-control" value="<?=!empty($fornecedor->numero) ? $fornecedor->numero : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Cidade </label>
                        <input type="text" name="cidade" id="cidade" class="form-control" value="<?=!empty($fornecedor->cidade) ? $fornecedor->cidade : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Estado* </label>
                        <select name="estado" id="estado" class="form-control" <?=isset($somente_visualizar) ? "disabled" : ""?>>
                            <option value="" <?=!empty($fornecedor->sexo) ? "" : "selected"?>>Selecione uma opção</option>
                            <?php foreach (estadosBrasileiros() as $sigla => $estado) {?>
                                <option value="<?=$sigla?>" <?=!empty($fornecedor->estado) && $fornecedor->estado === $sigla ? "selected" : ""?>> <?=$estado?> </option>
                            <?php }?>
                        </select>
                    </div>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="form-group">
                        <label> Complemento </label>
                        <input type="text" name="complemento" id="complemento" class="form-control" value="<?=!empty($fornecedor->complemento) ? $fornecedor->complemento : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>