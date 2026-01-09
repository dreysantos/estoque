create table setores(
	id int primary key auto_increment,
	nome varchar(50) not null unique,
	descricao varchar(100),
	telefone varchar(11)
);

create table funcionarios(
	id int primary key auto_increment,
	id_setor int not null,
	nome varchar(50) not null,
	sobrenome varchar(50) not null,
	telefone varchar(11),
	numero_matricula int not null unique,
	cpf varchar(11) not null unique,
	foreign key (id_setor) references setores(id)
);

create table usuarios(
	id int primary key auto_increment,
	id_funcionario int not null,
	nome varchar(50) not null unique,
	senha varchar(255) not null,
	nivel_acesso enum('basico','medio','avancado','administrador') not null default 'basico',
	ativo bool not null default true,
	foreign key (id_funcionario) references funcionarios (id)
);

-- observação: caso o mysql uma versão anterior ao 8.0.16  criar um trigger em vez de check
create table equipamentos(
	id int primary key auto_increment,
	nome varchar(100) not null,
	descricao varchar(200),
	marca varchar(50) not null,
	tipo enum('epi','epc','peca','ferramenta','materia-prima','outro') not null,
	ca varchar(20) not null,
	ca_validade date not null,
	quantidade int not null default 0 check (quantidade >= 0)
);

create table fornecedores(
	id int primary key auto_increment,
	nome_fantasia varchar(100) not null,
	razao_social varchar(100) not null,
	cnpj varchar(14) not null
);

create table entradas(
	id int primary key auto_increment,
	id_fornecedor int,
	id_usuario int not null,
	tipo enum(
		'compra',
		'doacao',
		'transferencia',
		'devolucao',
		'ajuste'
	) not null,
	situacao enum('ativa','cancelada') not null default 'ativa',
	descricao varchar(200),
	data_registro timestamp not null default current_timestamp,
	foreign key (id_fornecedor) references fornecedores (id),
	foreign key (id_usuario) references usuarios (id)
);

create table entrada_equipamentos( 
	id int primary key auto_increment,
	id_entrada int not null,
	id_equipamento int not null,
	quantidade int not null default 1 check (quantidade >= 1),
	foreign key (id_entrada) references entradas (id),
	foreign key (id_equipamento) references equipamentos (id)
);

create table solicitacoes(
	id int primary key auto_increment,
	id_usuario int not null,
	id_setor int not null,
	situacao enum(
		'pendente',
		'aprovada',
		'atendida',
		'parcial',
		'cancelada',
		'rejeitada',
		'analise'
	) not null default 'pendente',
	descricao varchar(200),
	data_registro timestamp not null default current_timestamp,
	foreign key (id_usuario) references usuarios (id),
	foreign key (id_setor) references setores (id)
);

create table solicitacao_equipamentos (
	id int primary key auto_increment,
	id_solicitacao int not null,
	id_equipamento int not null,
	quantidade int not null default 1 check (quantidade >= 1),
	foreign key (id_solicitacao) references solicitacoes (id),
	foreign key (id_equipamento) references equipamentos (id)
);

create table saidas (
	id int primary key auto_increment,
	id_solicitacao int,
	id_usuario int not null,
	tipo enum(
		'requisicao',
		'transferencia',
		'devolucao',
		'descarte',
		'ajuste',
		'consumo',
		'doacao',
		'venda'
	) not null,
	situacao enum('ativa','cancelada') not null default 'ativa',
	descricao varchar(200),
	data_registro timestamp not null default current_timestamp,
	foreign key (id_solicitacao) references solicitacoes (id),
	foreign key (id_usuario) references usuarios (id)
);

create table saida_equipamentos (
	id int primary key auto_increment,
	id_saida int not null,
	id_equipamento int not null,
	quantidade int not null default 1 check (quantidade >= 1),
	foreign key (id_saida) references saidas (id),
	foreign key (id_equipamento) references equipamentos (id)
);

create view view_entradas as
select 
	entradas.id as id, 
	entradas.data_registro as data_registro,
	entradas.tipo as tipo,
	entradas.situacao as situacao, 
	fornecedores.nome_fantasia as fornecedor,
	concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario 
