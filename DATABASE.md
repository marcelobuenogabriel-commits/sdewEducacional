# Estrutura do Banco de Dados - Sdew Educacional

Este documento descreve a estrutura do banco de dados do sistema Sdew Educacional.

## Tabelas Principais

### users
Tabela padrão do Laravel para autenticação de usuários.

| Campo              | Tipo       | Descrição                           |
|-------------------|------------|-------------------------------------|
| id                | bigint     | Chave primária                      |
| name              | string     | Nome do usuário                     |
| email             | string     | Email único do usuário              |
| email_verified_at | timestamp  | Data de verificação do email        |
| password          | string     | Senha criptografada                 |
| remember_token    | string     | Token para "lembrar-me"             |
| created_at        | timestamp  | Data de criação                     |
| updated_at        | timestamp  | Data de atualização                 |

### alunos
Tabela para gerenciamento de alunos.

| Campo              | Tipo       | Descrição                           |
|-------------------|------------|-------------------------------------|
| id                | bigint     | Chave primária                      |
| nome              | string     | Nome completo do aluno              |
| cpf               | string(14) | CPF único (formato: XXX.XXX.XXX-XX) |
| rg                | string(20) | RG (opcional)                       |
| data_nascimento   | date       | Data de nascimento                  |
| email             | string     | Email único do aluno                |
| telefone          | string(20) | Telefone fixo (opcional)            |
| celular           | string(20) | Telefone celular (opcional)         |
| endereco          | string     | Endereço (opcional)                 |
| numero            | string(10) | Número do endereço (opcional)       |
| complemento       | string     | Complemento (opcional)              |
| bairro            | string     | Bairro (opcional)                   |
| cidade            | string     | Cidade (opcional)                   |
| estado            | string(2)  | UF (opcional)                       |
| cep               | string(10) | CEP (opcional)                      |
| turma_id          | bigint     | FK para turmas (nullable)           |
| matricula         | string     | Matrícula única do aluno            |
| status            | enum       | ativo, inativo, trancado, concluido |
| observacoes       | text       | Observações gerais (opcional)       |
| created_at        | timestamp  | Data de criação                     |
| updated_at        | timestamp  | Data de atualização                 |

### turmas
Tabela para gerenciamento de turmas/classes.

| Campo              | Tipo       | Descrição                           |
|-------------------|------------|-------------------------------------|
| id                | bigint     | Chave primária                      |
| nome              | string     | Nome da turma                       |
| codigo            | string     | Código único da turma               |
| descricao         | text       | Descrição da turma (opcional)       |
| ano               | integer    | Ano letivo                          |
| periodo           | enum       | matutino, vespertino, noturno, integral |
| vagas_total       | integer    | Total de vagas (padrão: 30)         |
| vagas_ocupadas    | integer    | Vagas ocupadas (padrão: 0)          |
| ativo             | boolean    | Turma ativa (padrão: true)          |
| created_at        | timestamp  | Data de criação                     |
| updated_at        | timestamp  | Data de atualização                 |

### roles
Tabela do Spatie Permission para roles/funções.

| Campo              | Tipo       | Descrição                           |
|-------------------|------------|-------------------------------------|
| id                | bigint     | Chave primária                      |
| name              | string     | Nome da role                        |
| guard_name        | string     | Nome do guard                       |
| created_at        | timestamp  | Data de criação                     |
| updated_at        | timestamp  | Data de atualização                 |

### permissions
Tabela do Spatie Permission para permissões.

| Campo              | Tipo       | Descrição                           |
|-------------------|------------|-------------------------------------|
| id                | bigint     | Chave primária                      |
| name              | string     | Nome da permissão                   |
| guard_name        | string     | Nome do guard                       |
| created_at        | timestamp  | Data de criação                     |
| updated_at        | timestamp  | Data de atualização                 |

### model_has_permissions
Tabela pivot do Spatie Permission para permissões diretas de modelos.

### model_has_roles
Tabela pivot do Spatie Permission para associar roles aos modelos.

### role_has_permissions
Tabela pivot do Spatie Permission para associar permissões às roles.

## Relacionamentos

### Aluno - Turma
- Um aluno **pertence a** uma turma (belongsTo)
- Uma turma **tem muitos** alunos (hasMany)
- Relacionamento opcional (turma_id nullable)

### User - Roles
- Um usuário **pode ter muitas** roles (belongsToMany)
- Uma role **pode ter muitos** usuários (belongsToMany)

### User - Permissions
- Um usuário **pode ter muitas** permissões (belongsToMany)
- Uma permissão **pode pertencer a muitos** usuários (belongsToMany)

### Role - Permissions
- Uma role **pode ter muitas** permissões (belongsToMany)
- Uma permissão **pode pertencer a muitas** roles (belongsToMany)

## Índices

### alunos
- PRIMARY KEY (id)
- UNIQUE (cpf)
- UNIQUE (email)
- UNIQUE (matricula)
- FOREIGN KEY (turma_id) REFERENCES turmas(id) ON DELETE SET NULL

### turmas
- PRIMARY KEY (id)
- UNIQUE (codigo)

### users
- PRIMARY KEY (id)
- UNIQUE (email)

## Enums

### alunos.status
- `ativo`: Aluno matriculado e frequentando
- `inativo`: Aluno não está mais frequentando
- `trancado`: Matrícula trancada temporariamente
- `concluido`: Aluno concluiu o curso

### turmas.periodo
- `matutino`: Turno da manhã
- `vespertino`: Turno da tarde
- `noturno`: Turno da noite
- `integral`: Turno integral (manhã e tarde)

## Roles Padrão

O sistema vem com 4 roles pré-configuradas:

1. **administrador**: Acesso total ao sistema
2. **coordenador**: Pode gerenciar alunos, turmas e visualizar relatórios
3. **professor**: Pode visualizar alunos e turmas
4. **secretaria**: Pode gerenciar alunos e visualizar turmas

## Permissões Padrão

- `gerenciar alunos`: Acesso completo a alunos
- `visualizar alunos`: Apenas visualização de alunos
- `criar alunos`: Criar novos alunos
- `editar alunos`: Editar dados de alunos
- `excluir alunos`: Excluir alunos
- `gerenciar turmas`: Acesso completo a turmas
- `visualizar turmas`: Apenas visualização de turmas
- `criar turmas`: Criar novas turmas
- `editar turmas`: Editar dados de turmas
- `excluir turmas`: Excluir turmas
- `gerenciar usuarios`: Gerenciar usuários do sistema
- `visualizar relatorios`: Acessar relatórios do sistema

## Migrações

Para executar as migrações:

```bash
php artisan migrate
```

Para reverter as migrações:

```bash
php artisan migrate:rollback
```

Para resetar e reexecutar todas as migrações:

```bash
php artisan migrate:fresh
```

## Seeders

Para popular o banco com dados iniciais (roles e permissões):

```bash
php artisan db:seed
```

Para popular apenas roles e permissões:

```bash
php artisan db:seed --class=RolesAndPermissionsSeeder
```

## Observações

- Todos os timestamps (created_at, updated_at) são gerenciados automaticamente pelo Laravel
- A tabela de cache é usada para armazenar cache de aplicação
- A tabela de jobs é usada para filas de trabalho
- O sistema usa soft deletes onde apropriado
