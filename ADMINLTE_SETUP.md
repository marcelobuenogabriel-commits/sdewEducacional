# AdminLTE 3 Setup Documentation

## Overview

This project now uses AdminLTE 3 for the admin panel interface. The setup provides a modern, responsive dashboard with a comprehensive navigation menu for all modules.

## Installation Summary

### 1. Package Installation
- **Package**: `jeroennoten/laravel-adminlte` version ^3.0
- **Installed via**: Composer
- **Assets**: Published to `public/vendor/adminlte/`

### 2. Configuration

#### Main Configuration File
Location: `config/adminlte.php`

Key configurations:
- **Title**: "Sdew Educacional"
- **Logo**: "<b>Sdew</b> Educacional"
- **Dashboard URL**: Uses route `dashboard`
- **Authentication**: Integrated with Laravel Breeze routes
- **URL Mode**: Route-based URLs (`use_route_url => true`)

#### Authentication Routes
- Login: `route('login')`
- Register: `route('register')`
- Logout: `route('logout')`
- Password Reset: `route('password.request')`
- Profile: `route('profile.edit')`

### 3. Layout Structure

#### Main Layout File
Location: `resources/views/layouts/adminlte.blade.php`

Features:
- Extends `adminlte::page`
- Custom CSS for styling
- JavaScript for tooltips, popovers, and auto-hide alerts
- Sections for `page_header` and `page_content`
- Custom icon colors for menu items

#### Usage Example
```blade
@extends('layouts.adminlte')

@section('title', 'Page Title')

@section('page_header')
    <h1>Page Header</h1>
@stop

@section('page_content')
    <!-- Your content here -->
    
    <!-- Alert with custom timeout (optional) -->
    <div class="alert alert-success" data-alert-timeout="10000">
        This alert will auto-hide after 10 seconds (10000ms)
    </div>
    
    <!-- Alert with default timeout (5 seconds) -->
    <div class="alert alert-info">
        This alert will auto-hide after 5 seconds (default)
    </div>
@stop
```

### 4. Navigation Menu Structure

The navigation menu is organized into logical groups with icons and colors:

#### GESTÃO ACADÊMICA (Academic Management)
- **Dashboard** - `fas fa-tachometer-alt` (cyan)
- **Alunos** - `fas fa-user-graduate` (blue) → `route('alunos.index')`
- **Turmas** - `fas fa-users` (green) → `route('turmas.index')`
- **Professores** - `fas fa-chalkboard-teacher` (purple) → `route('professores.index')`
- **Disciplinas** - `fas fa-book` (orange) → `route('disciplinas.index')`
- **Matrículas** - `fas fa-file-signature` (indigo) → `route('matriculas.index')`

#### AVALIAÇÃO E FREQUÊNCIA (Assessment & Attendance)
- **Avaliações** - `fas fa-clipboard-check` (teal) → `route('avaliacoes.index')`
- **Frequência** - `fas fa-calendar-check` (pink) → `route('frequencias.index')`

#### FINANCEIRO (Financial)
- **Financeiro** - `fas fa-dollar-sign` (success) - Submenu:
  - **Contas a Pagar** - `fas fa-money-bill-wave` → `route('contas-pagar.index')`
  - **Contas a Receber** - `fas fa-hand-holding-usd` → `route('contas-receber.index')`
  - **Conciliação Bancária** - `fas fa-university` → `route('conciliacoes-bancarias.index')`

#### RELATÓRIOS E COMUNICAÇÃO (Reports & Communication)
- **Relatórios** - `fas fa-chart-bar` (navy) → `route('relatorio.index')`
- **Mensagens** - `fas fa-envelope` (warning) → `route('mensagens.index')`

#### CONTA (Account)
- **Meu Perfil** - `fas fa-user` (gray) → `route('profile.edit')`

### 5. Dashboard Implementation

The dashboard has been updated to use AdminLTE components:

Location: `resources/views/dashboard.blade.php`

Features:
- **Small Boxes**: Info cards showing statistics
  - Total de Alunos (blue)
  - Total de Turmas (green)
  - Alunos Ativos (primary)
- **Quick Actions Card**: Links to create new students and classes
- **Welcome Card**: User greeting and instructions

### 6. Responsive Design

AdminLTE 3 provides:
- Mobile-responsive sidebar
- Collapsible menu
- Touch-friendly interface
- Fullscreen widget in navbar
- Search functionality in sidebar

### 7. Assets

