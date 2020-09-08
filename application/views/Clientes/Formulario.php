<div class="card shadow mb-4">

    <?php if($this->session->flashdata("mensagemErro")) { ?>
        <div class="col-lg-12 mb-2 mt-2 text-center">
            <div class="card bg-danger text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata("mensagemErro") ?> 
                </div>
            </div>
        </div>
    <?php } ?>
    
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="align-middle m-0 font-weight-bold text-primary">Adicionar Novo Cliente</h6>
        <div>
            <a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>    
            <a class="btn btn-primary text-white" id="salvar" > Salvar </a>
        </div>
    </div>
    <div class="card-body">
        <form id="formulario" method="post" action="/clientes/salvar">
            <input type="hidden" name="cliente_id" value="<?= !empty($cliente_id) ? $cliente_id : 0 ?>" />

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Nome* </label>
                        <input type="text" name="nome" id="nome" class="form-control" value="<?= !empty($cliente->nome) ? $cliente->nome : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> E-mail* </label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= !empty($cliente->email) ? $cliente->email : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Data de Nascimento* </label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" value="<?= !empty($cliente->data_nascimento) ? $cliente->data_nascimento : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Sexo* </label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="" <?= !empty($cliente->sexo) ? "" : "selected"?>> Selecione uma opção </option>
                            <option value="M" <?= !empty($cliente->sexo) && $cliente->sexo === "M" ? "selected" : ""?>>Masculino</option>
                            <option value="F" <?= !empty($cliente->sexo) && $cliente->sexo === "F" ? "selected" : ""?>>Feminino</option>
                            <option value="N" <?= !empty($cliente->sexo) && $cliente->sexo === "N" ? "selected" : ""?>>Prefiro não declarar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Telefone </label>
                        <input type="text" name="telefone" id="telefone" class="form-control" value="<?= !empty($cliente->telefone) ? $cliente->telefone : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Celular* </label>
                        <input type="text" name="celular" id="celular" class="form-control" value="<?= !empty($cliente->celular) ? $cliente->celular : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> RG* </label>
                        <input type="text" name="rg" id="rg" class="form-control" value="<?= !empty($cliente->rg) ? $cliente->rg : ""?>" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> CPF* </label>
                        <input type="text" name="cpf" id="cpf" class="form-control" value="<?= !empty($cliente->cpf) ? $cliente->cpf : ""?>" />
                    </div>
                </div>
            </div>

            <h6 class="align-middle m-0 font-weight-bold">Endereço do Cliente</h6>
            <hr/>
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> CEP* </label>
                        <input type="text" name="cep" id="cep" class="form-control" value="<?= !empty($cliente->cep) ? $cliente->cep : ""?>" />
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label> Endereço* </label>
                        <input type="text" name="endereco" id="endereco" class="form-control" value="<?= !empty($cliente->endereco) ? $cliente->endereco : ""?>" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Bairro* </label>
                        <input type="text" name="bairro" id="bairro" class="form-control" value="<?= !empty($cliente->bairro) ? $cliente->bairro : ""?>" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Número* </label>
                        <input type="text" name="numero" id="numero" class="form-control" value="<?= !empty($cliente->numero) ? $cliente->numero : ""?>" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Cidade* </label>
                        <input type="text" name="cidade" id="cidade" class="form-control" value="<?= !empty($cliente->cidade) ? $cliente->cidade : ""?>" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Estado* </label>
                        <select name="estado" id="estado" class="form-control">
                            <option value="" <?= !empty($cliente->sexo) ? "" : "selected"?>>Selecione uma opção</option>
                            <?php foreach(estadosBrasileiros() as $sigla => $estado) { ?>
                                <option value="<?= $sigla ?>" <?= !empty($cliente->estado) && $cliente->estado === $sigla ? "selected" : ""?>> <?= $estado ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-10 col-xs-12">
                    <div class="form-group">
                        <label> Complemento </label>
                        <input type="text" name="complemento" id="complemento" class="form-control" value="<?= !empty($cliente->complemento) ? $cliente->complemento : ""?>" />
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>