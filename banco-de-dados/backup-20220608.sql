
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

INSERT INTO tblSexo(sigla, nome)
			VALUES ('F','Feminino'),
				   ('M','Masculino'),
                   ('O','Outros');
                   
SELECT * FROM tblSexo;

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

SELECT * FROM tblCliente;

DELETE FROM tblCliente WHERE id = 5;

SELECT * FROM tblCliente ORDER BY id ASC;

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

SELECT * FROM tblTelefone;

####################################### Tabela Cor #############################################

CREATE TABLE tblCor(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    UNIQUE INDEX(id)
);

INSERT INTO tblCor(nome)
			VALUES ('Vermelho'),
				   ('Marrom'),
                   ('Prata'),
                   ('Branco'),
                   ('Amarelo'),
                   ('Roxo'),
                   ('Cinza'),
                   ('Verde'),
                   ('Azul'),
                   ('Preto');
                   
SELECT * FROM tblCor;

####################################### Tabela TipoVaga #############################################

CREATE TABLE tblTipoVaga(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    preco DECIMAL(50,0) NOT NULL,
    precoAdicional DECIMAL(50,0),
    precoDiaria DECIMAL(50,0),
    UNIQUE INDEX(id)
);

ALTER TABLE tblTipoVaga
	CHANGE preco precoHora DECIMAL(50,0) NOT NULL;

INSERT INTO tblTipoVaga(nome, precoHora, precoAdicional, precoDiaria)
			VALUES ('Pequeno porte', 4.00, 2.00, 40.00),
				   ('Medio porte', 6.00, 3.00, 60.00),
                   ('Grande porte', 8.00, 4.00, 80.00);
                   
SELECT * FROM tblTipoVaga;

####################################### Tabela Vaga #############################################

CREATE TABLE tblVaga(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    statusVaga BOOLEAN NOT NULL,
    preferencial BOOLEAN NOT NULL,
    ## Chave estrangeira TipoVaga
    idTipoVaga INT UNSIGNED NOT NULL,
    CONSTRAINT FK_TipoVaga_Vaga
    FOREIGN KEY (idTipoVaga)
    REFERENCES tblTipoVaga(id),
    ## Chave estrangeira Bloco
    idBloco INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Bloco_Vaga
    FOREIGN KEY (idBloco)
    REFERENCES tblBloco(id),
    UNIQUE INDEX(id)
);

SELECT * FROM tblVaga;

####
SELECT tblVaga.id AS vaga,
	   tblTipoVaga.nome AS TipoVaga, tblTipoVaga.preco
 FROM tblVaga
		INNER JOIN tblTipoVaga
			ON tblvaga.idTipoVaga = tblTipoVaga.id;
####

SELECT tblVaga.id AS vaga,
	   tblTipoVaga.precoHora AS TipoVaga, tblTipoVaga.precoAdicional
 FROM tblVaga
		INNER JOIN tblTipoVaga
			ON tblvaga.idTipoVaga = tblTipoVaga.id;

insert into tblVaga
                        (statusVaga,
                           preferencial,
                           idTipoVaga,
                           idBloco)
                        values(
                            false,
							false,
							2,
							1);
                            
update tblVaga set
                    statusVaga   = true,
                    preferencial = false,
                    idTipoVaga   = 3,
                    idBloco      = 3
                where id=2;

####################################### Tabela Bloco #############################################

CREATE TABLE tblBloco(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45) NOT NULL,
    capacidadeMaxima INT,
    UNIQUE INDEX(id)
);

insert into tblBloco(nome, capacidadeMaxima) 			
					values('A', 200),
						  ('B', 200),
                          ('C', 150);

####################################### Tabela Veiculo #############################################

CREATE TABLE tblVeiculo(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(10) NOT NULL,
    ## Chave estrangeira Cor
    idCor INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Cor_Veiculo
    FOREIGN KEY (idCor)
    REFERENCES tblCor(id),
    ## Chave estrangeira Vaga
    idVaga INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Vaga_Veiculo
    FOREIGN KEY (idVaga)
    REFERENCES tblVaga(id),
    ## Chave estrangeira Cliente
    idCliente INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Cliente_Veiculo
    FOREIGN KEY (idCliente)
    REFERENCES tblCliente(id),
    UNIQUE INDEX(id)
);

