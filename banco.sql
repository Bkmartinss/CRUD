CREATE TABLE usuarios (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  cpf VARCHAR(11) NOT NULL UNIQUE,
  status ENUM('ativo', 'inativo') DEFAULT 'ativo',
  data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP // data e hora atuais no momento da inserção 
