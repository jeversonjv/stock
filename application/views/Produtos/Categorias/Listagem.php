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
        <h6 class="align-middle m-0 font-weight-bold text-primary">Listagem de Categorias</h6>
        <a class="btn btn-primary text-white" href="/categorias/adicionar"> Adicionar </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                </thead>
                <tfoot>
                    <tr>
                        <th>Nome</th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($categorias as $categoria) { ?> 
                        <tr>
                            <td> <?= $categoria->nome ?> </td>
                            <td> 
                                <a class="btn btn-primary text-white" href="/categorias/visualizar/<?= $categoria->categoria_id ?>"> <i class="fas fa-eye"></i> </a>
                            </td>
                            <td> 
                                <a class="btn btn-warning text-white" href="/categorias/editar/<?= $categoria->categoria_id ?>"> <i class="fas fa-edit"></i> </a>
                            </td>
                            <td>
                                <a class="btn btn-danger text-white btn-deletar" data-categoria_id="<?= $categoria->categoria_id ?>" > <i class="fas fa-trash"></i></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>