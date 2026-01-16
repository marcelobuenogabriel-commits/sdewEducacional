# Guia de Migração - Zend Framework para Laravel 11

Este documento fornece orientações para a migração do sistema legado `zend_sdewEducation` (Zend Framework) para o novo `sdewEducacional` (Laravel 11).

## Visão Geral da Migração

A migração do Zend Framework para Laravel 11 foi realizada com foco em:
- Modernização da arquitetura
- Melhoria da segurança
- Facilidade de manutenção
- Escalabilidade
- Melhor experiência do desenvolvedor

## Principais Diferenças

### Estrutura de Diretórios

#### Zend Framework
```
zend_sdewEducation/
├── application/
│   ├── controllers/
│   ├── models/
│   └── views/
├── library/
└── public/
```

#### Laravel 11
```
sdewEducacional/
├── app/
│   ├── Http/Controllers/
│   ├── Models/
│   └── Providers/
├── resources/views/
├── routes/
└── public/
```

### Arquitetura

| Aspecto | Zend Framework | Laravel 11 |
|---------|----------------|------------|
| **ORM** | Zend_Db_Table | Eloquent ORM |
| **Rotas** | Configuração XML/INI | Arquivos PHP (web.php, api.php) |
| **Templates** | Zend_View | Blade Templates |
| **Autenticação** | Zend_Auth | Laravel Breeze/Sanctum |
| **Validação** | Zend_Validate | Form Requests |
| **Migrações** | Scripts SQL manuais | Laravel Migrations |

## Mapeamento de Conceitos

### Models

**Zend Framework:**
```php
class Application_Model_Aluno extends Zend_Db_Table_Abstract
{
    protected $_name = 'alunos';
    
    public function getAluno($id) {
        return $this->find($id)->current();
    }
}
```

**Laravel 11:**
```php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['nome', 'cpf', 'email', ...];
    
    public function turma() {
        return $this->belongsTo(Turma::class);
    }
}

// Uso
$aluno = Aluno::find($id);
```

### Controllers

**Zend Framework:**
```php
class AlunoController extends Zend_Controller_Action
{
    public function indexAction()
    {
        $model = new Application_Model_Aluno();
        $alunos = $model->fetchAll();
        $this->view->alunos = $alunos;
    }
}
```

**Laravel 11:**
```php
namespace App\Http\Controllers;

use App\Models\Aluno;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::paginate(15);
        return view('alunos.index', compact('alunos'));
    }
}
```

### Views

**Zend Framework:**
```php
<!-- application/views/scripts/aluno/index.phtml -->
<?php foreach ($this->alunos as $aluno): ?>
    <p><?php echo $this->escape($aluno->nome); ?></p>
<?php endforeach; ?>
```

**Laravel 11:**
```blade
{{-- resources/views/alunos/index.blade.php --}}
@foreach ($alunos as $aluno)
    <p>{{ $aluno->nome }}</p>
@endforeach
```

### Rotas

**Zend Framework:**
```ini
; application.ini
resources.router.routes.aluno.route = "aluno/:action"
resources.router.routes.aluno.defaults.controller = "aluno"
resources.router.routes.aluno.defaults.action = "index"
```

**Laravel 11:**
```php
// routes/web.php
Route::resource('alunos', AlunoController::class)->middleware('auth');
```

## Processo de Migração por Módulo

### 1. Módulo de Alunos

#### Passos Realizados:
- ✅ Criação do modelo `Aluno` com Eloquent
- ✅ Criação do controller `AlunoController` com CRUD completo
- ✅ Criação da migration `create_alunos_table`
- ✅ Definição de rotas resourceful
- ⏳ Criação de views (aguardando implementação)
- ⏳ Criação de testes (aguardando implementação)

#### Campos Migrados:
Todos os campos principais do sistema legado foram mapeados para a nova estrutura.

### 2. Módulo de Turmas

