<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Sistema de Ventas</title>

  <!-- AdminLTE -->
  <link rel="stylesheet" href="{{ asset('template/plugins/fontawesome-free/css/all.min.css') }}">
  
  <link rel="stylesheet" href="{{ asset('template/dist/css/adminlte.min.css') }}">

  @livewireStyles
  @stack('styles')
</head>
<body class="hold-transition sidebar-mini ">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Puedes personalizar el navbar aquí -->
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>


<!-- Sidebar -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="#" class="brand-link text-center">
      <span class="brand-text font-weight-light">Sistema de Ventas</span>
    </a>
    <div class="sidebar">
      <!-- Agrega tu menú lateral aquí -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item">
            <a href="{{ route('dashboard') }}" class="nav-link">
              <i class="nav-icon fas fa-home"></i>
              <p>Inicio</p>
            </a>
          </li>
          <!-- Productos -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Productos
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('categorias.index') }}" class="nav-link {{ request()->routeIs('categorias.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Categorías</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('proveedores.index') }}" class="nav-link {{ request()->routeIs('proveedores.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Proveedores</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('productos.index') }}" class="nav-link {{ request()->routeIs('productos.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Productos</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Usuarios -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('usuarios.index') }}" class="nav-link {{ request()->routeIs('usuarios.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Usuario</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Inventarios -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Inventarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('inventarios.index') }}" class="nav-link {{ request()->routeIs('inventarios.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Inventario</p>
                </a>
              </li>
            </ul>
          </li>
          <!-- Compras -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Compras
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('compras.index') }}" class="nav-link {{ request()->routeIs('compras.*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-tags"></i>
                    <p>Compra</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </aside>

  

  <!-- Contenido -->
  <div class="content-wrapper pt-4">
    <div class="container-fluid">
      @yield('content')
    </div>
  </div>

  <!-- Footer -->
  <footer class="main-footer text-center">
    <strong>Sistema de Ventas &copy; {{ date('Y') }}</strong>
  </footer>

</div>

<!-- Scripts -->
<script src="{{ asset('template/plugins/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('template/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('template/dist/js/adminlte.min.js') }}"></script>

<!-- Sweetalert -->
<script src="{{ asset('vendor/sweetalert/sweetalert.all.js') }}"></script>
@include('sweetalert::alert')

@livewireScripts

@stack('js')


</body>
</html>
