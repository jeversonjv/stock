<!-- DataTales Example -->
<div class="card shadow mb-4">

    <?php if($this->session->flashdata("mensagemSucesso")) { ?>
        <div class="col-lg-12 mb-2 mt-2 text-center">
            <div class="card bg-success text-white shadow">
                <div class="card-body">
                    <?= $this->session->flashdata("mensagemSucesso") ?> 
                </div>
            </div>
        </div>
    <?php } ?>

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
        <h6 class="align-middle m-0 font-weight-bold text-primary">Listagem de Clientes</h6>
        <a class="btn btn-primary text-white" href="/clientes/adicionar"> Adicionar </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Celular</th>
                        <th>Telefone</th>
                        <th>CPF</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($clientes as $cliente) { ?> 
                        <tr>
                            <td> <?= $cliente->nome ?> </td>
                            <td> <?= $cliente->email ?> </td>
                            <td> <?= $cliente->celular ?> </td>
                            <td> <?= $cliente->telefone ?? "--" ?> </td>
                            <td> <?= $cliente->cpf ?> </td>
                            <td> 
                                <a class="btn btn-primary text-white" href="/clientes/visualizar/<?= $cliente->cliente_id ?>"> <i class="fas fa-eye"></i> </a>
                            </td>
                            <td> 
                                <a class="btn btn-warning text-white" href="/clientes/editar/<?= $cliente->cliente_id ?>"> <i class="fas fa-edit"></i> </a>
                            </td>
                            <td>
                                <a class="btn btn-danger text-white btn-deletar" data-cliente_id="<?= $cliente->cliente_id ?>" > <i class="fas fa-trash"></i></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>