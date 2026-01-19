# Arquitetura Modular - Sdew Educacional

## Visão Geral

O projeto Sdew Educacional utiliza a arquitetura modular implementada através do pacote `nwidart/laravel-modules`. Esta arquitetura permite organizar o código em módulos independentes e reutilizáveis, facilitando a manutenção, escalabilidade e desenvolvimento colaborativo.

## Estrutura de Módulos

O projeto está organizado nos seguintes módulos:

### 1. Módulo Aluno

**Responsabilidade:** Gerenciamento completo de alunos

**Localização:** `Modules/Aluno/`

**Componentes:**
- **Model:** `Modules\Aluno\Models\Aluno`
- **Controller:** `Modules\Aluno\Http\Controllers\AlunoController`
- **Views:** `Modules/Aluno/resources/views/`
  - `index.blade.php` - Listagem de alunos
  - `create.blade.php` - Formulário de cadastro
  - `edit.blade.php` - Formulário de edição
  - `show.blade.php` - Detalhes do aluno
- **Routes:** `Modules/Aluno/routes/web.php`
- **Migrations:** `Modules/Aluno/database/migrations/`

**Funcionalidades:**
- CRUD completo de alunos
- Validação de dados (CPF, email, matrícula)
- Relacionamento com turmas
- Gerenciamento de status (ativo, inativo, trancado, concluído)
- Informações pessoais, contato e endereço

**Rotas:**
- `GET /alunos` - Lista todos os alunos
- `GET /alunos/create` - Formulário de criação
- `POST /alunos` - Salvar novo aluno
- `GET /alunos/{aluno}` - Visualizar aluno
- `GET /alunos/{aluno}/edit` - Formulário de edição
- `PATCH /alunos/{aluno}` - Atualizar aluno
- `DELETE /alunos/{aluno}` - Excluir aluno

### 2. Módulo Turma

**Responsabilidade:** Gerenciamento completo de turmas

**Localização:** `Modules/Turma/`

**Componentes:**
- **Model:** `Modules\Turma\Models\Turma`
- **Controller:** `Modules\Turma\Http\Controllers\TurmaController`
- **Views:** `Modules/Turma/resources/views/`
  - `index.blade.php` - Listagem de turmas
  - `create.blade.php` - Formulário de cadastro
  - `edit.blade.php` - Formulário de edição
  - `show.blade.php` - Detalhes da turma
- **Routes:** `Modules/Turma/routes/web.php`
- **Migrations:** `Modules/Turma/database/migrations/`

**Funcionalidades:**
- CRUD completo de turmas
- Validação de código único
- Gerenciamento de vagas (total e ocupadas)
- Controle de períodos (matutino, vespertino, noturno, integral)
- Status ativo/inativo
- Relacionamento com alunos, professores e disciplinas

**Rotas:**
- `GET /turmas` - Lista todas as turmas
- `GET /turmas/create` - Formulário de criação
- `POST /turmas` - Salvar nova turma
- `GET /turmas/{turma}` - Visualizar turma
- `GET /turmas/{turma}/edit` - Formulário de edição
- `PATCH /turmas/{turma}` - Atualizar turma
- `DELETE /turmas/{turma}` - Excluir turma

### 3. Módulo Professor

**Responsabilidade:** Gerenciamento completo de professores

**Localização:** `Modules/Professor/`

**Componentes:**
- **Model:** `Modules\Professor\Models\Professor`
- **Controller:** `Modules\Professor\Http\Controllers\ProfessorController`
- **Views:** `Modules/Professor/resources/views/`
- **Routes:** `Modules/Professor/routes/web.php`
- **Migrations:** `Modules/Professor/database/migrations/`

**Funcionalidades:**
- CRUD completo de professores
- Validação de dados (CPF, email, registro profissional)
- Gerenciamento de especialidade e formação
- Controle de status (ativo, inativo, afastado, aposentado)
- Relacionamento com turmas e disciplinas
- Informações pessoais, contato e endereço profissional

**Campos Principais:**
- Dados pessoais: nome, CPF, RG, data de nascimento
- Contato: email, telefone, celular
- Endereço completo
- Dados profissionais: especialidade, formação, registro profissional
- Data de admissão e status

**Rotas:**
- `GET /professores` - Lista todos os professores
- `GET /professores/create` - Formulário de criação
- `POST /professores` - Salvar novo professor
- `GET /professores/{professor}` - Visualizar professor
- `GET /professores/{professor}/edit` - Formulário de edição
- `PATCH /professores/{professor}` - Atualizar professor
- `DELETE /professores/{professor}` - Excluir professor

### 4. Módulo Disciplina

**Responsabilidade:** Gerenciamento de disciplinas/matérias

**Localização:** `Modules/Disciplina/`

**Componentes:**
- **Model:** `Modules\Disciplina\Models\Disciplina`
- **Controller:** `Modules\Disciplina\Http\Controllers\DisciplinaController`
- **Views:** `Modules/Disciplina/resources/views/`
- **Routes:** `Modules/Disciplina/routes/web.php`
- **Migrations:** `Modules/Disciplina/database/migrations/`

