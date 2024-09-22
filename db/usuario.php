<?php 
// Estabelecendo a conexão diretamente
$host = 'localhost'; //banco de dados
$db = 'banco'; // nome 
$user = 'root'; // usuario
$pass = ''; // senha

try {
    // cria uma nova conexão PDO com o banco de dados MySQL
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);// erros como exceções
} catch (PDOException $e) {
    echo "Falha na conexão: " . $e->getMessage();// mensagem de erro
    exit;
}


//classe Usuario
class Usuario { 
    private $db; // armazenar a conexão PDO

    public function __construct($pdo) {// construtor
        $this->db = $pdo; // conexão passada como argumento
    }

    public function all() {//todos os usuários
        $stmt = $this->db->prepare("SELECT * FROM usuarios"); // SQL
        $stmt->execute(); 
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // registros associativo
    }

    public function find($id) {// encontrar um usuario pelo ID
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE id = :id"); 
        $stmt->bindParam(':id', $id); // parâmetro :id ao valor passado
        $stmt->execute(); 
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }

    public function create($data) {// novo usuário
        $data['email'] = trim($data['email']); // remove espaços em branco

        // verificar se o email já existe
        if ($this->emailExists($data['email'])) {
            return ['success' => false, 'message' => 'Email já cadastrado!'];
        }

        // Prepara a consulta para inserção no banco de dados
        $stmt = $this->db->prepare("INSERT INTO usuarios (nome, email, cpf) VALUES (:nome, :email, :cpf)");
        $stmt->bindParam(':nome', $data['nome']); // Vincula os parâmetros
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':cpf', $data['cpf']);

        try {
                        $stmt->execute();// Executa a inserção
            return ['success' => true, 'message' => 'Usuário cadastrado com sucesso!']; 
        } catch (PDOException $e) {
            return ['success' => false, 'message' => 'Erro ao inserir: ' . $e->getMessage()];
        }
    }

     
    public function update($id, $data) {// atualizar um usuario
        $stmt = $this->db->prepare("UPDATE usuarios SET nome = :nome, email = :email, cpf = :cpf WHERE id = :id");
        $stmt->bindParam(':id', $id); // Vincula o ID 
        $stmt->bindParam(':nome', $data['nome']); // novos dados
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':cpf', $data['cpf']);
        return $stmt->execute(); 
    }

        public function delete($id) {//deletar 
        $stmt = $this->db->prepare("DELETE FROM usuarios WHERE id = :id");
        $stmt->bindParam(':id', $id); 
        return $stmt->execute(); 
    }

        public function toggleStatus($id) {//alternar o status
        $usuario = $this->find($id); // busca o usuário pelo ID

        // status entre 'ativo' e 'inativo'
        $newStatus = ($usuario['status'] === 'ativo') ? 'inativo' : 'ativo';
        $stmt = $this->db->prepare("UPDATE usuarios SET status = :status WHERE id = :id"); 
        $stmt->bindParam(':status', $newStatus); // novo status
        $stmt->bindParam(':id', $id); // ID do usuário
        return $stmt->execute(); 
    }

    // método privado que verifica se um email é cadastrado
    private function emailExists($email) {
        $stmt = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email"); 
        $stmt->bindParam(':email', $email); 
        $stmt->execute(); 
        return $stmt->rowCount() > 0; // Retorna true se houver registros com esse email
    }
}

// criar uma instância da classe Usuario, passando a conexão PDO
$usuario = new Usuario($pdo);
?>
