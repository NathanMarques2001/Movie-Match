# Movie Match 🎬

Este projeto, é um sistema de recomendação de filmes baseado nas preferências e avaliações do usuário. Ele utiliza uma combinação de avaliações de gêneros e Processamento de Linguagem Natural (NLP) para oferecer recomendações personalizadas.

# Principais Funcionalidades 🎯
- Avaliação de Gêneros:

Os usuários podem avaliar diferentes gêneros de filmes, indicando suas preferências.

- Processamento de Avaliações:

As avaliações dos usuários são processadas e armazenadas no sistema.

- Recomendações Sem NLP:

Com base nas avaliações de gêneros, o sistema gera uma lista inicial de recomendações sem usar NLP.

- Recomendações Com NLP:

Se o usuário já avaliou alguns filmes, o sistema utiliza NLP para calcular a similaridade entre sinopses de filmes avaliados e não avaliados.

- Classificação de Recomendações:

As recomendações são classificadas com base nas avaliações do usuário e na similaridade calculada pelo NLP.

- Exibição de Recomendações Personalizadas:

As recomendações personalizadas são exibidas ao usuário, considerando suas avaliações e as recomendações geradas pelo sistema.

# Arquitetura do Projeto 🏗️
O projeto é composto pela arquitetura MVC e alguns módulos:

1. Models: Modelos que representam entidades como usuários, filmes, gêneros, etc.

2. Controllers: Controladores responsáveis por gerenciar as interações entre o modelo e a interface do usuário.

3. Views: Visualizações relacionadas à interface do usuário.

4. Config: Configurações e utilitários para o funcionamento do sistema.

# Como Rodar o Projeto 🏃

- Configuração do Ambiente:

Configure um servidor web para hospedar o projeto.
Certifique-se de ter o PHP instalado.

- Banco de Dados:

Configure as informações do banco de dados no arquivo config/database.php.

- Composer:

Execute composer install para instalar as dependências.

- Variáveis de Ambiente:

Crie um arquivo .env na raiz do projeto com as variáveis necessárias, como a chave da API do TMDB.

- Execução:

Inicie o servidor e acesse o projeto através do navegador.

# Estrutura do Projeto 📂

**public/:** Contém os arquivos acessíveis publicamente, como imagens e estilos.

**src/:** Código-fonte PHP do projeto.

**vendor/:** Dependências do Composer.

**views/:** Arquivos de visualização HTML/PHP.

# Requisitos do Sistema 🖥️

- PHP 7.0 ou superior.
- Composer instalado.
- Servidor web configurado.

# Telas do Sistema 📱

Aqui estão algumas capturas de tela das telas principais do sistema:

1. **Tela de Login:**
   ![Tela de Login](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/login.png)

2. **Tela de Cadastro:**
   ![Tela de Cadastro](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/signup.png)

3. **Avaliação de Gêneros - Primeiro Acesso:**
   ![Avaliação de Gêneros](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/modal.png)

4. **Página Principal - Recomendações Personalizadas:**
   ![Página Principal](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/home.png)

5. **Lista de Filmes:**
   ![Lista de Filmes](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/list.png)

6. **Filmes Avaliados:**
   ![Filmes Avaliados](https://github.com/NathanMarques2001/Movie-Match/blob/main/redme-assets/assessments.png)

# Contato ✉️
