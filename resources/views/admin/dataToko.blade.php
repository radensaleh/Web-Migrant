<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Toko | Admin Migrant Shop</title>

    <!-- <link rel="apple-touch-icon" href="/images/icon.png">
    <link rel="shortcut icon" href="/images/icon.png"> -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pixeden-stroke-7-icon@1.2.3/pe-icon-7-stroke/dist/pe-icon-7-stroke.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.2.0/css/flag-icon.min.css">
    <link rel="stylesheet" href="/assets/css/cs-skin-elastic.css">
    <link rel="stylesheet" href="/assets/css/lib/datatable/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <!-- <script type="text/javascript" src="https://cdn.jsdelivr.net/html5shiv/3.7.3/html5shiv.min.js"></script> -->
    <link href="https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/jqvmap@1.5.1/dist/jqvmap.min.css" rel="stylesheet">

    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous"> -->

    <!-- <link href="https://cdn.jsdelivr.net/npm/weathericons@2.1.0/css/weather-icons.css" rel="stylesheet" /> -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.9.0/dist/fullcalendar.min.css" rel="stylesheet" />

   <style>
    #weatherWidget .currentDesc {
        color: #ffffff!important;
    }
        .traffic-chart {
            min-height: 335px;
        }
        #flotPie1  {
            height: 150px;
        }
        #flotPie1 td {
            padding:3px;
        }
        #flotPie1 table {
            top: 20px!important;
            right: -10px!important;
        }
        .chart-container {
            display: table;
            min-width: 270px ;
            text-align: left;
            padding-top: 10px;
            padding-bottom: 10px;
        }
        #flotLine5  {
             height: 105px;
        }

        #flotBarChart {
            height: 150px;
        }
        #cellPaiChart{
            height: 160px;
        }

    </style>
</head>

