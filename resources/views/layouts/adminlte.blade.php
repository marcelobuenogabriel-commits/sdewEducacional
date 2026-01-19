@extends('adminlte::page')

@section('title', config('adminlte.title'))

@section('content_header')
    @yield('page_header')
@stop

@section('content')
    @yield('page_content')
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    <style>
        .content-wrapper {
            background-color: #f4f6f9;
        }
        
        .card {
            box-shadow: 0 0 1px rgba(0,0,0,.125), 0 1px 3px rgba(0,0,0,.2);
            margin-bottom: 1rem;
        }
        
        .card-header {
            background-color: transparent;
            border-bottom: 1px solid rgba(0,0,0,.125);
            padding: .75rem 1.25rem;
        }
        
        .btn {
            border-radius: 0.25rem;
        }
        
        .sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active {
            background-color: #007bff;
            color: #fff;
        }
        
        .brand-link {
            border-bottom: 1px solid #4b545c;
        }
        
        .table-responsive {
            overflow-x: auto;
        }
        
        .alert {
            border-radius: 0.25rem;
        }
        
        /* Custom colors for menu icons */
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
    </style>
    @yield('extra_css')
@stop

@section('js')
    {{-- Add here extra javascripts --}}
    <script>
        $(document).ready(function() {
            // Initialize tooltips
            $('[data-toggle="tooltip"]').tooltip();
            
            // Initialize popovers
            $('[data-toggle="popover"]').popover();
            
            // Auto-hide alerts after 5 seconds
            setTimeout(function() {
                $('.alert').fadeOut('slow');
            }, 5000);
        });
    </script>
    @yield('extra_js')
@stop
