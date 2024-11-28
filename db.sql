create database padaria;

use padaria;

create table comprador(
    id INT (11) primary key  AUTO_INCREMENT NOT NULL,
    nome_comprador VARCHAR(100) NOT NULL,
    telefone_comprador VARCHAR (20) NOT NULL,
    endereco_comprador TEXT
);
create table itensVenda(
    id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_venda_fk int(11) not null,
    quantidade int(10) not null,
    subtotal float(10) not null,

);
create table venda(
    id int(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
    comprador_id_fk int(11) not NULL,
    data_compra timestamp not null,
    itens_venda_fk INT(11),

	
);

alter table venda
add FOREIGN KEY (comprador_id_fk) REFERENCES comprador(id),
add foreign key (itens_venda_fk) REFERENCES itensVenda(id)

alter table venda
add foreign key (id_venda_fk) references venda(id)

