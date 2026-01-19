<?php

namespace Tests\Feature;

use Tests\TestCase;

class FinanceiroRoutesTest extends TestCase
{
    /**
     * Test that financeiro.contas-receber.index route is defined.
     */
    public function test_financeiro_contas_receber_index_route_is_defined(): void
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('financeiro.contas-receber.index'),
            'Route [financeiro.contas-receber.index] should be defined'
        );
    }

    /**
     * Test that financeiro.contas-pagar.index route is defined.
     */
    public function test_financeiro_contas_pagar_index_route_is_defined(): void
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('financeiro.contas-pagar.index'),
            'Route [financeiro.contas-pagar.index] should be defined'
        );
    }

    /**
     * Test that financeiro.conciliacoes-bancarias.index route is defined.
     */
    public function test_financeiro_conciliacoes_bancarias_index_route_is_defined(): void
    {
        $this->assertTrue(
            \Illuminate\Support\Facades\Route::has('financeiro.conciliacoes-bancarias.index'),
            'Route [financeiro.conciliacoes-bancarias.index] should be defined'
        );
    }

    /**
     * Test that all CRUD routes for contas-receber are defined.
     */
    public function test_financeiro_contas_receber_crud_routes_are_defined(): void
    {
        $routes = [
            'financeiro.contas-receber.index',
            'financeiro.contas-receber.create',
            'financeiro.contas-receber.store',
            'financeiro.contas-receber.show',
            'financeiro.contas-receber.edit',
            'financeiro.contas-receber.update',
            'financeiro.contas-receber.destroy',
            'financeiro.contas-receber.receber',
        ];

        foreach ($routes as $route) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Route::has($route),
                "Route [{$route}] should be defined"
            );
        }
    }

    /**
     * Test that all CRUD routes for contas-pagar are defined.
     */
    public function test_financeiro_contas_pagar_crud_routes_are_defined(): void
    {
        $routes = [
            'financeiro.contas-pagar.index',
            'financeiro.contas-pagar.create',
            'financeiro.contas-pagar.store',
            'financeiro.contas-pagar.show',
            'financeiro.contas-pagar.edit',
            'financeiro.contas-pagar.update',
            'financeiro.contas-pagar.destroy',
            'financeiro.contas-pagar.pagar',
        ];

        foreach ($routes as $route) {
            $this->assertTrue(
                \Illuminate\Support\Facades\Route::has($route),
                "Route [{$route}] should be defined"
            );
        }
    }
}
