<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-center">
        <h6 class="align-middle m-0 font-weight-bold text-primary">Adicionar Novo Cliente</h6>
        <div>
            <a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>    
            <a class="btn btn-primary text-white" href="#"> Salvar </a>
        </div>
    </div>
    <div class="card-body">
        <form method="post" action="/clientes/salvar">

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Nome* </label>
                        <input type="text" name="nome" id="nome" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> E-mail* </label>
                        <input type="email" name="email" id="email" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Data de Nascimento* </label>
                        <input type="date" name="data_nascimento" id="data_nascimento" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Sexo* </label>
                        <select name="sexo" id="sexo" class="form-control">
                            <option value="M">Masculino</option>
                            <option value="F">Feminino</option>
                            <option value="N">Prefiro não declarar</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Telefone </label>
                        <input type="text" name="telefone" id="telefone" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> Celular* </label>
                        <input type="text" name="celular" id="celular" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> RG* </label>
                        <input type="text" name="rg" id="rg" class="form-control" />
                    </div>
                </div>
                <div class="col-md-3 col-xs-12">
                    <div class="form-group">
                        <label> CPF* </label>
                        <input type="text" name="cpf" id="cpf" class="form-control" />
                    </div>
                </div>
            </div>

            <h6 class="align-middle m-0 font-weight-bold">Endereço do Cliente</h6>
            <hr/>
            <div class="row">
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> CEP* </label>
                        <input type="text" name="cep" id="cep" class="form-control" />
                    </div>
                </div>
                <div class="col-md-4 col-xs-12">
                    <div class="form-group">
                        <label> Endereço* </label>
                        <input type="text" name="endereco" id="endereco" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Bairro* </label>
                        <input type="text" name="bairro" id="bairro" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Número* </label>
                        <input type="text" name="numero" id="numero" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Cidade* </label>
                        <input type="text" name="cidade" id="cidade" class="form-control" />
                    </div>
                </div>
                <div class="col-md-2 col-xs-12">
                    <div class="form-group">
                        <label> Estado* </label>
                        <select name="estado" id="estado" class="form-control">
                            <?php foreach(estadosBrasileiros() as $sigla => $estado) { ?>
                                <option value="<?= $sigla ?>"> <?= $estado ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-10 col-xs-12">
                    <div class="form-group">
                        <label> Complemento </label>
                        <input type="text" name="complemento" id="complemento" class="form-control" />
                    </div>
                </div>
            </div>

            

        </form>
    </div>
</div>