# Módulo de Matrícula

Este módulo gerencia as matrículas dos alunos nas turmas do sistema educacional.

## Características

- CRUD completo para matrículas
- Validação de vagas disponíveis nas turmas
- Geração automática de contas a receber (mensalidades)
- Controle de status da matrícula (ativo, cancelado, transferido, concluído)
- Integração com módulos Aluno, Turma e Financeiro

## Estrutura

```
Matricula/
├── app/
│   ├── Http/Controllers/
│   │   └── MatriculaController.php
│   ├── Models/
│   │   └── Matricula.php
│   └── Providers/
│       ├── MatriculaServiceProvider.php
│       ├── EventServiceProvider.php
│       └── RouteServiceProvider.php
├── database/
│   ├── migrations/
│   │   └── 2026_01_19_000000_create_matriculas_table.php
│   └── seeders/
│       └── MatriculaDatabaseSeeder.php
├── resources/
│   └── views/
│       ├── index.blade.php
│       ├── create.blade.php
│       ├── edit.blade.php
│       └── show.blade.php
└── routes/
    ├── web.php
    └── api.php
```

## Modelo

### Campos da Matrícula

- `aluno_id`: ID do aluno (foreign key)
- `turma_id`: ID da turma (foreign key)
- `data_matricula`: Data da matrícula
- `status`: Status da matrícula (ativo, cancelado, transferido, concluído)
- `valor_mensalidade`: Valor da mensalidade
- `numero_parcelas`: Número de parcelas (1-24)
- `data_inicio`: Data de início do curso
- `data_fim`: Data de fim do curso
- `observacoes`: Observações gerais

## Rotas

### Web Routes (autenticadas)

- `GET /matriculas` - Lista todas as matrículas
- `GET /matriculas/create` - Formulário de nova matrícula
- `POST /matriculas/matricular` - Processa nova matrícula (com geração de contas a receber)
- `GET /matriculas/{id}` - Exibe detalhes da matrícula
- `GET /matriculas/{id}/edit` - Formulário de edição
- `PUT /matriculas/{id}` - Atualiza matrícula
- `DELETE /matriculas/{id}` - Remove matrícula

## Método Especial: `matricular()`

O método `matricular()` do controller realiza o processo completo de matrícula:

1. **Validação de Dados**: Valida todos os campos recebidos
2. **Verificação de Vagas**: Verifica se há vagas disponíveis na turma
3. **Criação da Matrícula**: Cria o registro de matrícula
4. **Atualização da Turma**: Incrementa `vagas_ocupadas` na turma
5. **Geração de Contas a Receber**: Cria automaticamente as parcelas mensais

### Características do método:

- Usa transação de banco de dados para garantir integridade
- Implementa lock pessimista para evitar race conditions
- Gera documento único para cada parcela: `MAT-{id}-{mês}/{ano}`
- Rollback automático em caso de erro

### Exemplo de uso:

```php
POST /matriculas/matricular

{
    "aluno_id": 1,
    "turma_id": 5,
    "data_matricula": "2024-02-01",
    "valor_mensalidade": 500.00,
    "numero_parcelas": 12,
    "data_inicio": "2024-02-01",
    "data_fim": "2025-01-31",
    "observacoes": "Aluno regular"
}
```

## Relacionamentos

### Matricula Model

```php
// Pertence a um aluno
$matricula->aluno

// Pertence a uma turma
$matricula->turma
```

## Validações

- Aluno deve existir e estar ativo
- Turma deve existir, estar ativa e ter vagas disponíveis
- Data de fim deve ser posterior à data de início
- Número de parcelas entre 1 e 24
- Valor da mensalidade deve ser maior que zero

## Views

### index.blade.php
Lista todas as matrículas com filtros e paginação.

### create.blade.php
Formulário para nova matrícula. Usa o endpoint `/matriculas/matricular` para processar.

### edit.blade.php
Formulário de edição de matrícula existente.

### show.blade.php
Exibe detalhes completos da matrícula, incluindo informações do aluno e da turma.

## Integração com Financeiro

Ao realizar uma matrícula via método `matricular()`, são criados automaticamente registros em `contas_receber` com:

- Descrição: "Mensalidade X/Y - Nome do Aluno - Nome da Turma"
- Número de documento: "MAT-{matricula_id}-{mês}/{ano}"
- Categoria: "Mensalidade"
- Status: "pendente"
- Data de vencimento: calculada mês a mês a partir da data de início

## Instalação

O módulo já está configurado e habilitado. Para executar a migração:

```bash
php artisan migrate
```

## Exemplo de Fluxo

1. Usuário acessa `/matriculas/create`
2. Seleciona aluno e turma
3. Preenche dados da matrícula
4. Submete formulário para `/matriculas/matricular`
5. Sistema verifica vagas disponíveis
6. Cria matrícula e atualiza vagas da turma
7. Gera 12 contas a receber (uma por mês)
8. Redireciona para visualização da matrícula criada

## Observações

- O método `store()` cria apenas a matrícula sem gerar contas a receber
- O método `matricular()` é o recomendado para o processo completo
- Status pode ser alterado posteriormente via edição
- Ao cancelar matrícula, considere cancelar também as contas a receber pendentes
