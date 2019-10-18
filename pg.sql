create table if not exists USUARIO
(
	id serial primary key,
	username varchar(20) not null unique,
	senha varchar (32) not null,
	nome varchar(30) not null,
	sexo enum('M','F') not null,
	email varchar(20) not null unique
) default charset=utf8;

create table if not exists CLIENTE
(
	id serial primary key,
	nome varchar(20) not null,
	CPF integer not null,
	endereco varchar(50) not null,
	telefone varchar(12) not null
);

create table if not exists PRODUTO
(
	id serial primary key,
	nome varchar(20) not null unique,
	preco_venda decimal(6,2)
);

create table if not exists FUNCAO
(
	id serial primary key,
	nome varchar(20) not null unique
);

create table if not exists PERMISSAO
(
	id serial primary key,
	nome varchar(20) not null unique
);

create table if not exists FORNECEDOR
(
	id serial primary key,
	nome varchar(20) not null unique
);

create table if not exists "PRODUTO-PRECO_COMPRA"
(
	id_produto integer not null,
	id_fornecedor integer not null,
	preco_compra decimal(6,2)
);

-- relação 1-para-muitos, cada usuário pode ter apenas 1 função e cada função pode ser exercida por vários usuários
create table if not exists "USUARIO-FUNCAO"
(
	id_usuario integer not null,
	id_funcao integer not null,
	foreign key (id_usuario) references USUARIO(id),
	foreign key (id_funcao) references FUNCAO(id)
);

create table if not exists "FUNCAO-PERMISSAO"
(
	id_funcao integer not null,
	id_permissao integer not null,
	foreign key (id_funcao) references FUNCAO(id),
	foreign key (id_permissao) references PERMISSAO(id)
);