**Funcionalidades:**
- CRUD completo de disciplinas
- Validação de código único
- Gerenciamento de carga horária e créditos
- Controle de ementa
- Relacionamento com professores e turmas
- Status ativo/inativo

**Campos Principais:**
- nome: Nome da disciplina
- codigo: Código único identificador
- descricao: Descrição da disciplina
- carga_horaria: Carga horária total
- creditos: Número de créditos
- ementa: Conteúdo programático
- ativo: Status da disciplina

**Rotas:**
- `GET /disciplinas` - Lista todas as disciplinas
- `GET /disciplinas/create` - Formulário de criação
- `POST /disciplinas` - Salvar nova disciplina
- `GET /disciplinas/{disciplina}` - Visualizar disciplina
- `GET /disciplinas/{disciplina}/edit` - Formulário de edição
- `PATCH /disciplinas/{disciplina}` - Atualizar disciplina
- `DELETE /disciplinas/{disciplina}` - Excluir disciplina

## Estrutura de um Módulo

Cada módulo segue a seguinte estrutura padrão:

```
Modules/
└── NomeDoModulo/
    ├── app/
    │   ├── Http/
    │   │   └── Controllers/
    │   ├── Models/
    │   └── Providers/
    │       ├── NomeDoModuloServiceProvider.php
    │       ├── RouteServiceProvider.php
    │       └── EventServiceProvider.php
    ├── config/
    │   └── config.php
    ├── database/
    │   ├── migrations/
    │   ├── seeders/
    │   └── factories/
    ├── resources/
    │   ├── views/
    │   └── assets/
    │       ├── js/
    │       └── sass/
    ├── routes/
    │   ├── web.php
    │   └── api.php
    ├── tests/
    │   ├── Feature/
    │   └── Unit/
    ├── composer.json
    ├── module.json
    ├── package.json
    └── vite.config.js
```

## Relacionamentos Entre Módulos

### Aluno ↔ Turma

- Um **Aluno** pertence a uma **Turma** (BelongsTo)
- Uma **Turma** possui muitos **Alunos** (HasMany)

**Implementação:**

```php
// Modules/Aluno/Models/Aluno.php
use Modules\Turma\Models\Turma;

public function turma(): BelongsTo
{
    return $this->belongsTo(Turma::class);
}

// Modules/Turma/Models/Turma.php
use Modules\Aluno\Models\Aluno;

public function alunos(): HasMany
{
    return $this->hasMany(Aluno::class);
}
```

### Professor ↔ Turma

- Um **Professor** pode lecionar em muitas **Turmas** (BelongsToMany)
- Uma **Turma** pode ter muitos **Professores** (BelongsToMany)
- Tabela pivot: `professor_turma`

**Implementação:**

```php
// Modules/Professor/Models/Professor.php
use Modules\Turma\Models\Turma;

public function turmas(): BelongsToMany
{
    return $this->belongsToMany(
        Turma::class,
        'professor_turma',
        'professor_id',
        'turma_id'
    )->withTimestamps();
}

// Modules/Turma/Models/Turma.php
use Modules\Professor\Models\Professor;

public function professores(): BelongsToMany
{
    return $this->belongsToMany(
        Professor::class,
        'professor_turma',
        'turma_id',
        'professor_id'
    )->withTimestamps();
}
```

### Professor ↔ Disciplina

- Um **Professor** pode lecionar muitas **Disciplinas** (BelongsToMany)
- Uma **Disciplina** pode ser lecionada por muitos **Professores** (BelongsToMany)
- Tabela pivot: `disciplina_professor`

**Implementação:**

```php
// Modules/Professor/Models/Professor.php
use Modules\Disciplina\Models\Disciplina;

public function disciplinas(): BelongsToMany
{
    return $this->belongsToMany(
        Disciplina::class,
        'disciplina_professor',
        'professor_id',
        'disciplina_id'
    )->withTimestamps();
}

// Modules/Disciplina/Models/Disciplina.php
use Modules\Professor\Models\Professor;

public function professores(): BelongsToMany
{
    return $this->belongsToMany(
        Professor::class,
        'disciplina_professor',
        'disciplina_id',
        'professor_id'
    )->withTimestamps();
}
```

### Disciplina ↔ Turma

- Uma **Disciplina** pode ser oferecida em muitas **Turmas** (BelongsToMany)
- Uma **Turma** pode ter muitas **Disciplinas** (BelongsToMany)
- Tabela pivot: `disciplina_turma`

**Implementação:**

```php
// Modules/Disciplina/Models/Disciplina.php
use Modules\Turma\Models\Turma;

public function turmas(): BelongsToMany
{
    return $this->belongsToMany(
        Turma::class,
        'disciplina_turma',
        'disciplina_id',
        'turma_id'
    )->withTimestamps();
}

// Modules/Turma/Models/Turma.php
use Modules\Disciplina\Models\Disciplina;

public function disciplinas(): BelongsToMany
{
    return $this->belongsToMany(
        Disciplina::class,
        'disciplina_turma',
        'turma_id',
        'disciplina_id'
    )->withTimestamps();
}
```

### Diagrama de Relacionamentos

