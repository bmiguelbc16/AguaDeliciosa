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
      <li class="nav-item {{ active_class(['/']) }}">
        <a href="{{ url('/admin') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

      <li class="nav-item nav-category">Seguridad y Permisos</li>

      <li class="nav-item {{ active_class(['admin/seguridad/trabajadores', 'admin/seguridad/trabajadores/*']) }}">
        <a href="{{ route('admin.employees.index') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Trabajadores</span>
        </a>
      </li>

      <li class="nav-item nav-category">configuración</li>

      <li class="nav-item nav-category">Registros</li>

      <li class="nav-item {{ active_class(['admin/registros/clientes', 'admin/registros/clientes/*']) }}">
        <a href="{{ route('admin.clients.index') }}" class="nav-link">
          <i class="link-icon" data-feather="users"></i>
          <span class="link-title">Clientes</span>
        </a>
      </li>

    </ul>
  </div>
</nav>