SELECT * FROM tblVeiculo;

SELECT placa = "4657-ajsh" FROM tblVeiculo;

SELECT * FROM tblVeiculo
		WHERE placa = '4657-ajsh';

SELECT tblCliente.nome 
FROM tblVeiculo INNER JOIN tblCliente
ON ( tblVeiculo.idCliente = tblCliente.id);

select tblCliente.nome from (tblVeiculo inner join tblCliente on tblVeiculo.idCliente = tblCliente.id) where tblVeiculo.placa = '7845-jsaha';

SELECT tblVeiculo.placa, tblCliente.nome
FROM tblVeiculo, tblCliente
WHERE tblVeiculo.idCliente = tblCliente.id;


ALTER TABLE tblVeiculo
	DROP COLUMN idVaga;

DESC tblVeiculo;

####################################### Tabela Controle #############################################

CREATE TABLE tblControle(
	id INT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
    horaEntrada TIME NOT NULL,
    horaSaida TIME,
    dataEntrada DATE NOT NULL,
    dataSaida DATE,
    ## Chave estrangeira Veiculo
    idVeiculo INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Veiculo_Controle
    FOREIGN KEY (idVeiculo)
    REFERENCES tblVeiculo(id),
	## Chave estrangeira Vaga
    idVaga INT UNSIGNED NOT NULL,
    CONSTRAINT FK_Vaga_Controle
    FOREIGN KEY (idVaga)
    REFERENCES tblVaga(id),
    UNIQUE INDEX(id)
);

SELECT * FROM tblControle;

DESC tblControle;

DROP TABLE tblControle;

ALTER TABLE tblControle
	DROP FOREIGN KEY tblcontrole_ibfk_1;

INSERT INTO tblControle
                (horaEntrada, 
                horaSaida, 
                dataEntrada, 
                dataSaida, 
                idVeiculo, 
                idVaga)
            VALUES	
            ('12:00:00',
			NULL, 
			'2022-03-06', 
			NULL, 
            '2', 
            '16');                             
UPDATE tblVaga SET
                    statusVaga   = FALSE
                WHERE id = idVaga;
                
insert into tblControle
                (horaEntrada, 
                dataEntrada, 
                idVeiculo, 
                idVaga)
            values
            ('16: 00: 00',
			'2022-03-08', 
            6, 
            17);
           UPDATE tblVaga SET
                    statusVaga   = true
                WHERE id= 17;
                
insert into tblControle
                (horaEntrada, 
                dataEntrada, 
                idVeiculo, 
                idVaga)
            values
            ('14:00:00',
			'2022-03-08',
6,
16);
           UPDATE tblVaga SET
                    statusVaga   = true
                WHERE id= 16;
                
SELECT TIME_FORMAT(TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada), '%H:%i') AS qtdeHoras FROM tblControle WHERE tblControle.id = 17;

SELECT TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) AS qtdeHoras FROM tblControle WHERE tblControle.id = 17;

SELECT (TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT ((TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) * 3) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT ((((TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) * 3) + 60000) / 10000) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT DATE_FORMAT((((TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) * 3) + 60000), '%d,%m') 
AS custo FROM tblControle WHERE tblControle.id = 17;


SELECT TIMEDIFF('10:00:00', '17:30:00') AS custo;

SELECT ( 00 / 60) AS custo;

SELECT ( 7 + ( 00 / 60) ) AS custo;

SELECT ( 1 - ( 7 + ( 00 / 60) ) ) AS custo;

SELECT ( 3 * ( 1 - ( 7 + ( 00 / 60) ) )) AS custo;

SELECT (TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT ((TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) * 3) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT ((((TIMEDIFF(tblControle.horaSaida, tblControle.horaEntrada) - 10000) * 3) + 60000) / 10000) AS custo FROM tblControle WHERE tblControle.id = 17;

SELECT tblVaga.id AS vaga,
	   tblTipoVaga.precoHora AS TipoVaga, tblTipoVaga.precoAdicional
 FROM tblVaga
		INNER JOIN tblTipoVaga
			ON tblvaga.idTipoVaga = tblTipoVaga.id;

# ('Pequeno porte', 4.00, 2.00, 40.00),
# ('Medio porte', 6.00, 3.00, 60.00),
# ('Grande porte', 8.00, 4.00, 80.00);