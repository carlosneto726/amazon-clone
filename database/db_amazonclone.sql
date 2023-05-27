CREATE TABLE tb_lojas(
	id int NOT NULL AUTO_INCREMENT,
	nome varchar(255),

	PRIMARY KEY(id)
);


CREATE TABLE tb_usuarios(
	id int NOT NULL AUTO_INCREMENT,
	nome varchar(255),
	email varchar(255),
	senha varchar(255),

	PRIMARY KEY (id)
);

CREATE TABLE tb_categorias(
	nome varchar(255) NOT NULL,
	PRIMARY KEY (nome)
);


CREATE TABLE tb_produtos(
	id int NOT NULL AUTO_INCREMENT,
	id_loja int NOT NULL,
	titulo varchar(255),
	descricao text,
	estrelas float,
	marca varchar(255),
	preco float,
	categoria varchar(255),
	qtd int,
	status char,
	img_url varchar(255),

	PRIMARY KEY(id),
	FOREIGN KEY(id_loja) REFERENCES tb_lojas(id),
	FOREIGN KEY(categoria) REFERENCES tb_categorias(nome)

);


CREATE TABLE tb_carrinho(
	id int NOT NULL AUTO_INCREMENT,
	id_produto int NOT NULL,
	id_usuario int NOT NULL,
	qtd int NOT NULL,

	PRIMARY KEY (id),
	FOREIGN KEY (id_produto) REFERENCES tb_produtos(id),
	FOREIGN KEY(id_usuario) REFERENCES tb_usuarios(id)
);


CREATE TABLE tb_vendas(
	id int NOT NULL AUTO_INCREMENT,
	id_usuario int NOT NULL,
	preco_total float,

	data date,
	status char,

	PRIMARY KEY	(id),
	FOREIGN KEY(id_usuario) REFERENCES tb_usuarios(id)

);



INSERT INTO tb_lojas(nome) VALUES
('Amazon'), 	
('Riachuelo'), 	
('Google'), 	
('Sansung'), 	
('PLaystation'),
('Philco'), 	
('Barilla'), 	
('Eletrolux'), 	
('LG'), 		
('HP'); 			

INSERT INTO tb_usuarios(nome, email, senha) VALUES
('Administrador', 'adm@adm', 'adm'),
('Carlos', 'carlos@123', '123'),
('Pedro', 'pedro@123', '123');

INSERT INTO tb_categorias (nome) VALUES
('Cozinha'),
('Tecnologia'),
('Games'),
('Acessorios'),
('Roupas');

