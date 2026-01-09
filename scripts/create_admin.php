<?php
require_once __DIR__ . '/../core/Database.php';

$db = Database::connect();
$db->beginTransaction();

try {
    // 1) criar setor admin se não existir
    $stmt = $db->prepare("SELECT id FROM setores WHERE nome = ?");
    $stmt->execute(['Administração']);
    $setor = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($setor) {
        $id_setor = $setor['id'];
        echo "Setor já existe (id={$id_setor})\n";
    } else {
        $stmt = $db->prepare("INSERT INTO setores (nome, descricao, telefone) VALUES (?, ?, ?)");
        $stmt->execute(['Administração', 'Setor administrativo padrão', '']);
        $id_setor = $db->lastInsertId();
        echo "Setor criado (id={$id_setor})\n";
    }

    // 2) criar funcionário admin se não existir (procura por cpf)
    $cpf = '00000000000';
    $stmt = $db->prepare("SELECT id FROM funcionarios WHERE cpf = ?");
    $stmt->execute([$cpf]);
    $func = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($func) {
        $id_func = $func['id'];
        echo "Funcionário já existe (id={$id_func})\n";
    } else {
        $matricula = 1;
        $stmt = $db->prepare("INSERT INTO funcionarios (id_setor, nome, sobrenome, telefone, numero_matricula, cpf) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$id_setor, 'Admin', 'Sistema', '', $matricula, $cpf]);
        $id_func = $db->lastInsertId();
        echo "Funcionário criado (id={$id_func})\n";
    }

    // 3) criar usuário admin se não existir (procura por nome)
    $username = 'admin';
    $password = 'admin123';
    $stmt = $db->prepare("SELECT id FROM usuarios WHERE nome = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user) {
        $id_user = $user['id'];
        echo "Usuário já existe (id={$id_user})\n";
    } else {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO usuarios (id_funcionario, nome, senha, nivel_acesso, ativo) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$id_func, $username, $hash, 'administrador', 1]);
        $id_user = $db->lastInsertId();
        echo "Usuário administrador criado (id={$id_user})\n";
        echo "Credenciais: usuário={$username} senha={$password}\n";
    }

        // Se o usuário já existia, atualizamos a senha e nível para garantir acesso
        if (!empty($id_user)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $db->prepare("UPDATE usuarios SET senha = ?, nivel_acesso = ?, ativo = 1, id_funcionario = ? WHERE id = ?");
            $stmt->execute([$hash, 'administrador', $id_func, $id_user]);
            echo "Usuário (id={$id_user}) agora tem senha resetada para '{$password}' e nível 'administrador'.\n";
        }

    $db->commit();
    echo "Operação concluída com sucesso.\n";
} catch (Exception $e) {
    $db->rollBack();
    echo "Erro: " . $e->getMessage() . "\n";
    exit(1);
}

// instrução final para o usuário
echo "Rode via CLI: php scripts/create_admin.php (executar a partir da pasta public/..).\n";
