CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    --CORREÇÃO: adicionar:NOT NULL
     nome VARCHAR(120),
     --CORREÇÃO:Adicionar:NOT NULL UNIQUE
      email VARCHAR(150), 
      --CORREÇÃO:Aumentar o limite de caracteres pois a senha normalmente
    --não é armazenada só o escrito, ela é armazenada em codigos,senhas
    --que possuem muito mais caracteres|Adicionar:NOT NULL
      senha VARCHAR(150),
      --CORREÇÂO: Adicionar:NOT NULL DEFAULT 'operador'
       perfil VARCHAR(30) NOT NULL DEFAULT 'operador'
       );

CREATE TABLE IF NOT EXISTS produtos (
    id INT AUTO_INCREMENT PRIMARY KEY,
     nome VARCHAR(150) NOT NULL,
      descricao TEXT, 
      preco DECIMAL(10,2) NOT NULL,
       estoque INT NOT NULL, 
       categoria VARCHAR(80) NOT NULL,
        criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        );

INSERT INTO usuarios(
    nome,email,senha,perfil) 
    VALUES (
        'Administrador',
        'admin@exemplo.local',
        'admin123',
        'admin'),
        (
            'Operador',
            'operador@exemplo.local',
            '123456',
            'operador'
            );

INSERT INTO produtos(
    nome,
    descricao,
    preco,
    estoque,
    categoria
    ) 
    VALUES (
        'Mouse USB',
        'Mouse para escritório',35.90,12,
        'Periféricos'
        ),
        ('Teclado',
        'Teclado básico',59.90,7,
        'Periféricos'
        ),
        (
            'Monitor',
            'Monitor de laboratório',699.00,3,
            'Monitores');
            