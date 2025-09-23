<?php

require_once '../Service/UserManager.php';

$initialUsers = [
    new User(1, "João Silva", "joao@email.com", password_hash("SenhaForte1", PASSWORD_DEFAULT))
];

$userManager = new UserManager($initialUsers);

// Função para exibir o resultado
function displayResult(string $title, string $result): void
{
    $color = str_contains($result, 'Sucesso') ? '#28a745' : '#dc3545';
    $status = str_contains($result, 'Sucesso') ? 'Sucesso' : 'Erro';

    echo "<div style='border: 1px solid #ccc; padding: 15px; margin-bottom: 20px; border-left: 5px solid {$color};'>";
    echo "<h4 style='margin: 0 0 10px 0;'>{$title}</h4>";
    echo "<p style='margin: 0; color: #555;'><strong>Status:</strong> <span style='color: {$color}; font-weight: bold;'>{$status}</span></p>";
    echo "<p style='margin: 5px 0 0 0;'><strong>Mensagem:</strong> {$result}</p>";
    echo "</div>";
}

// Casos de Uso
echo '<br><h2>Sistema de Autenticação de Usuários</h2><br>';

// - cadastro válido
$result = $userManager->registerUser("Maisa Amaral", "maisa@email.com", "Senha12345");
displayResult("Caso 1 - Cadastro válido", $result);

// - cadastro com e-mail inválido
$result = $userManager->registerUser("Samara Adorno", "samara@@email", "Senha123");
displayResult("Caso 2 - Cadastro com e-mail inválido", $result);

// - tentativa de login válida
$result = $userManager->loginUser("maisa@email.com", "Senha12345");
displayResult("Caso 3 - Tentativa de login válida", $result);

// - tentativa de login com senha errada
$result = $userManager->loginUser("joao@email.com", "Errada123");
displayResult("Caso 4 - Tentativa de login com senha errada", $result);

// - tentativa de cadastro com e-mail já em uso
$result = $userManager->registerUser("João Silva", "joao@email.com", "NovaSenha123");
displayResult("Caso 5 - Tentativa de cadastro com e-mail já em uso", $result);

// - reset de senha válido
$result = $userManager->resetPassword(1, "NovaSenha1");
displayResult("Caso 6 - Reset de senha válido", $result);

// - reset de senha com critérios inválidos
$result = $userManager->resetPassword(1, "curta");
displayResult("Caso 7 - Reset de senha com critérios inválidos", $result);
?>