<body>
    <!-- Left Panel -->
    <aside id="left-panel" class="left-panel">
        <nav class="navbar navbar-expand-sm navbar-default">
            <div id="main-menu" class="main-menu collapse navbar-collapse">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="{{ route('dashboardAdmin') }}"><i class="menu-icon fa fa-laptop"></i>Dashboard </a>
                    </li>
                    <li class="menu-title">Data</li><!-- /.menu-title -->
                    <li>
                        <a href="{{ route('dataKoordinator') }}"><i class="menu-icon fa fa-user"></i>Data Koordinator </a>
                    </li>
                    <li class="active">
                        <a href="{{ route('dataToko') }}"><i class="menu-icon fa fa-rocket"></i>Data Toko </a>
                    </li>
                    <li>
                        <a href="{{ route('dataJenisBarang') }}"><i class="menu-icon fa fa-tags"></i>Data Jenis Barang </a>
                    </li>
                    <li>
                        <a href=""><i class="menu-icon fa fa-shopping-cart"></i>Konfirmasi Pembayaran </a>
                    </li>
                    <li>
                        <a href=""><i class="menu-icon fa fa-database"></i>Data Pembayaran </a>
                    </li>
                </ul>
            </div><!-- /.navbar-collapse -->
        </nav>
    </aside>
    <!-- /#left-panel -->
    <!-- Right Panel -->
    <div id="right-panel" class="right-panel">
        <!-- Header-->
        <header id="header" class="header">
            <div class="top-left">
                <div class="navbar-header">
                  <a class="navbar-brand" href="{{ route('dashboardAdmin')}}">// LOGO SLURR</a>
                  <!-- <a class="navbar-brand" href="{{ route('dashboardAdmin')}}"><img src="/images/Logo_MGOLEM_Web1.png" width="170" height="40" alt="Logo"></a>
                  <a class="navbar-brand hidden" href="{{ route('dashboardAdmin') }}"><img src="/images/logo2.png" alt="Logo"></a> -->
                  <a id="menuToggle" class="menutoggle"><i class="fa fa-bars"></i></a>
                </div>
            </div>
            <div class="top-right">
                <div class="header-menu">
                    <div class="header-left">
                        <!-- <button class="search-trigger"><i class="fa fa-search"></i></button>
                        <div class="form-inline">
                            <form class="search-form">
                                <input class="form-control mr-sm-2" type="text" placeholder="Search ..." aria-label="Search">
                                <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                            </form>
                        </div> -->

                        <!-- <div class="dropdown for-notification">
                            <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-bell"></i>
                                <span class="count bg-danger">3</span>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="notification">
                                <p class="red">You have 3 Notification</p>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-check"></i>
                                    <p>Server #1 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-info"></i>
                                    <p>Server #2 overloaded.</p>
                                </a>
                                <a class="dropdown-item media" href="#">
                                    <i class="fa fa-warning"></i>
                                    <p>Server #3 overloaded.</p>
                                </a>
                            </div>
                        </div> -->

                    <div class="user-area dropdown float-right">
                        <a href="#" class="dropdown-toggle active" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img class="user-avatar rounded-circle" src="/images/admin/boy.png" alt="User Avatar">
                        </a>

                        <div class="user-menu dropdown-menu">
                            <a class="nav-link" href=""><i class="fa fa- user"></i>> Hello, {{ $name }}</a>

                            <!-- <a class="nav-link" href="#"><i class="fa fa- user"></i>Notifications <span class="count">3</span></a> -->

                            <!-- <a class="nav-link" href="#"><i class="fa fa -cog"></i>Settings</a> -->

                            <a class="nav-link" href="{{ route('logoutAdmin') }}"><i class="fa fa-power -off"></i>Logout</a>
                        </div>
                    </div>

                </div>
            </div>
        </header>
        <!-- /#header -->
        <!-- Content -->
        <div class="breadcrumbs">
            <div class="breadcrumbs-inner">
                <div class="row m-0">
                    <div class="col-sm-4">
                        <div class="page-header float-left">
                            <div class="page-title">
                                <h1>Dashboard</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('dashboardAdmin') }}">Dashboard</a></li>
                                    <li class="active">Data Koordinator</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="content">
            <div class="animated fadeIn">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <strong class="card-title">Data Koordinator <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus-circle"></i> Add</button></strong>
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Toko</th>
                                            <th>Nomor KTP Pemilik</th>
                                            <th>Nama Toko</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($toko as $key => $data)
                                        <tr>
                                          <td>{{ ++$key }}</td>
                                          <td>{{ $data->kd_toko }}</td>
                                          <td>{{ $data->KTP }}</td>
                                          <td>{{ $data->nama_toko }}</td>
                                          <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editData" data-kd_toko = "{{ $data->kd_toko }}" data-ktp="{{ $data->ktp }}" data-nama_toko="{{ $data->nama_toko }}" data-foto_toko="{{ $data->foto_toko }}" data-kd_user="{{ $data->kd_user }}" data-no_rekening="{{ $data->no_rekening }}"><i class="fa fa-edit"></i> Edit</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteData" data-kd_toko = "{{ $data->kd_toko }}"><i class="fa fa-trash"></i> Delete</button>
                                          </td>
                                        </tr>
                                      @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- .animated -->
        </div>
        <!-- .content -->

        <!-- Modal Add Data-->
        <div id="addData" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-plus-circle"></span> Add Toko</h4>
              </div>
              <div class="modal-body">
                <form id="modal-form-add" action="#" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="form-group has-success">
                    <label for="id_token" class="form-control-label">Token</label>
                    <input type="text" id="id_token" name="id_token" class="form-control" required/>
                    <span class="text-warning" ></span>
                  </div>
                  <div class="form-group has-success">
                    <label for="KTP" class="form-control-label">Nomor KTP Pemilik</label>
                    <input type="text" id="KTP" name="KTP" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="nama_toko" class="form-control-label">Nama Toko</label>
                    <input type="text" id="nama_toko" name="nama_toko" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="foto_toko" class="form-control-label">Foto Toko</label>
                    <input type="file" id="foto_toko" name="foto_toko" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="kd_user" class="form-control-label">Nama Pemilik</label>
                    <select id="kd_user" name="kd_user" class="form-control">
                      @foreach($user as $data)
                        <option value="{{ $data->kd_user }}">{{ $data->nama_lengkap }}</option>
                      @endforeach
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="no_rekening" class="form-control-label">Nomor Rekening</label>
                    <input type="number" id="no_rekening" name="no_rekening" class="form-control" required />
                  </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class=" btn btn-success"><span class="fa fa-plus-circle"></span> Submit</button>
                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal Edit Data-->
        <div id="editData" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-edit"></span> Edit Data</h4>
              </div>
                <form id="modal-form-edit" method="post" action="#">
                    {{ method_field('patch') }}
                    {{ csrf_field() }}
              <div class="modal-body">
                    <input type="hidden" name="kd_toko" id="cat_kd" value="">
                    <div class="form-group has-success">
                      <label for="kd_toko" class="form-control-label">Kode Toko</label>
                      <input type="text" id="kd_toko" name="kd_toko" class="form-control" required/>
                      <span class="text-warning" ></span>
                    </div>
                    <div class="form-group has-success">
                      <label for="KTP" class="form-control-label">Nomor KTP Pemilik</label>
                      <input type="text" id="KTP" name="KTP" class="form-control" required />
                    </div>
                    <div class="form-group has-success">
                      <label for="nama_toko" class="form-control-label">Nama Toko</label>
                      <input type="text" id="nama_toko" name="nama_toko" class="form-control" required />
                    </div>
                    <div class="form-group has-success">
                      <label for="foto_toko" class="form-control-label">Foto Toko</label>
                      <input type="file" id="foto_toko" name="foto_toko" class="form-control" required />
                    </div>
                    <div class="form-group has-success">
                      <label for="kd_user" class="form-control-label">Nama Pemilik</label>
                      <select id="kd_user" name="kd_user" class="form-control">
                        @foreach($user as $data)
                          <option value="{{ $data->kd_user }}">{{ $data->nama_lengkap }}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group has-success">
                      <label for="no_rekening" class="form-control-label">Nomor Rekening</label>
                      <input type="number" id="no_rekening" name="no_rekening" class="form-control" required />
                    </div>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-warning" id="btnEdit"><span class="fa fa-edit"></span> Edit</button>
                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <!-- Modal Delete Data-->
        <div id="deleteData" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title text-center"><span class="fa fa-check"></span> Delete Confirmation</h4>
              </div>
                <form id="modal-form-delete" method="post" action="#">
                    {{ method_field('delete') }}
                    {{ csrf_field() }}
              <div class="modal-body">
                    <input type="hidden" name="kd_koordinator" id="cat_kd" value="">
                    <p><center>Are you sure you want to delete this ?</center></p>
              </div>
              <div class="modal-footer">
                <button type="submit" class="btn btn-danger" id="btnDelete"><span class="fa fa-trash"></span> Yes, Delete</button>
                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> No, Cancel</button>
              </div>
              </form>
            </div>
          </div>
        </div>

        <div class="clearfix"></div>
        <!-- Footer -->
        <footer class="site-footer">
            <div class="footer-inner bg-white">
                <div class="row">
                    <div class="col-sm-6">
                        Copyright &copy; 2019 Migrant Shop
                    </div>
                    <div class="col-sm-6 text-right">
                        Designed by <a href="https://colorlib.com">Colorlib</a>
                    </div>
                </div>
            </div>
        </footer>
        <!-- /.site-footer -->
    </div>
    <!-- /#right-panel -->

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-match-height@0.7.2/dist/jquery.matchHeight.min.js"></script>
    <script src="https://unpkg.com/sweetalert2@7.1.0/dist/sweetalert2.all.js"></script>
    <script src="/assets/js/main.js"></script>


    <script src="/assets/js/lib/data-table/datatables.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/dataTables.buttons.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.bootstrap.min.js"></script>
    <script src="/assets/js/lib/data-table/jszip.min.js"></script>
    <script src="/assets/js/lib/data-table/vfs_fonts.js"></script>
    <script src="/assets/js/lib/data-table/buttons.html5.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.print.min.js"></script>
    <script src="/assets/js/lib/data-table/buttons.colVis.min.js"></script>
    <script src="/assets/js/init/datatables-init.js"></script>


    <script type="text/javascript">
        $(document).ready(function() {
          $('#bootstrap-data-table-export').DataTable();

          $('#addData').on('show.bs.modal', function(event) {
            event.preventDefault();
          });

          var formAdd    = $('#modal-form-add');
          formAdd.submit(function (e) {
              e.preventDefault();

              $.ajax({
                  url: formAdd.attr('action'),
                  type: "POST",
                  data: formAdd.serialize(),
                  dataType: "json",
                  success: function( res ){
                    console.log(res)
                    if( res.error == 0 ){
                      $('#addData').modal('hide');
                      swal(
                        'Success',
                        res.message,
                            'success'
                        ).then(OK => {
                          if(OK){
                            window.location.href = "{{ route('dataToko') }}";
                          }
                        });
                    } else{
                        $('#addData').modal('hide');
                        swal(
                          'Fail',
                          res.message,
                          'error'
                        ).then(OK => {
                          if(OK){
                            window.location.href = "{{ route('dataToko') }}";
                          }
                        });
                      }
                    }
                })
            });

            $('#editData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button = $(event.relatedTarget) // Button that triggered the modal
              var kd_toko = button.data('kd_toko') // Extract info from data-* attributes
              var ktp = button.data('KTP')
              var nama_toko = button.data('nama_toko')
              var foto_toko = button.data('foto_toko')
              var kd_user = button.data('kd_user')
              var no_rek = button.data('no_rekening')

              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-body #kd_toko').val(kd_toko)
              modal.find('.modal-body #KTP').val(ktp)
              modal.find('.modal-body #nama_toko').val(nama_toko)
              modal.find('.modal-body #foto_toko').val(foto_toko)
              modal.find('.modal-body #kd_user').val(kd_user)
              modal.find('.modal-body #no_rekening').val(no_rek)
              modal.find('.modal-body #cat_kd').val(kd_toko)
              // $("#kd_koordinator").prop('disabled', true);
            });

            var formEdit   = $('#modal-form-edit');
            formEdit.submit(function (e) {
            e.preventDefault();

            $.ajax({
                url: formEdit.attr('action'),
                type: "POST",
                data: formEdit.serialize(),
                dataType: "json",
                success: function( res ){
                  console.log(res)
                  if( res.error == 0 ){
                    $('#editData').modal('hide');
                    swal(
                      'Success',
                      res.message,
                          'success'
                      ).then(OK => {
                        if(OK){
                          window.location.href = "{{ route('dataToko') }}";
                        }
                      });
                  } else{
                      $('#editData').modal('hide');
                      swal(
                        'Fail',
                        res.message,
                        'error'
                      ).then(OK => {
                        if(OK){
                          window.location.href = "{{ route('dataToko') }}";
                        }
                      });
                    }
                  }
                })
            });

            $('#deleteData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button     = $(event.relatedTarget)
              var kd_toko    = button.data('kd_toko')
              var modal      = $(this)
              modal.find('.modal-body #cat_kd').val(kd_toko)
            });

            var formDelete = $('#modal-form-delete');
            formDelete.submit(function (e) {
                e.preventDefault();

                $.ajax({
                    url: formDelete.attr('action'),
                    type: "POST",
                    data: formDelete.serialize(),
                    dataType: "json",
                    success: function( res ){
              				console.log(res)
              				if( res.error == 0 ){
                        $('#deleteData').modal('hide');
              					swal(
              					  'Success',
              					  res.message,
                  					  'success'
                					).then(OK => {
                            if(OK){
                                window.location.href = "{{ route('dataToko') }}";
                            }
                          });
                  		}else{
                          $('#deleteData').modal('hide');
                  				swal(
                  				  'Fail',
                					  res.message,
                					  'error'
                					)
                				}
                			}
                  })
              });

        });
    </script>

</body>
</html>
