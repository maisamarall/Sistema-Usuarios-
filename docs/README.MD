# Projeto: Sistema de Usuários e Autenticação

### Repositório da disciplina de Design Patterns & Clean Code - Prof Valdir

Este projeto implementa um sistema de usuários e autenticação simples em PHP, seguindo boas práticas com a organização *PSR-12* e os princípios *DRY* e *KISS*.

---

### 🧑‍🎓 Nomes dos discentes e RAs

- Maisa Amaral: 1997058
- Samara Adorno: 2001639

---

### 📂 Estrutura do Projeto

O projeto é dividido em uma estrutura de pastas simples:

- *docs/*: Contém a documentação do projeto, incluindo este arquivo README.md.
- *src/*: Contém os arquivos de código-fonte.
    - *Models/*: Contém as classes que representa as entidades do sistema, como o *user.php*
    - *Public/*: Contém o arquivo de entrada do projeto , como o *index.php*
    - *Service*: Contém as classes de serviço que encapsulam a lógica, como o *userManager*
    - *Utils/*: Contém as classes de utilidade com funções auxiliares e reutilizaveis como o *validator.php*

---

### ✨ Funcionalidades Implementadas

O sistema de autenticação de usuários oferece as seguintes funcionalidades:

- *Cadastro de Usuário:* Registra um novo usuário com validação de e-mail e senha, garantindo que o e-mail não seja duplicado.
- *Login de Usuário:* Autentica um usuário usando a função password_verify() para comparar a senha fornecida com o hash armazenado.
- *Reset de Senha:* Permite atualizar a senha de um usuário existente.

---

### 🛠️ Regras de Negócio e Limitações

- As senhas são criptografadas com password_hash() e verificadas com password_verify() para garantir a segurança.
- As senhas devem seguir o critério de força: no mínimo 8 caracteres, com pelo menos 1 número e 1 letra maiúscula.
- Não é possível cadastrar e-mails duplicados.
- Os dados dos usuários são armazenados em um array simples, sem a necessidade de um banco de dados.
- O sistema só permite realizar o reset de senha, somente com a senha de um usuário que já está cadastrado.
- O sistema só permite aplicar o reset de senha, somente quando a nova senha digitada, seguir os critérios da validação de senha forte.

---

### 🚀 Como Executar o Projeto

1.  *Instale o XAMPP:* Certifique-se de que o XAMPP está instalado e o servidor Apache está rodando.
2.  *Clone o Repositório:* Copie a pasta do projeto (ex: Sistema-Usuarios-) para o diretório htdocs do seu XAMPP.
3.  *Acesse no Navegador:* Abra seu navegador e acesse a URL da pasta pública, onde é o ponto de entrada do projeto http://localhost/Sistema-Usuarios-/src/Public/

---

### 🔍 Casos de Teste (Exemplos de Uso)

1.  **Cadastro Válido:**
    - **Entrada:** `$userManager->registerUser("Maisa Amaral", "maisa@email.com", "Senha12345")`
    - **Resultado esperado:** `Sucesso: Usuário Maisa Amaral cadastrado com sucesso.`

2.  **Cadastro com E-mail Inválido:**
    - **Entrada:** `$userManager->registerUser("Samara Adorno", "samara@@email", "Senha123")`
    - **Resultado esperado:** `Erro: E-mail inválido.`

3. **Login Válido:**
    - **Entrada:** `$userManager->loginUser("maisa@email.com", "Senha12345")`
    - **Resultado esperado:** `Sucesso: Login do usuário maisa@email.com realizado com sucesso.`

4.  **Login com Senha Errada:**
    - **Entrada:** `$userManager->loginUser("joao@email.com", "Errada123")`
    - **Resultado esperado:** `Erro: Credenciais inválidas.`

5.  **E-mail Duplicado:**
    - **Entrada:** `$userManager->registerUser("João Silva", "joao@email.com", "NovaSenha123")`
    - **Resultado esperado:** `Erro: E-mail já está em uso.`

6. **Reset de Senha Válido:**
    - **Entrada:** `$userManager->resetPassword(1, "NovaSenha1")`
    - **Resultado esperado:** `Sucesso: Senha alterada com sucesso para João Silva.`

7. **Reset de senha com critérios inválidos:**
    - **Entrada:** `$userManager->resetPassword(1, "curta")`
    - **Resultado esperado:** ` Erro: A senha precisa ter pelo menos 8 caracteres, um número e uma letra maiúscula.`
