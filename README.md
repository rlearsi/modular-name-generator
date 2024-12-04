# Gerador de Nicknames Modular

Este é um sistema **modular** de geração de **nicknames** procedural baseado em estilos. Cada estilo segue regras específicas definidas por meio de **bases de sílabas** personalizáveis. O objetivo é permitir a geração dinâmica de apelidos (nicknames) para diferentes contextos, como jogos, mundos de fantasia ou até mesmo entretenimento casual.

## Recursos

- **Modularidade**: Cada estilo é armazenado em arquivos independentes para fácil adição e manutenção.
- **Flexibilidade**: Adicionar novos estilos requer apenas a criação de um arquivo de texto com as sílabas e o nome correto.
- **URL Amigável**: O sistema utiliza URLs amigáveis para seleção de estilos.
- **Configuração Simples**: Inclui um arquivo `.htaccess` para redirecionamento correto.
- **Fácil Extensão**: Qualquer usuário pode adicionar novos estilos sem modificar o código principal.

---

## Como Funciona

1. **Estrutura Modular**:
   - Cada estilo é representado por um arquivo `.txt` contendo as sílabas divididas em três linhas: *início*, *meio* e *fim*.
   - O nome do arquivo (por exemplo, `anime.txt`) representa o nome do estilo.
   - Exemplo de Arquivo: viking.txt
    ```Thor, Fre, As, Hel, Svi, Gun
        dar, var, vin, rik, ald, ste
      son, dal, grim, fjord, heim, skjold```

2. **Carregamento Automático**:
   - O sistema carrega dinamicamente os arquivos de estilos da pasta `styles/`.
   - Não é necessário modificar o código principal para adicionar novos estilos.

3. **Geração Procedural**:
   - A geração é feita combinando sílabas de forma aleatória, seguindo o padrão:
     ```
     [sílabas de início] + [sílabas de meio] + [sílabas de fim]
     ```

4. **Exibição de Estilos Disponíveis**:
   - A página inicial lista todos os estilos disponíveis como links dinâmicos.
   - O clique em um link redireciona para a URL amigável correspondente ao estilo, como:  
     ```
     http://localhost/generator/anime
     ```

5. **Extensão**:
   - Para adicionar um novo estilo, basta criar um arquivo `.txt` na pasta `modules/` com as sílabas organizadas em três linhas.

---

## Estrutura do Projeto

generator/
├── index.php            # Arquivo principal (trata URLs e exibe resultados)
├── GeradorDeNicknames.php # Classe principal do gerador
├── styles/              # Pasta de estilos
│   ├── portugues.txt    # Base de dados para o estilo "português"
│   ├── anime.txt        # Base de dados para o estilo "anime"
│   ├── funkeiros.txt    # Base de dados para o estilo "funkeiros"
│   ├── elfico.txt       # Base de dados para o estilo "élfico"
│   └── ...              # Adicione mais arquivos de estilos aqui
└── .htaccess            # Configuração para URLs amigáveis
