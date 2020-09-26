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
        <h6 class="align-middle m-0 font-weight-bold text-primary"><?=!empty($venda_id) ? "Editar" : (isset($somente_visualizar) ? "Visualizar" : "Adicionar Nova")?> Venda</h6>
        <div>
            <a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>
            <?php if (!isset($somente_visualizar)) {?>
                <a class="btn btn-primary text-white" id="salvar" > Salvar </a>
            <?php }?>
        </div>
    </div>
    <div class="card-body">
        <form id="formulario" method="post" action="/vendas/salvar">
            <input type="hidden" id="venda_id" name="venda_id" value="<?=!empty($venda_id) ? $venda_id : 0?>" />

            <h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
            <hr/>
            <div class="row">
                <div class="col-md-3 col-xs-12">
                    <label> Cliente* </label>
                    <select name="cliente_id" id="cliente_id" class="form-control form-control-chosen" <?=isset($somente_visualizar) ? "disabled" : ""?>>
                        <option value="" <?=!empty($venda->cliente_id) ? "" : "selected"?>>Selecione uma opção</option>
                        <?php foreach($clientes as $cliente) { ?>
                            <option value="<?=$cliente->cliente_id?>" <?=!empty($venda->cliente_id) && $cliente->cliente_id == $venda->cliente_id ? "selected" : ""?>> <?=$cliente->nome?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-9 col-xs-12">
                    <div class="form-group">
                        <label> Descrição </label>
                        <input type="text" name="complemento" id="complemento" class="form-control" value="<?=!empty($venda->descricao) ? $venda->descricao : ""?>" <?=isset($somente_visualizar) ? "readonly" : ""?> />
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <h6 class="align-middle font-weight-bold">Produtos da Venda</h6>
                <a class="btn btn-primary text-white" id="salvar"> Adicionar Produto </a>
            </div>

            <div class="row mt-2">
                <div class="col-md-12 col-xs-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> Nome </th>
                                <th> Quantidade </th>
                                <th> Valor Unitário </th>
                                <th> Valor Total (Qtd x V.U) </th>
                                <th> Remover </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> PC Gamer </td> 
                                <td> 2 </td>
                                <td> R$ 3.500,00 </td>
                                <td> R$ 7.000,00 </td>
                                <td> <a class="btn btn-danger text-white btn-deletar"> <i class="fas fa-trash"></i></i> </a> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="1"> <strong> Total </strong> </td>
                                <td colspan="4"> <strong> R$ 7.000,00 </strong> </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </form>
    </div>
</div>