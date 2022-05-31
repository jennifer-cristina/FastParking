
CREATE DATABASE dbFastParking;

USE dbFastParking;

SHOW TABLES;

####################################### Tabela Sexo #############################################

CREATE TABLE tblSexo(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    sigla VARCHAR(1) NOT NULL,
    nome VARCHAR(15) NOT NULL,
    UNIQUE INDEX(id)
);


####################################### Tabela Cliente #############################################

CREATE TABLE tblCliente(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    cpf VARCHAR(20) NOT NULL,
    rg VARCHAR(20),
    cnh VARCHAR(45),
    ## Chave estrangeira sexo
    idSexo INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Sexo_Cliente
    FOREIGN KEY (idSexo)
    REFERENCES tblSexo(id),
    UNIQUE INDEX(id)
);


####################################### Tabela Telefone #############################################

CREATE TABLE tblTelefone(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    ddd VARCHAR(5) NOT NULL,
    numero VARCHAR(20) NOT NULL,
    ## Chave estrangeira cliente
    idCliente INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Cliente_Telefone
    FOREIGN KEY (idCliente)
    REFERENCES tblCliente(id),
    UNIQUE INDEX(id)
);


####################################### Tabela Cor #############################################

CREATE TABLE tblCor(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    UNIQUE INDEX(id)
);

####################################### Tabela TipoVaga #############################################

CREATE TABLE tblTipoVaga(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    preco DECIMAL(50,0) NOT NULL,
    precoAdicional DECIMAL(50,0),
    precoDiaria DECIMAL(50,0),
    UNIQUE INDEX(id)
);

####################################### Tabela Vaga #############################################

CREATE TABLE tblVaga(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    statusVaga BOOLEAN NOT NULL,
    preferencial BOOLEAN NOT NULL,
    
);

CREATE TABLE tbl