All AdminLTE assets are loaded from CDN through the package, including:
- Bootstrap 4
- Font Awesome icons
- jQuery
- AdminLTE CSS and JavaScript
- Overlay Scrollbars
- Popper.js

### 8. Customization

#### Custom CSS
Located in `resources/views/layouts/adminlte.blade.php`:
- Card styling
- Button styling
- Sidebar active state
- Custom icon colors
- Responsive table styling

#### Custom Colors for Icons
```css
.icon-blue { color: #007bff !important; }
.icon-green { color: #28a745 !important; }
.icon-purple { color: #6f42c1 !important; }
.icon-orange { color: #fd7e14 !important; }
.icon-indigo { color: #6610f2 !important; }
.icon-teal { color: #20c997 !important; }
.icon-pink { color: #e83e8c !important; }
.icon-cyan { color: #17a2b8 !important; }
.icon-navy { color: #001f3f !important; }
.icon-warning { color: #ffc107 !important; }
.icon-success { color: #28a745 !important; }
.icon-gray { color: #6c757d !important; }
```

### 9. Authentication Integration

The system uses Laravel Breeze for authentication views (login, register, password reset) and AdminLTE for authenticated pages. This provides:
- Modern authentication UI with Breeze
- Professional admin panel with AdminLTE
- Seamless integration between both systems

### 10. Module Views Migration

To use AdminLTE in module views, update them to extend the AdminLTE layout:

**Before (Breeze):**
```blade
<x-app-layout>
    <x-slot name="header">
        <h2>Title</h2>
    </x-slot>
    <div class="py-12">
        <!-- content -->
    </div>
</x-app-layout>
```

**After (AdminLTE):**
```blade
@extends('layouts.adminlte')

@section('title', 'Title')

@section('page_header')
    <h1>Title</h1>
@stop

@section('page_content')
    <div class="card">
        <div class="card-body">
            <!-- content -->
        </div>
    </div>
@stop
```

### 11. Icon Reference

AdminLTE uses Font Awesome 5. Common icons:
- Users/People: `fa-user`, `fa-users`, `fa-user-graduate`, `fa-chalkboard-teacher`
- Academic: `fa-book`, `fa-clipboard-check`, `fa-calendar-check`, `fa-file-signature`
- Financial: `fa-dollar-sign`, `fa-money-bill-wave`, `fa-hand-holding-usd`, `fa-university`
- Navigation: `fa-tachometer-alt`, `fa-chart-bar`, `fa-envelope`, `fa-cog`

Full icon list: https://fontawesome.com/v5/search

### 12. Theme Features

AdminLTE 3 includes:
- Dark mode toggle (can be enabled in config)
- Multiple color schemes
- Collapsible sidebar
- Fixed/scrollable layout options
- Boxed/fluid layout options
- Multiple navbar variants
- Multiple sidebar variants

### 13. Development Tips

1. **Menu Configuration**: Edit `config/adminlte.php` to add/modify menu items
2. **Custom Styles**: Add to `@section('css')` in layout or individual views
3. **Custom Scripts**: Add to `@section('js')` in layout or individual views
4. **Widgets**: Use AdminLTE widgets from the documentation
5. **Plugins**: AdminLTE includes many useful plugins

### 14. Resources

- **AdminLTE Documentation**: https://adminlte.io/docs/3.2/
- **Laravel AdminLTE Package**: https://github.com/jeroennoten/Laravel-AdminLTE
- **Package Wiki**: https://github.com/jeroennoten/Laravel-AdminLTE/wiki
- **Font Awesome Icons**: https://fontawesome.com/v5/search
- **Bootstrap 4 Docs**: https://getbootstrap.com/docs/4.6/

### 15. Troubleshooting

**Issue**: Menu not showing correctly
**Solution**: Clear Laravel cache with `php artisan config:clear` and `php artisan cache:clear`

**Issue**: Icons not displaying
**Solution**: Ensure Font Awesome is loading. Check browser console for errors.

**Issue**: Sidebar not collapsing
**Solution**: Check JavaScript console for errors. Ensure jQuery is loaded before AdminLTE.

**Issue**: Custom styles not applying
**Solution**: Clear browser cache and ensure styles are in the correct section.

### 16. Next Steps

Consider migrating module views to use AdminLTE layout for consistency:
1. Aluno module views
2. Turma module views
3. Professor module views
4. Disciplina module views
5. Other module views

This will provide a consistent user experience throughout the application.

---

**Last Updated**: January 2026
**AdminLTE Version**: 3.2.0
**Laravel AdminLTE Package Version**: 3.15.3
