<aside class="main-sidebar sidebar-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://faa.ao/mga/Home" class="brand-link">
      <img src="../dist/img/faa3.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Logi<b>Gate</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> 
          <!-- Add icons to the links using the .nav-icon class
                  with font-awesome or any other icon font library -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-tachometer-alt"></i>
                  <p>
                    Dashboard
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="/" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dashboard v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../index2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dashboard v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../../index3.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Dashboard v3</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')" class="nav-link">
                  <i class="fa fa-user nav-icon" aria-hidden="true"></i>
                  <p>Produtos</p>
                </a>
                <ul class="nav nav-treeview">
                  <li><a href="{{ route('produtos.index') }}" :active="request()->routeIs('processos.*')" class="nav-link">Produtos</a></li>
                  <li><a href="{{ route('produtos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link">Add Produto</a></li>
                  <li><a href="{{ route('arquivos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link">Tabela de Preços</a></li>
                  <li><a href="#" class="nav-link">Calculos e Tarifas</a></li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" :active="request()->routeIs('processos.*')" class="nav-link">
                  <i class="fa fa-file-text"></i>
                  <p>Documentos</p>
                </a>
                <ul class="nav nav-treeview">
                  <li><a href="{{ route('create.documento') }}" :active="request()->routeIs('processos.*')" class="nav-link">+ Documento</a></li>
                  <li><a href="{{ route('arquivos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link">Facturação</a></li>
                  <li><a href="{{ route('arquivos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link">Facturas por Liquidar</a></li>
                  <li><a href="#" class="nav-link"></a></li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-users"></i>
                  <p>Clientes <i class="right fas fa-angle-left"></i></p>
                  <span class="badge badge-info right">2</span>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="nav-link">
                      <i class="fas fa-user-plus nav-icon"></i>
                      <p>Clientes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="nav-link">
                      <i class="fas fa-user nav-icon"></i>
                      <p>Conta Corrente</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="nav-link">
                      <i class="fas fa-user-plus nav-icon"></i>
                      <p>Agentes</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{ route('customers.index') }}" :active="request()->routeIs('customers.*')" class="nav-link">
                      <i class="fas fa-user-plus nav-icon"></i>
                      <p>Histórico</p>
                    </a>
                  </li>
                </ul>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-archive"></i> <p>Processos <i class="right fas fa-angle-left"></i></p> </a>
                  <ul class="nav nav-treeview">
                    <li><a href="{{ route('processos.index') }}" :active="request()->routeIs('processos.*')" class="nav-link">Processos</a></li>
                    <li><a href="{{ route('processos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link">Novo Processo</a></li>
                    <li><a href="{{ route('arquivos.create') }}" :active="request()->routeIs('processos.*')" class="nav-link"> <i class="far fa-file-pdf nav-icon"></i> Arquivos</a></li>
                    <li><a href="#" class="nav-link"> <i class="far fa-calculator nav-icon"></i> Calculos e Tarifas</a></li>
                  </ul>
              </li>

              <!-- *********** Configurações ************ -->
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fa fa-users"></i> <p> Recursos Humanos  <i class="right fas fa-angle-left"></i> </p></a>
                  <ul class="nav nav-treeview">
                    <li> <a href="{{ route('funcionarios.index') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> <i class="nav-icon fa fa-user-plus"></i> Funcionarios</a></li>
                    <li> <a href="{{ route('departamentos.index') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Departamentos</a></li>
                    <li> <a href="{{ route('funcionarios.create') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Folha de Salário</a></li>
                    <li> <a href="{{ route('funcionarios.create') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Abonos/Descontos</a></li>
                    <li> <a href="{{ route('ponto') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Livro de Ponto</a></li>
                    <li> <a href="{{ route('funcionarios.create') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Faltas</a></li>
                    <li> <a href="{{ route('funcionarios.create') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Férias</a></li>
                    <li> <a href="{{ route('ferias.mapa') }}" :active="request()->routeIs('funcionarios.*')" class="nav-link"> Mapa de Férias e Licença</a></li>
                  </ul>
                
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-far"></i>
                  <p> Relatórios </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-far"></i>
                  <p> AGT <i class="right fas fa-angle-left"></i> </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-gear"></i><p> Configurações <i class="right fas fa-angle-left"></i> </p>
                  <ul class="nav nav-treeview">
                      <li> <a href="/Configuracoes/RH">RH</a> </li>
                  </ul>

                </a>
              </li>
        </ul>
      </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>