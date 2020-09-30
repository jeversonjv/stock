<div class="card shadow mb-4" id="div_principal">

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
		<h6 class="align-middle m-0 font-weight-bold text-primary">
			<?=!empty($venda_id) ? "Editar" : (isset($somente_visualizar) ? "Visualizar" : "Adicionar Nova")?> Venda
		</h6>
		<div>
			<a class="btn btn-secondary text-white" href="#" onClick="window.history.back()"> Voltar </a>
			<?php if (!isset($somente_visualizar)) {?>
			<a class="btn btn-primary text-white" id="salvar"> Salvar </a>
			<?php }?>
		</div>
	</div>
	<div class="card-body">
		<form id="formulario" method="post">
			<input type="hidden" id="venda_id" name="venda_id" value="<?=!empty($venda_id) ? $venda_id : 0?>" />

			<h6 class="align-middle m-0 font-weight-bold">Dados Básicos</h6>
			<hr />
			<div class="row">
				<div class="col-md-3 col-xs-12">
					<label> Cliente* </label>
					<select name="cliente_id" id="cliente_id" class="form-control form-control-chosen"
						<?=isset($somente_visualizar) ? "disabled" : ""?>>
						<option value="" <?=!empty($venda->cliente_id) ? "" : "selected"?>>Selecione uma opção</option>
						<?php foreach ($clientes as $cliente) {?>
						<option value="<?=$cliente->cliente_id?>"
							<?=!empty($venda->cliente_id) && $cliente->cliente_id == $venda->cliente_id ? "selected" : ""?>>
							<?=$cliente->nome?> </option>
						<?php }?>
					</select>
				</div>
				<div class="col-md-9 col-xs-12">
					<div class="form-group">
						<label> Descrição </label>
						<input type="text" name="complemento" id="complemento" class="form-control"
							value="<?=!empty($venda->descricao) ? $venda->descricao : ""?>"
							<?=isset($somente_visualizar) ? "readonly" : ""?> />
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-between align-items-center mt-2">
				<h6 class="align-middle font-weight-bold">Produtos da Venda</h6>
				<a class="btn btn-primary text-white" id="abrir_modal_add_produto" data-toggle="modal" data-target="#modal_produto"> Adicionar
					Produto </a>
			</div>

			<div class="row mt-2">
				<div class="col-md-12 col-xs-12">
					<table class="table table-bordered table-striped" id="tabela_produtos">
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
                    			<td class="text-center" colspan="5"> Sem Produtos Cadastrados </td>
                			</tr>
						</tbody>
					</table>
				</div>
			</div>
		</form>
	</div>
</div>

<div class="modal fade" id="modal_produto" tabindex="-1" role="dialog" aria-labelledby="modal_produto"
	aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Adicionar Produto</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<label> Produto* </label>
						<select name="produto_id" id="produto_id" class="form-control form-control-chosen"
							<?=isset($somente_visualizar) ? "disabled" : ""?>>
							<option value="0">Selecione um produto</option>
							<?php foreach ($produtos as $produto) {?>
							<option value="<?=$produto->produto_id?>">
								<?=$produto->nome?>
							</option>
							<?php }?>
						</select>
					</div>
				</div>
				<div class="row hide mt-2" id="box_info_produto">
					<div class="col-md-6 mt-2">
						<label> Estoque </label>
						<input type="text" name="estoque" id="estoque" class="form-control" readonly/>
					</div>
					<div class="col-md-6 mt-2">
						<label> Valor Unitário </label>
						<input type="text" name="valor_unitario" id="valor_unitario" class="form-control" readonly/>
					</div>
					<div class="col-md-6 mt-2">
						<label> Quantidade </label>
						<input type="number" min="1" name="quantidade" id="quantidade" class="form-control" />
					</div>
					<div class="col-md-6 mt-2">
						<label> Valor Total </label>
						<input type="text" name="valor_total" id="valor_total" class="form-control" readonly/>
					</div>
				</div>
				<div class="d-flex justify-content-center align-items-center hide mt-2" id="box_loading">
					<img src="/assets/images/loading.svg" />
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" id="add_produto" class="btn btn-primary">Adicionar</button>
			</div>
		</div>
	</div>
</div>