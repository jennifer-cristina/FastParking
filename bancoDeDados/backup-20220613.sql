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

ALTER TABLE tblControle
	ADD COLUMN preco DECIMAL;

SELECT * FROM tblControle;

SELECT DATEDIFF(CURDATE(), '2022-06-08') AS qtdeDia;

SELECT DATE_FORMAT(CURDATE(), '%d/%m/%y');

SELECT TIME_FORMAT(TIMEDIFF('21:45:00', CURTIME()), '%H') + (DATEDIFF('2022-06-13', CURDATE())*24) AS qtdeHoras;

SELECT tblVeiculo.placa, tblControle.*, TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 AS qtdeHoras,
CASE 
	WHEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 > 1 THEN TIMESTAMPDIFF(DAY, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 * tblTipoVaga.precoDiaria
	WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 <= 1 THEN tblTipoVaga.precoHora
	WHEN TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 > 1 THEN (TIMESTAMPDIFF(HOUR, CONCAT(tblControle.dataEntrada, ' ', tblControle.horaEntrada), NOW()) - 3 - 1) * tblTipoVaga.precoAdicional + tblTipoVaga.precoHora
END preco
FROM tblVeiculo
INNER JOIN tblControle 
	ON tblVeiculo.id = tblControle.idVeiculo
INNER JOIN tblVaga
	ON tblControle.idVaga = tblVaga.id
INNER JOIN tblTipoVaga
	ON tblVaga.idTipoVaga = tblTipoVaga.id
WHERE tblVeiculo.placa = '4657-ajsh' AND tblControle.horaSaida IS NULL AND tblControle.dataSaida IS NULL;

SELECT tblControle.horaSaida, tblControle.dataSaida
FROM tblcontrole
WHERE tblcontrole.idVeiculo = 2 AND tblControle.dataEntrada IS NULL AND tblControle.horaSaida IS NULL AND tblControle.dataSaida IS NULL;

update tblControle set 
                horaSaida      = TIME_FORMAT(NOW(), '%H:%i:%s'),  
                dataSaida      = DATE_FORMAT(NOW(), '%Y-%m-%d'), 
                idVeiculo      = 2,
                idVaga         = 19,
                preco          = 4
            where id           = 21;
        
DESC tblControle;

SELECT TIME_FORMAT(NOW(), '%H:%i:%s');

SELECT DATE_FORMAT(NOW(), '%Y-%m-%d');

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

UPDATE tblControle SET
				horaSaida = '14:30:00',
                dataSaida = '2022-03-06';
                
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

SELECT tblVaga.id AS vaga,
	   tblTipoVaga.precoHora AS TipoVaga, tblTipoVaga.precoAdicional
 FROM tblVaga
		INNER JOIN tblTipoVaga
			ON tblvaga.idTipoVaga = tblTipoVaga.id;

# ('Pequeno porte', 4.00, 2.00, 40.00),
# ('Medio porte', 6.00, 3.00, 60.00),
# ('Grande porte', 8.00, 4.00, 80.00);

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