INSERT INTO tb_produtos(id_loja, titulo,descricao,estrelas,marca,preco,categoria,qtd,status,img_url) VALUES
-- Games
(5, 'Controle de PS4 Dualshok 4','Contole Dualshok 4 para Playstation 4 e PC',4.5,'PlayStation', 249.99,'Games',2049,'0','img/produtos/controller_ps4.jpg'),
(5, 'Controle de PS5 Dualshok 5','Contole Dualshok 5 para Playstation 5 PLaystation 4 e PC',4.0,'PlayStation', 549.99,'Games',876,'0','img/produtos/controller_ps5.jpg'),
(1, 'Final Fantasy XVI PS5','Final Fantasy XVI - PlayStation 5',3.0,'Square Enix', 314.91,'Games',876,'0','img/produtos/games_ff.jpg'),
(1, 'Grand Theft Auto V PS4','Grand Theft Auto V - Premium Online Edition - Playstation 4',5.0,'Rockstar Games', 89.99,'Games',10204,'0','img/produtos/games_gta.jpg'),
(5, 'PS5','Console PlayStation®5',4.5,'PlayStation', 4400.00,'Games',1200,'0','img/produtos/games_ps5.jpg'),
(1, 'Controle Xbox','Controle sem Fio Xbox - Stellar Shift',3.0,'Xbox', 499.90,'Games',12799,'0','img/produtos/games_xbox_controle.jpg'),
(1, 'Xbox Series X','Xbox Series X - Forza Horizon 5 Bundle',4.5,'Xbox', 4799.00,'Games',33876,'0','img/produtos/games_xbox.jpg'),
(1, 'Red Dead Redemption 2 - PS4','Red Dead Redemption 2 - PlayStation 4',4.0,'Rockstar Games', 249.99,'Games',10002,'0','img/produtos/games_rdr2.jpg'),
(1, 'Spider-Man PS4','Marvels Spider-Man Edição Jogo do Ano - PlayStation 4',4.0,'PlayStation', 169.99,'Games',12093,'0','img/produtos/games_spiderman.jpg'),
(1, 'The Last of Us Part II - PS4','The Last of Us Part II - PlayStation 4',4.5,'PlayStation', 199.99,'Games',34876,'0','img/produtos/games_tlou2.jpg'),
-- Tecnologia
(3, 'Google Chromecast 3','Transmita seu conteúdo de onde e quando quiser | Streaming em Full HD', 3.5,'Google', 219,'Tecnologia',15000,'0','img/produtos/tech_chromecast.jpg'),
(1, 'Echo Dot (4ª Geração)','Smart Speaker com Alexa | Música, informação e Casa Inteligente - Cor Preta',5.0,'Amazon', 269, 'Tecnologia', 4562,'0','img/produtos/tech_echodot.jpg'),
(1, 'Câmera Digital','Câmera Digital Canon EOS REBEL SL3 (BKUS) 1855F4STM BR',3.0,'Canon', 4709.99, 'Tecnologia', 162,'0','img/produtos/tecnologia_camera.jpg'),
(1, 'SSD','HD SSD Kingston SA400S37 480GB',3.5,'Kingston', 179.00, 'Tecnologia', 9302,'0','img/produtos/tecnologia_ssd.jpg'),
(1, 'Acer Notebook Gamer Nitro 5','Acer Notebook Gamer Nitro 5 AN515-45-R91A Ryzen 5 Geração 5600H 8GB RAM 512GB SDD (GTX 1650) 15,6 Full HD IPS 144Hz Retroiluminado na cor vermelha Windows 11 Home',4.5,'Acer', 4839.00, 'Tecnologia', 94032,'0','img/produtos/tecnologia_notebook.jpg'),
(1, 'Celular Redmi Note 12','Celular Xiaomi Redmi Note 12 128GB / 6GB RAM/Dual Sim/TelaP e 13MP - Onyx Gray - Preto',4.0,'Xiaomi', 1170.99, 'Tecnologia', 90002,'0','img/produtos/tecnologia_redminote.jpg'),
(6, 'Smart TV LED 24"','Smart TV LED 24" Philco PTV24G50SN Conversor Digital HD com 2 HDMI',4.0,'Philco', 749.00, 'Tecnologia', 34562,'0','img/produtos/tecnologia_tv.jpg'),
(1, 'Mouse Sem Fio Logitech G703','Mouse Gamer Sem Fio Logitech G703 LIGHTSPEED com RGB LIGHTSYNC, 6 Botões Programáveis, Sensor HERO 25K e Bateria Recarregável - Compatível com POWERPLAY',3.5,'Logitech G', 378.90, 'Tecnologia', 4760,'0','img/produtos/tecnologia_mouse.jpg'),
-- Acessorios
(1, 'Suporte de Notebook','Suporte Uptable OCTOO, Preto', 3.0,'Amazon', 39.99,'Acessorios',15000,'0','img/produtos/acessorios_suportenotebook.jpg'),
(1, 'Capa Gel Banco', 'Capa Gel Banco Selim Almofada Para Bicicleta Bike Preto', 2.5,'Amazon', 42.93,'Acessorios',15000,'0','img/produtos/acessorios_capa_bike.jpg'),
(1, 'Apoio De Leitura Livro E Tablet - Oliver','Apoio De Leitura Livro E Tablet - Oliver', 2.5,'Amazon', 79.90,'Acessorios',15000,'0','img/produtos/acessorios_suporte_livro.jpg'),
(1, 'Carregador Universal Ultra Rápido','Geonav Carregador Universal Ultra Rápido, Power Delivery 25W, 1 Porta USB-C, CH25PDWT, Branco', 2.5,'Amazon', 122.32,'Acessorios',15000,'0','img/produtos/acessoriso_carregador_universal.jpg'),
(1, 'Gorro Orelhinha', 'Gorro Orelhinha (02 peças), Zip, listrado/vermelho', 3.0,'Zip', 26.88, 'Acessorios',1500,'0','img/produtos/acessorios_gorro.jpg'),
(1, 'Bolsa Organizadora', 'Bolsa Organizadora Estojo Para Cabos E Acessórios Eletrônicos (Preto)', 4.0,'ESTLINY', 33.99,'Acessorios',9000,'0','img/produtos/acessorios_bolsa.jpg'),
(1, 'Suporte para Headset', 'Suporte para Headset Blackfire Preto Fortrek', 3.5,'Fortrek', 42.90,'Acessorios',1000,'0','img/produtos/acessorios_suporteheadset.jpg'),
(1, 'Película Para iPad', 'Melhor Película Para iPad 10ª Geração 10.9pol Novo Ano 2022 - Alamo', 0.5,'Generic', 50.00,'Acessorios',2000,'0','img/produtos/acessorios_pelicula_ipad.jpg'),
(1, 'Mouse Pad', 'Mouse Pad Slim Basico Preto X Cell Para Mouse', 2.5,'X-Cell', 11.98,'Acessorios',20000,'0','img/produtos/acessorios_mousepad.jpg'),
(1, 'Mochila Dell', 'Mochila Dell Pro EcoLoop para notebook, Preto, CP5723', 2.0,'Dell', 248.00,'Acessorios',900,'0','img/produtos/acessorios_mochilanotebook.jpg'),
-- Cozinha
(6, 'Cafeteira Philco','Cafeteira Philco que faz café em 2 minutos com capacidade de 2L e quente e frio',3.0,'Philco', 689.99,'Cozinha',600,'0','img/produtos/cozinha_cafeteiraphilco.jpg'),
(7, 'Macarrão Spaghetti Barilla','Spaguetti 500g Barilla serve 5 pessoas',4.0,'Barilla', 9.59,'Cozinha', 20000,'0','img/produtos/cozinha_macarrao.jpg'),
(1, 'Batedeira', 'Batedeira Prática Mondial, 110V, Vermelho, 400W - B-44-R', 3.5,'Mondial', 79.99,'Cozinha',5000,'0','img/produtos/cozinha_batedeira.jpg'),
(1, 'Conjunto com 5 potes de Vidro', 'Euro Home VDR7090-PT - Conjunto com 5 potes de Vidro Redondos com Tampa Plástica, Preta', 3.0,'Euro', 39.51,'Cozinha',100,'0','img/produtos/cozinha_potes.jpg'),
(1, 'Torneira Pia Gourmet', 'Torneira Pia Gourmet Cozinha Parede Com Filtro Super Luxo', 2.5,'Monte Negro', 120.90,'Cozinha',60,'0','img/produtos/cozinha_torneira.jpg'),
(1, 'Kit Tapete de Cozinha', 'Kit Tapete de Cozinha 3 Peças Antiderrapante Mosaico Preto Cinza Kit Com Beira Porta Beira Cama', 4.0,'Renascence', 65.99,'Cozinha',1500,'0','img/produtos/cozinha_tapetes.jpg'),
(1, 'Formas Redondas', 'Conjunto 3 Formas Redondas De Metal Com Fundo Removível', 4.5,'Huvi', 58.90,'Cozinha',19000,'0','img/produtos/cozinha_panelas.jpg'),
(1, 'Escorredor 20 Peças', 'Cozinha Suspensa Modular Autosustentável Escorredor 20 Peças (PRETA)', 2.0,'Dicarlo', 197.00,'Cozinha',100,'0','img/produtos/cozinha_escorredor.jpg'),
(1, 'Tabua Mágica', 'Tabua Mágica p/Descongelar Carne Alimentos Cozinha Casa', 1.0,'Ut', 49.90,'Cozinha',700,'0','img/produtos/cozinha_tabua.jpg'),
(1, 'Cozinha Compacta', 'Cozinha Compacta Madesa Emilly Top com Armário e Balcão', 4.5,'Madesa', 699.99,'Cozinha',100,'0','img/produtos/cozinha_cozinha.jpg');
