<aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://faa.ao/mga/Home" class="brand-link">
      <img src="{{ asset('dist/img/faa3.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Logi<b>Gate</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
            <!-- Add icons to the links using the .nav-icon class with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link"> <i class="nav-icon fas fa-tachometer-alt"></i><p>Dashboard</p></a>
                </li>

                @if(auth()->user()->empresa)
                    <li class="nav-item">
                        @if(auth()->user()->empresa)
                            <a href="{{ route('empresa.edit', auth()->user()->empresa->Id) }}" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i> <p>Dados da Empresa</p>
                            </a>
                        @else
                            <!-- Caso o usuário não tenha uma empresa associada, você pode adicionar uma lógica alternativa aqui -->
                            <span class="nav-link text-muted">
                                <i class="nav-icon fas fa-tachometer-alt"></i> <p>Dados da Empresa</p>
                            </span>
                        @endif
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('empresas.subscricao') }}" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i> <p> Subscrição</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i> <p> Histórico de Pag.</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i> <p> Migração de Dados</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i> <p> Personalizar Impre. A4</p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-far"></i>
                        <p> Relatórios </p>
                        </a>
                    </li>

                @else
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i> <p> Sem Menu</p>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>