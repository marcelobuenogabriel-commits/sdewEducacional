# Sdew Educacional

Sistema de gerenciamento educacional desenvolvido em Laravel 11 com **arquitetura modular**, resultado da migração do sistema legado zend_sdewEducation (Zend Framework) para uma arquitetura moderna e escalável.

## 📋 Sobre o Projeto

O Sdew Educacional é um sistema de gestão educacional que facilita o gerenciamento de alunos, turmas, e outros módulos relacionados ao ambiente escolar. Este projeto representa a migração completa do sistema legado para Laravel 11, mantendo as funcionalidades essenciais e adicionando recursos modernos de segurança, usabilidade e **organização modular**.

## 🏗️ Arquitetura Modular

O projeto utiliza **nwidart/laravel-modules** para implementar uma arquitetura modular que oferece:

- ✅ **Separação de responsabilidades** - Cada módulo é independente
- ✅ **Reutilização de código** - Módulos podem ser compartilhados entre projetos
- ✅ **Desenvolvimento paralelo** - Equipes podem trabalhar em módulos diferentes
- ✅ **Manutenibilidade** - Código organizado e fácil de manter
- ✅ **Escalabilidade** - Adicione novos módulos sem afetar os existentes

### Módulos Implementados

#### 1. **Módulo Aluno** (`Modules/Aluno/`)
- Gerenciamento completo de alunos
- CRUD com validações
- Relacionamento com turmas
- Controle de status

#### 2. **Módulo Turma** (`Modules/Turma/`)
- Gerenciamento completo de turmas
- Controle de vagas
- Gerenciamento de períodos
- Relacionamento com alunos, professores e disciplinas

#### 3. **Módulo Professor** (`Modules/Professor/`)
- Gerenciamento completo de professores
- Dados profissionais e acadêmicos
- Relacionamento com turmas e disciplinas
- Controle de status (ativo, inativo, afastado, aposentado)

#### 4. **Módulo Disciplina** (`Modules/Disciplina/`)
- Gestão de disciplinas/matérias
- Carga horária e créditos
- Ementa e conteúdo programático
- Relacionamento com professores e turmas

Para mais detalhes sobre a arquitetura modular, consulte [MODULES.md](MODULES.md).

## 🚀 Tecnologias Utilizadas

- **Framework:** Laravel 11.x
- **Arquitetura:** Modular (nwidart/laravel-modules)
- **PHP:** 8.3+
- **Banco de Dados:** MySQL
- **Autenticação:** Laravel Breeze
- **API Authentication:** Laravel Sanctum
- **Controle de Permissões:** Spatie Laravel Permission
- **Frontend:** Blade Templates com Tailwind CSS
- **Build Tool:** Vite

## 📦 Funcionalidades Principais

### Módulos Implementados

1. **Autenticação e Autorização**
   - Sistema completo de login/registro
   - Controle de permissões baseado em roles
   - Gerenciamento de perfis de usuário

2. **Gestão de Alunos**
   - Cadastro completo de alunos
   - Gerenciamento de matrículas
   - Controle de status (ativo, inativo, trancado, concluído)
   - Vinculação com turmas

3. **Gestão de Turmas**
   - Criação e gerenciamento de turmas
   - Controle de vagas
   - Períodos (matutino, vespertino, noturno, integral)
   - Vinculação de alunos

## 🛠️ Instalação

### Pré-requisitos

- PHP 8.3 ou superior
- Composer
- MySQL 5.7+ ou MariaDB 10.3+
- Node.js 18+ e NPM

### Passos de Instalação

1. **Clone o repositório**
```bash
git clone https://github.com/marcelobuenogabriel-commits/sdewEducacional.git
cd sdewEducacional
```

2. **Instale as dependências do PHP**
```bash
composer install
```

3. **Instale as dependências do Node.js**
```bash
npm install
```

4. **Configure o arquivo de ambiente**
```bash
cp .env.example .env
```

Edite o arquivo `.env` e configure as credenciais do banco de dados:
```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=sdew_educacional
DB_USERNAME=seu_usuario
DB_PASSWORD=sua_senha
```

5. **Gere a chave da aplicação**
```bash
php artisan key:generate
```

6. **Execute as migrações do banco de dados**
```bash
php artisan migrate
```

7. **Compile os assets do frontend**
```bash
npm run build
```

Para desenvolvimento:
```bash
npm run dev
```

8. **Inicie o servidor de desenvolvimento**
```bash
php artisan serve
```

Acesse a aplicação em: `http://localhost:8000`

## 📚 Estrutura do Projeto