```
┌─────────┐          ┌────────┐          ┌────────────┐
│  Aluno  │──────────│ Turma  │──────────│ Professor  │
└─────────┘          └────────┘          └────────────┘
  BelongsTo             │                      │
                   HasMany                 BelongsToMany
                        │                      │
                        └──────────────────────┘
                                │
                                │ BelongsToMany
                                │
                         ┌─────────────┐
                         │ Disciplina  │
                         └─────────────┘
                         BelongsToMany
                                │
                                └──> Professor
```

## Convenções e Boas Práticas

### Namespaces

Todos os módulos seguem o namespace `Modules\NomeDoModulo\`:

- Models: `Modules\NomeDoModulo\Models\`
- Controllers: `Modules\NomeDoModulo\Http\Controllers\`
- Requests: `Modules\NomeDoModulo\Http\Requests\`

### Views

As views dos módulos são referenciadas usando a notação `nomedomodulo::`:

```php
return view('aluno::index');
return view('turma::create');
```

### Rotas

- Rotas web são definidas em `routes/web.php` de cada módulo
- Rotas API são definidas em `routes/api.php` de cada módulo
- Todas as rotas são carregadas automaticamente pelo `RouteServiceProvider`

### Migrations

- Migrations são armazenadas em `database/migrations/` de cada módulo
- São carregadas automaticamente pelo service provider
- Use `php artisan migrate` para executar todas as migrations

## Comandos Úteis

### Gerenciamento de Módulos

```bash
# Criar um novo módulo
php artisan module:make NomeDoModulo

# Listar todos os módulos
php artisan module:list

# Habilitar um módulo
php artisan module:enable NomeDoModulo

# Desabilitar um módulo
php artisan module:disable NomeDoModulo

# Atualizar um módulo
php artisan module:update NomeDoModulo
```

### Geração de Código no Módulo

```bash
# Criar um controller
php artisan module:make-controller NomeController NomeDoModulo

# Criar um model
php artisan module:make-model NomeModel NomeDoModulo

# Criar uma migration
php artisan module:make-migration create_nome_table NomeDoModulo

# Criar um seeder
php artisan module:make-seed NomeSeeder NomeDoModulo

# Criar um request
php artisan module:make-request NomeRequest NomeDoModulo
```

### Migrations e Seeds

```bash
# Executar migrations de todos os módulos
php artisan migrate

# Executar migrations de um módulo específico
php artisan module:migrate NomeDoModulo

# Executar rollback
php artisan module:migrate-rollback NomeDoModulo

# Executar seeds
php artisan module:seed NomeDoModulo
```

## Autoload e Composer

O projeto utiliza o `wikimedia/composer-merge-plugin` para mesclar automaticamente os arquivos `composer.json` de cada módulo. Isso permite que cada módulo defina suas próprias dependências e autoload PSR-4.

### Configuração no composer.json principal:

```json
{
    "extra": {
        "merge-plugin": {
            "include": [
                "Modules/*/composer.json"
            ]
        }
    }
}
```

Após adicionar novos módulos ou modificar namespaces, execute:

```bash
composer dump-autoload
```

## Vantagens da Arquitetura Modular

### 1. Separação de Responsabilidades
Cada módulo é responsável por uma funcionalidade específica do sistema.

### 2. Reutilização de Código
Módulos podem ser reutilizados em outros projetos Laravel.

### 3. Desenvolvimento Paralelo
Equipes podem trabalhar em módulos diferentes simultaneamente sem conflitos.

### 4. Manutenibilidade
Código organizado em módulos é mais fácil de manter e entender.

### 5. Testabilidade
Cada módulo pode ser testado independentemente.

### 6. Escalabilidade
Novos módulos podem ser adicionados sem afetar os existentes.

## Planejamento de Novos Módulos

### Módulos Futuros Sugeridos:

1. **Professor**
   - Gerenciamento de professores
   - Atribuição de disciplinas
   - Vínculo com turmas

2. **Disciplina**
   - Cadastro de disciplinas
   - Grade curricular
   - Relacionamento com turmas e professores

3. **Avaliacao**
   - Sistema de notas
   - Tipos de avaliação
   - Cálculo de médias

4. **Frequencia**
   - Controle de presença
   - Relatórios de frequência
   - Justificativas de faltas

5. **Relatorio**
   - Geração de relatórios
   - Dashboards e estatísticas
   - Exportação de dados

6. **Comunicacao**
   - Sistema de mensagens
   - Notificações
   - Avisos e comunicados

## Referências

- [Laravel Modules Documentation](https://nwidart.com/laravel-modules)
- [Laravel 11 Documentation](https://laravel.com/docs/11.x)
- [PSR-4 Autoloading Standard](https://www.php-fig.org/psr/psr-4/)
- [Composer Merge Plugin](https://github.com/wikimedia/composer-merge-plugin)

## Suporte

Para dúvidas sobre a arquitetura modular, consulte:
- Documentação do nwidart/laravel-modules
- Este documento (MODULES.md)
- README.md do projeto

---

**Última atualização:** Janeiro 2026  
**Versão da arquitetura:** 1.0.0
