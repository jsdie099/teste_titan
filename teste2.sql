CREATE TABLE Produtos(
	idprod INTEGER(8) NOT NULL PRIMARY KEY auto_increment,
	nome VARCHAR(100), 
	cor VARCHAR(50)
);

CREATE TABLE Precos(
	idpreco INTEGER(8) NOT NULL PRIMARY KEY auto_increment,
	idprod INTEGER(8)
	preco DECIMAL(10,2)
);

