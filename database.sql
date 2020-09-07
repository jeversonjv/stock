use stock;

create table usuario (
	usuario_id int not null auto_increment,
    nome varchar(255) null,
    email varchar(255) null,
    senha varchar(255) null,
    data_cadastro datetime null,
    ativo tinyint null,
    primary key(usuario_id)
);

create table cliente (
	cliente_id int not null auto_increment,
    usuario_id int null,
    nome varchar(255) null,
    email varchar(255) null,
    data_nascimento date null,
    sexo char(1) null,
    telefone char(14) null,
    celular char(15) null,
    rg varchar(30) null,
	cpf varchar(14) null,
    cep varchar(9) null,
    endereco varchar(255) null,
    bairro varchar(255) null,
    numero int null,
    cidade varchar(255) null,
    complemento varchar(255) null,
    estado char(2) null,
    data_cadastro datetime,
    primary key(cliente_id),
    index idx_usuario_id (usuario_id)
);

create table produto(
	produto_id int not null auto_increment,
	cliente_id int null,
    categoria_id int null,
	fornecedor_id int null,
	nome varchar(255) null,
    descricao varchar(255) null,
    peso_liquido float null,
    peso_bruto float null,
    preco_venda float null,
    preco_custo float null,
    estoque int null,
    observacao varchar(255) null,
    data_cadastro datetime null,
    primary key(produto_id),
    index idx_categoria_id (categoria_id),
    index idx_fornecedor_id (fornecedor_id),
    index idx_cliente_id (cliente_id)
);

create table fornecedor (
	fornecedor_id int not null auto_increment,
    cliente_id int null,
    nome varchar(255) null,
    email varchar(255) null,
    telefone char(14) null, 
    celular char(15) null, 
    tipo_pessoa tinyint null,
    rg varchar(30) null,
	cpf varchar(14) null,
    cnpj varchar(18) null,
    cep varchar(9) null,
    endereco varchar(255) null,
    bairro varchar(255) null,
    numero int null,
    cidade varchar(255) null,
    complemento varchar(255) null,
    estado char(2) null,
    data_cadastro datetime,
    primary key(fornecedor_id),
    index idx_cliente_id (cliente_id)
);

create table venda (
	venda_id int not null auto_increment,
    cliente_id int null,
    descricao varchar(255) null,
    data_venda datetime null,
    primary key(venda_id),
    index idx_cliente_id (cliente_id)
);

create table venda_produto (
	venda_produto_id int not null auto_increment,
    venda_id int null,
    produto_id int null,
    primary key(venda_produto_id),
    index idx_venda_id (venda_id),
    index idx_produto_id (produto_id)
);

create table categoria (
	categoria_id int not null auto_increment,
    cliente_id int null,
    nome varchar(255) null,
	descricao varchar(255) null,
    data_cadastro datetime null,
    primary key(categoria_id),
	index idx_cliente_id (cliente_id)
);