from entradas 
inner join fornecedores on entradas.id_fornecedor = fornecedores.id
inner join usuarios on entradas.id_usuario = usuarios.id
inner join funcionarios on usuarios.id_funcionario = funcionarios.id
order by entradas.id desc;

create view view_entrada_equipamentos as
select 
	entrada_equipamentos.id as id,
	entradas.id as id_entrada,
	equipamentos.nome as nome,
	equipamentos.marca as marca,
	equipamentos.tipo as tipo,
	entrada_equipamentos.quantidade as quantidade,
	equipamentos.ca as ca,
	equipamentos.ca_validade as ca_validade
from entradas
inner join entrada_equipamentos on entradas.id = entrada_equipamentos.id_entrada
inner join equipamentos on entrada_equipamentos.id_equipamento = equipamentos.id
order by entrada_equipamentos.id; 

create view view_saidas as
select 
	saidas.id as id,
	saidas.id_solicitacao as id_solicitacao,
	solicitacoes.data_registro as data_solicitacao,
	saidas.data_registro as data_registro,
	setores.nome as setor,
	concat(f1.nome, ' ', f1.sobrenome) as solicitante,
	saidas.tipo as tipo,
	saidas.situacao as situacao,
	concat(f2.nome, ' ', f2.sobrenome) as funcionario
from saidas
inner join solicitacoes on saidas.id_solicitacao = solicitacoes.id
inner join usuarios as u1 on solicitacoes.id_usuario = u1.id
inner join funcionarios as f1 on u1.id_funcionario = f1.id
inner join setores on solicitacoes.id_setor = setores.id
inner join usuarios as u2 on saidas.id_usuario = u2.id
inner join funcionarios as f2 on u2.id_funcionario = f2.id
order by saidas.id desc;

create view view_saida_equipamentos as 
select
	saida_equipamentos.id as id,
	saidas.id as id_saida,
	equipamentos.nome as nome,
	equipamentos.marca as marca,
	equipamentos.tipo as tipo,
	saida_equipamentos.quantidade as quantidade,
	equipamentos.ca as ca,
	equipamentos.ca_validade as ca_validade
from saidas
inner join saida_equipamentos on saidas.id = saida_equipamentos.id_saida
inner join equipamentos on saida_equipamentos.id_equipamento = equipamentos.id
order by saida_equipamentos.id desc;

create view view_solicitacoes as
select 
	solicitacoes.id as id,
	solicitacoes.data_registro as data_registro,
	setores.nome as setor,
	concat(funcionarios.nome, ' ',funcionarios.sobrenome) as funcionario,
	solicitacoes.descricao
from solicitacoes
inner join usuarios on solicitacoes.id_usuario = usuarios.id
inner join funcionarios on usuarios.id_funcionario = funcionarios.id
inner join setores on solicitacoes.id_setor = setores.id
order by solicitacoes.id desc;

create view view_solicitacao_equipamentos as
select
	solicitacao_equipamentos.id as id,
	solicitacoes.id as id_solicitacao,
	equipamentos.nome as nome,
	equipamentos.marca as marca,
	equipamentos.tipo as tipo,
	equipamentos.quantidade as quantidade,
	equipamentos.ca as ca,
	equipamentos.ca_validade as ca_validade
from solicitacoes
inner join solicitacao_equipamentos on solicitacoes.id = solicitacao_equipamentos.id_solicitacao
inner join equipamentos on solicitacao_equipamentos.id_equipamento = equipamentos.id
order by solicitacao_equipamentos.id desc;

create view view_usuarios as
select
	usuarios.id as id,
 	setores.nome as setor,
 	usuarios.nome as usuario,
 	usuarios.nivel_acesso as nivel_acesso,
  	usuarios.ativo as ativo,
  	concat(funcionarios.nome, ' ', funcionarios.sobrenome) as funcionario,
  	funcionarios.numero_matricula as numero_matricula
from usuarios
inner join funcionarios on usuarios.id_funcionario = funcionarios.id
inner join setores on funcionarios.id_setor = setores.id;
