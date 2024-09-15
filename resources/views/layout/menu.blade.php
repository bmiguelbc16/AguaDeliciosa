<nav class="sidebar">
  <div class="sidebar-header">
    <a href="#" class="sidebar-brand">
      AGUA
      <span>DELICIOSA</span>
    </a>
    <div class="sidebar-toggler not-active">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </div>
  <div class="sidebar-body">
    <ul class="nav">

      <li class="nav-item nav-category">Principal</li>

      @role('Admin|Order_manager|Vendedor|Gestor de pedidos|Almacen')
        <li class="nav-item {{ active_class(['admin/dashboard']) }}">
          <a href="{{ route('admin.dashboard.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
      @endrole
      @role('Cliente')
        <li class="nav-item {{ active_class(['clientes/dashboard']) }}">
          <a href="{{ route('client.dashboard.index') }}" class="nav-link">
            <i class="link-icon" data-feather="box"></i>
            <span class="link-title">Dashboard</span>
          </a>
        </li>
      @endrole
      @role('Admin')
        <li class="nav-item nav-category">Seguridad y Permisos</li>
        <li class="nav-item {{ active_class(['admin/seguridad/trabajadores', 'admin/seguridad/trabajadores/*']) }}">
          <a href="{{ route('admin.employees.index') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Trabajadores</span>
          </a>
        </li>
      @endrole

      @role('Admin|Vendedor|Cliente|Gestor de pedidos|Almacen')
        <li class="nav-item nav-category">Registros</li>
      @endrole

      @role('Admin|Vendedor')
        <li class="nav-item {{ active_class(['admin/registros/clientes', 'admin/registros/clientes/*']) }}">
          <a href="{{ route('admin.clients.index') }}" class="nav-link">
            <i class="link-icon" data-feather="users"></i>
            <span class="link-title">Clientes</span>
          </a>
        </li>
      @endrole

      @role('Admin')
        <li class="nav-item {{ active_class(['admin/registros/productos', 'admin/registros/productos/*']) }}">
          <a href="{{ route('admin.products.index') }}" class="nav-link">
            <i class="link-icon" data-feather="droplet"></i>
            <span class="link-title">Productos</span>
          </a>
        </li>
      @endrole

      @role('Admin|Almacen')
        <li
          class="nav-item {{ active_class(['admin/registros/ingreso-de-productos', 'admin/registros/ingreso-de-productos/*']) }}">
          <a href="{{ route('admin.productEntries.index') }}" class="nav-link">
            <i class="link-icon" data-feather="plus"></i>
            <span class="link-title">Ingreso de Productos</span>
          </a>
        </li>
      @endrole

      @role('Admin|Almacen')
        <li
          class="nav-item {{ active_class(['admin/registros/salida-de-productos', 'admin/registros/salida-de-productos/*']) }}">
          <a href="{{ route('admin.productOutputs.index') }}" class="nav-link">
            <i class="link-icon" data-feather="minus"></i>
            <span class="link-title">Salida de Productos</span>
          </a>
        </li>
      @endrole

      @role('Admin|Vendedor|Gestor de pedidos')
        <li class="nav-item {{ active_class(['admin/registros/pedidos', 'admin/registros/pedidos/*']) }}">
          <a href="{{ route('admin.orders.index') }}" class="nav-link">
            <i class="link-icon" data-feather="package"></i>
            <span class="link-title">Pedidos</span>
          </a>
        </li>
      @endrole

      @role('Cliente')
        <li class="nav-item {{ active_class(['clientes/registros/pedidos', 'clientes/registros/pedidos/*']) }}">
          <a href="{{ route('client.orders.index') }}" class="nav-link">
            <i class="link-icon" data-feather="package"></i>
            <span class="link-title">Pedidos</span>
          </a>
        </li>
      @endrole
    </ul>
  </div>
</nav>
