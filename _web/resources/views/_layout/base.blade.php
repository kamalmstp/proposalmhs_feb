<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Sistem Informasi Proposal Kegiatan Mahasiswa</title>
  <link href="{{ asset('upload/img/logo.png') }}" rel="shortcut icon">

  @section('css')
  <!-- Bootstrap core CSS-->
  <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('css/form.css') }}" rel="stylesheet">
  <!-- Custom fonts for this template-->
  <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet" type="text/css"><!-- Custom styles for this template-->
  <link href="{{ asset('css/sb-admin.css') }}" rel="stylesheet">
  @show

</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
  <!-- Navigation-->
  
  @include('_layout.menu')
  
  <div class="content-wrapper">
    <div class="container-fluid">

      @yield('content')
      
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
      <div class="container">
        <div class="text-center">
          <small>Copyright © Fakultas Ekonomi dan Bisnis ULM 2018</small>
        </div>
      </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anda yakin akan Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih Logout untuk keluar</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-primary" href="{{ route('logout')}}">Logout</a>
          </div>
        </div>
      </div>
    </div>
    @section('js')
    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
     <script src="{{ asset('js/bootstrap-confirmation.min.js') }}"></script>
    <!-- Core plugin JavaScript-->
    <script src="{{ asset('js/jquery.easing.min.js') }}"></script>
    <!-- Custom scripts for all pages-->
    <script src="{{ asset('js/sb-admin.min.js') }}"></script>
 
    @show
  </div>
</body>

</html>
