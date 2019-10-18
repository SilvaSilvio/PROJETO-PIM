create table USUARIO
(
	id integer primary key not null auto_increment,
	username varchar(20) not null unique,
	senha varchar (32) not null,
	nome varchar(30) not null,
	sexo enum('M','F') not null,
	email varchar(20) not null unique
) default charset=utf8;

create table CLIENTE
(
	id integer primary key not null auto_increment,
	nome varchar(20) not null,
	CPF integer not null,
	endereco varchar(50) not null,
	telefone varchar(12) not null
);

create table PRODUTO
(
	id integer primary key not null auto_increment,
	nome varchar(20) not null unique,
	preco_venda decimal(6,2)
);

create table FUNCAO
(
	id integer primary key not null auto_increment,
	nome varchar(20) not null unique
);

create table PERMISSAO
(
	id integer primary key not null auto_increment,
	nome varchar(20) not null unique
);

create table FORNECEDOR
(
	id integer primary key not null auto_increment,
	nome varchar(20) not null unique
);

create table `PRODUTO-PRECO_COMPRA`
(
	id_produto integer not null,
	id_fornecedor integer not null,
	preco_compra decimal(6,2)
);

create table `USUARIO-FUNCAO`
(
	id_usuario integer not null,
	id_funcao integer not null,
	foreign key (id_usuario) references USUARIO(id),
	foreign key (id_funcao) references FUNCAO(id)
);

create table `FUNCAO-PERMISSAO`
(
	id_funcao integer not null,
	id_permissao integer not null,
	foreign key (id_funcao) references FUNCAO(id),
	foreign key (id_permissao) references PERMISSAO(id)
);