#### Passos Realizados:
- ✅ Criação do modelo `Turma` com Eloquent
- ✅ Criação do controller `TurmaController` com CRUD completo
- ✅ Criação da migration `create_turmas_table`
- ✅ Definição de relacionamento com Alunos
- ✅ Definição de rotas resourceful
- ⏳ Criação de views (aguardando implementação)
- ⏳ Criação de testes (aguardando implementação)

### 3. Sistema de Autenticação

#### Mudanças Principais:
- **Anterior:** Zend_Auth com ACL manual
- **Atual:** Laravel Breeze + Spatie Permission

#### Roles Implementadas:
1. **Administrador**: Acesso total
2. **Coordenador**: Gerencia alunos e turmas
3. **Professor**: Visualiza alunos e turmas
4. **Secretaria**: Gerencia alunos

## Checklist de Migração

### Fase 1: Infraestrutura ✅
- [x] Instalação do Laravel 11
- [x] Configuração do ambiente
- [x] Configuração do banco de dados
- [x] Instalação de pacotes essenciais

### Fase 2: Autenticação e Autorização ✅
- [x] Implementação do Laravel Breeze
- [x] Configuração do Sanctum
- [x] Implementação do Spatie Permission
- [x] Criação de roles e permissões

### Fase 3: Módulos Core ✅
- [x] Modelo e Controller de Alunos
- [x] Modelo e Controller de Turmas
- [x] Relacionamentos entre modelos
- [x] Validações básicas

### Fase 4: Views e Interface (Pendente)
- [ ] Views de listagem de alunos
- [ ] Views de formulários de alunos
- [ ] Views de listagem de turmas
- [ ] Views de formulários de turmas
- [ ] Dashboard principal

### Fase 5: Funcionalidades Avançadas (Planejado)
- [ ] Sistema de notas
- [ ] Gestão de professores
- [ ] Sistema de presenças
- [ ] Relatórios
- [ ] API RESTful completa

### Fase 6: Testes (Planejado)
- [ ] Testes unitários dos modelos
- [ ] Testes de integração dos controllers
- [ ] Testes de funcionalidades
- [ ] Testes de permissões

## Considerações Técnicas

### Banco de Dados

Se você já possui um banco de dados Zend existente:

1. **Análise do Schema Atual:**
   - Documente todas as tabelas
   - Identifique relacionamentos
   - Mapeie campos obsoletos

2. **Adaptação do Schema:**
   - Ajuste nomes de colunas para convenções Laravel (snake_case)
   - Adicione campos `created_at` e `updated_at`
   - Crie foreign keys apropriadas

3. **Migração de Dados:**
   ```bash
   # Exemplo de migração de dados
   php artisan make:command MigrateZendData
   ```

### Compatibilidade de Dados

Campos que podem necessitar transformação:
- Datas: Zend pode usar formatos diferentes
- Enums: Verificar se os valores correspondem
- Foreign keys: Garantir integridade referencial

## Scripts Úteis

### Backup do Banco Zend
```bash
mysqldump -u usuario -p zend_database > backup_zend.sql
```

### Importar dados para Laravel (se necessário)
```bash
mysql -u usuario -p sdew_educacional < dados_adaptados.sql
```

## Troubleshooting

### Problema: Caracteres especiais não aparecem corretamente
**Solução:** Verificar encoding do banco de dados (deve ser utf8mb4)

```sql
ALTER DATABASE sdew_educacional CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### Problema: Usuários do Zend não podem fazer login
**Solução:** As senhas precisam ser re-hasheadas com bcrypt do Laravel

```php
// Criar comando para migrar senhas
php artisan make:command MigratePasswords
```

### Problema: Relacionamentos não funcionam
**Solução:** Verificar foreign keys e convenções de nomenclatura

```php
// Especificar chaves personalizadas se necessário
public function turma()
{
    return $this->belongsTo(Turma::class, 'turma_id', 'id');
}
```

## Recursos Adicionais

- [Documentação Laravel 11](https://laravel.com/docs/11.x)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [Spatie Permission](https://spatie.be/docs/laravel-permission/v6/introduction)
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#laravel-breeze)

## Contato

Para dúvidas sobre a migração, entre em contato com a equipe de desenvolvimento.
