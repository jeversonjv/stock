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
        <h6 class="align-middle m-0 font-weight-bold text-primary">Listagem de Vendas</h6>
        <a class="btn btn-primary text-white" href="/vendas/adicionar"> Adicionar </a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Qtd. Produtos</th>
                        <th>Data da Venda</th>
                        <th>Valor da Venda</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Cliente</th>
                        <th>Qtd. Produtos</th>
                        <th>Data da Venda</th>
                        <th>Valor da Venda</th>
                        <th>Visualizar</th>
                        <th>Editar</th>
                        <th>Excluir</th>
                    </tr>
                </tfoot>
                <tbody>
                    <?php foreach($vendas as $venda) { ?> 
                        <tr>
                            <td> <?= $venda->nome_cliente ?> </td>
                            <td> <?= $venda->qtd_produto_venda ?> </td>
                            <td> <?= date("d/m/Y H:i:s", strtotime($venda->data_venda)) ?> </td>
                            <td> R$ <?= number_format($venda->valor_total_venda, 2, ",", ".") ?> </td>
                            <td> 
                                <a class="btn btn-primary text-white" href="/vendas/visualizar/<?= $venda->venda_id ?>"> <i class="fas fa-eye"></i> </a>
                            </td>
                            <td> 
                                <a class="btn btn-warning text-white" href="/vendas/editar/<?= $venda->venda_id ?>"> <i class="fas fa-edit"></i> </a>
                            </td>
                            <td>
                                <a class="btn btn-danger text-white btn-deletar" data-venda_id="<?= $venda->venda_id ?>" > <i class="fas fa-trash"></i></i> </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>