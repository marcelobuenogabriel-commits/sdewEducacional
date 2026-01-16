<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'gerenciar alunos',
            'visualizar alunos',
            'criar alunos',
            'editar alunos',
            'excluir alunos',
            'gerenciar turmas',
            'visualizar turmas',
            'criar turmas',
            'editar turmas',
            'excluir turmas',
            'gerenciar usuarios',
            'visualizar relatorios',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Create roles and assign permissions
        
        // Admin role - all permissions
        $adminRole = Role::create(['name' => 'administrador']);
        $adminRole->givePermissionTo(Permission::all());

        // Coordinator role - can manage students and classes
        $coordinatorRole = Role::create(['name' => 'coordenador']);
        $coordinatorRole->givePermissionTo([
            'gerenciar alunos',
            'visualizar alunos',
            'criar alunos',
            'editar alunos',
            'gerenciar turmas',
            'visualizar turmas',
            'criar turmas',
            'editar turmas',
            'visualizar relatorios',
        ]);

        // Teacher role - can view students and classes
        $teacherRole = Role::create(['name' => 'professor']);
        $teacherRole->givePermissionTo([
            'visualizar alunos',
            'visualizar turmas',
        ]);

        // Secretary role - can manage students
        $secretaryRole = Role::create(['name' => 'secretaria']);
        $secretaryRole->givePermissionTo([
            'gerenciar alunos',
            'visualizar alunos',
            'criar alunos',
            'editar alunos',
            'visualizar turmas',
        ]);
    }
}