```
sdewEducacional/
├── app/                      # Código core da aplicação
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/              # Models compartilhados (User)
│   └── Providers/
├── Modules/                 # Módulos da aplicação
│   ├── Aluno/              # Módulo de Alunos
│   │   ├── app/
│   │   │   ├── Http/Controllers/
│   │   │   ├── Models/
│   │   │   └── Providers/
│   │   ├── database/migrations/
│   │   ├── resources/views/
│   │   └── routes/
│   └── Turma/              # Módulo de Turmas
│       ├── app/
│       │   ├── Http/Controllers/
│       │   ├── Models/
│       │   └── Providers/
│       ├── database/migrations/
│       ├── resources/views/
│       └── routes/
├── database/
│   ├── migrations/          # Migrations do core
│   └── seeders/
├── resources/
│   ├── views/              # Views do core (layouts, auth)
│   └── css/
├── routes/
│   ├── web.php             # Rotas do core
│   └── auth.php
├── config/
│   └── modules.php         # Configuração dos módulos
├── MODULES.md              # Documentação da arquitetura modular
└── README.md
```

Para detalhes completos sobre a estrutura modular, veja [MODULES.md](MODULES.md).

## 🔐 Controle de Permissões

O sistema utiliza o pacote Spatie Laravel Permission para gerenciamento de roles e permissões. Para criar roles e permissões:

```php
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

// Criar uma permissão
Permission::create(['name' => 'gerenciar alunos']);

// Criar uma role
$role = Role::create(['name' => 'administrador']);
$role->givePermissionTo('gerenciar alunos');

// Atribuir role a um usuário
$user->assignRole('administrador');
```

## 🗃️ Banco de Dados

### Estrutura Principal

#### Tabela: alunos
- Informações pessoais completas
- Dados de contato
- Endereço
- Vínculo com turma
- Status do aluno

#### Tabela: turmas
- Informações da turma
- Código único
- Período e ano
- Controle de vagas
- Relacionamento com alunos

## 📝 Convenções de Código

- **PSR-12:** Padrão de código PHP
- **Models:** Singular, PascalCase (ex: `Aluno`, `Turma`)
- **Controllers:** Singular + "Controller" (ex: `AlunoController`)
- **Views:** Plural, kebab-case (ex: `alunos/index.blade.php`)
- **Routes:** Plural, kebab-case (ex: `/alunos`, `/turmas`)
- **Migrations:** snake_case (ex: `create_alunos_table`)

## 🧪 Testes

Execute os testes com:

```bash
php artisan test
```

Ou com PHPUnit:

```bash
./vendor/bin/phpunit
```

## 🤝 Contribuindo

1. Fork o projeto
2. Crie uma branch para sua feature (`git checkout -b feature/MinhaFeature`)
3. Commit suas mudanças (`git commit -m 'Adiciona MinhaFeature'`)
4. Push para a branch (`git push origin feature/MinhaFeature`)
5. Abra um Pull Request

## 📄 Licença

Este projeto é proprietário e confidencial.

## 👥 Equipe

- **Desenvolvedor Principal:** Marcelo Bueno Gabriel

## 📞 Suporte

Para suporte ou dúvidas, entre em contato através de:
- Email: [seu-email@exemplo.com]
- Issues: [GitHub Issues](https://github.com/marcelobuenogabriel-commits/sdewEducacional/issues)

## 🔄 Migração do Zend Framework

Este projeto é resultado da migração do sistema legado `zend_sdewEducation`. Para informações sobre o processo de migração, consulte a documentação específica de migração.

### Principais Mudanças

- Modernização da arquitetura para Laravel 11
- Implementação de autenticação com Laravel Breeze
- Adoção de Eloquent ORM
- Interface moderna com Tailwind CSS
- API RESTful com Laravel Sanctum
- Sistema de permissões com Spatie Permission

## 🔮 Roadmap

- [x] Arquitetura modular com nwidart/laravel-modules
- [x] Módulo de Alunos
- [x] Módulo de Turmas
- [x] Módulo de Professores
- [x] Gestão de Disciplinas
- [ ] Sistema de Notas e Avaliações
- [ ] Sistema de Frequência
- [ ] Relatórios e Dashboards
- [ ] API completa para integração
- [ ] Aplicativo mobile

## 📖 Documentação Adicional

- [MODULES.md](MODULES.md) - Documentação completa da arquitetura modular
- [DATABASE.md](DATABASE.md) - Estrutura do banco de dados
- [MIGRATION_GUIDE.md](MIGRATION_GUIDE.md) - Guia de migração do Zend Framework
- [SETUP_SUMMARY.md](SETUP_SUMMARY.md) - Resumo da configuração inicial

## 🔧 Comandos de Módulos

### Gerenciamento de Módulos
```bash
# Criar um novo módulo
php artisan module:make NomeDoModulo

# Listar todos os módulos
php artisan module:list

# Habilitar/Desabilitar módulo
php artisan module:enable NomeDoModulo
php artisan module:disable NomeDoModulo
```

### Geração de Código
```bash
# Criar controller no módulo
php artisan module:make-controller NomeController NomeDoModulo

# Criar model no módulo
php artisan module:make-model NomeModel NomeDoModulo

# Criar migration no módulo
php artisan module:make-migration create_nome_table NomeDoModulo
```

Veja [MODULES.md](MODULES.md) para mais comandos e exemplos.

---

**Versão:** 1.0.0  
**Data de Lançamento:** Janeiro 2026
