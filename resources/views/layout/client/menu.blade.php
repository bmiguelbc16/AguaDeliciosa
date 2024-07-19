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
      <li class="nav-item {{ active_class(['pacientes/dashboard', 'pacientes/dashboard/*']) }}">
        <a href="{{ url('/pacientes') }}" class="nav-link">
          <i class="link-icon" data-feather="box"></i>
          <span class="link-title">Dashboard</span>
        </a>
      </li>

    </ul>
  </div>
</nav>
