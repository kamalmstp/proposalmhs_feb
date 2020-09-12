<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('upload/img/logo.png') }}" height="30"> SI Proposal Kegiatan Mahasiswa</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
        <li class="nav-item {{ request()->is('/') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('home') }}" title="Dashboard">
            <i class="fa fa-fw fa-dashboard"></i>
            <span class="nav-link-text">Dashboard</span>
          </a>
        </li>
        @role(('admin'))
        <li class="nav-item " data-toggle="tooltip" data-placement="right" >
          <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseUsers" data-parent="#exampleAccordion" title="Manajemen User">
            <i class="fa fa-fw fa-users"></i>
            <span class="nav-link-text">Manajemen User</span>
          </a>
          <ul class="sidenav-second-level {{ request()->is('users/*') ? 'expand' : 'collapse' }}" id="collapseUsers">
            <li class="{{ request()->is('users/staff_list') ? ' active' : '' }}">
              <a href="{{ route('staff_list') }}" title="User Staff">Staff</a>
            </li>
            <li class="{{ request()->is('users/mahasiswa_list') ? ' active' : '' }}">
              <a href="{{ route('mahasiswa_list') }} " title="User Mahasiswa">Mahasiswa</a>
            </li>
          </ul>
        </li>
        <li class="nav-item {{ request()->is('prodi') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('prodi_list') }}" title="Manajemen Prodi">
            <i class="fa fa-fw fa-book"></i>
            <span class="nav-link-text">Manajemen Prodi</span>
          </a>
        </li>
        @endrole

        <!-- mulai edit -->
        <!-- @role(('dekan'))
        <li class="nav-item {{ request()->is('masuk') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_masuk') }}" title="Proposal Masuk">
            <i class="fa fa-fw fa-download"></i>
            <span class="nav-link-text">Proposal Masuk</span>
          </a>
        </li>
        <li class="nav-item {{ request()->is('disetujui') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right">
          <a class="nav-link" href="{{ route('proposal_disetujui') }}" title="Proposal Disetujui">
            <i class="fa fa-fw fa-check-square-o"></i>
            <span class="nav-link-text">Proposal Disetujui</span>
          </a>
        </li>
        <li class="nav-item {{ request()->is('rekap') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_rekap') }}" title="Rekap Proposal">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Rekap Proposal</span>
          </a>
        </li>
        @endrole
        @role(('wd2'))
        <li class="nav-item {{ request()->is('disetujui') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right">
          <a class="nav-link" href="{{ route('proposal_disetujui') }}" title="Proposal Disetujui">
            <i class="fa fa-fw fa-check-square-o"></i>
            <span class="nav-link-text">Proposal Disetujui</span>
          </a>
        </li>
        @endrole -->
        <!-- end edit -->

        @permission(('proposal_masuk'))
        <li class="nav-item {{ request()->is('masuk') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_masuk') }}" title="Proposal Masuk">
            <i class="fa fa-fw fa-download"></i>
            <span class="nav-link-text">Proposal Masuk</span>
          </a>
        </li>
        @endpermission
        @permission(('proposal_revisi'))
        <li class="nav-item {{ request()->is('revisi') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right">
          <a class="nav-link" href="{{ route('proposal_revisi') }}" title="Proposal Revisi">
            <i class="fa fa-fw fa-refresh"></i>
            <span class="nav-link-text">Proposal Revisi</span>
          </a>
        </li>
        @endpermission
        @permission(('proposal_disetujui'))
        <li class="nav-item {{ request()->is('disetujui') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right">
          <a class="nav-link" href="{{ route('proposal_disetujui') }}" title="Proposal Disetujui">
            <i class="fa fa-fw fa-check-square-o"></i>
            <span class="nav-link-text">Proposal Disetujui</span>
          </a>
        </li>
        @endpermission
        @permission(('proposal_ditolak'))
        <li class="nav-item {{ request()->is('ditolak') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right">
          <a class="nav-link" href="{{ route('proposal_ditolak') }}" title="Proposal Ditolak">
            <i class="fa fa-fw fa-times"></i>
            <span class="nav-link-text">Proposal Ditolak</span>
          </a>
        </li>        
        @endpermission
        @role(('mhs'))
        <li class="nav-item {{ request()->is('list') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_list') }}" title="List Proposal">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">List Proposal</span>
          </a>
        </li>
        @endrole
        @permission(('input_proposal'))
        <li class="nav-item {{ request()->is('input') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_input') }}" title="Input Proposal">
            <i class="fa fa-fw fa-pencil"></i>
            <span class="nav-link-text">Input Proposal</span>
          </a>
        </li>
        @endpermission
        @permission(('proposal_masuk'))
        <li class="nav-item {{ request()->is('rekap') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('proposal_rekap') }}" title="Rekap Proposal">
            <i class="fa fa-fw fa-list-alt"></i>
            <span class="nav-link-text">Rekap Proposal</span>
          </a>
        </li>
        @endpermission
        @permission(('proposal_revisi'))
        <li class="nav-item {{ request()->is('pagu/*') ? ' active' : '' }}" data-toggle="tooltip" data-placement="right" >
          <a class="nav-link" href="{{ route('pagu_list') }}" title="Pagu">
            <i class="fa fa-fw fa-money"></i>
            <span class="nav-link-text">Pagu</span>
          </a>
        </li>
        @endpermission

      </ul>
      <ul class="navbar-nav sidenav-toggler">
        <li class="nav-item">
          <a class="nav-link text-center" id="sidenavToggler">
            <i class="fa fa-fw fa-angle-left"></i>
          </a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto">             
        <li class="nav-item active">
          <div class="nav-link" >
            <span class="fa fa-fw fa-user"></span>{{ Auth::user()->name }}</div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
            <i class="fa fa-fw fa-sign-out"></i>Logout</a>
        </li>
      </ul>
    </div>
  </nav>