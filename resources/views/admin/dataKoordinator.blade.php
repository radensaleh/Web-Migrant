<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Koordinator | Admin Migrant Shop</title>

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
                    <li class="active">
                        <a href="{{ route('dataKoordinator') }}"><i class="menu-icon fa fa-user"></i>Data Koordinator </a>
                    </li>
                    <li>
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
                                            <th>Kode</th>
                                            <th>KTP</th>
                                            <th>Nama Lengkap</th>
                                            <th>Jenis Kelamin</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($koordinator as $key => $data)
                                        <tr>
                                          <td>{{ ++$key }}</td>
                                          <td>{{ $data->kd_koordinator }}</td>
                                          <td>{{ $data->KTP }}</td>
                                          <td>{{ $data->nama_lengkap }}</td>
                                          <td>{{ $data->jenis_kelamin }}</td>
                                          <td>
                                            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editData" data-kd_koordinator = "{{ $data->kd_koordinator }}" data-ktp="{{ $data->KTP }}" data-nama_lengkap="{{ $data->nama_lengkap }}" data-jenis_kelamin="{{ $data->jenis_kelamin }}" data-nomer_hp="{{ $data->nomer_hp }}" data-email="{{ $data->email }}"><i class="fa fa-edit"></i> Edit</button>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailData" data-kd_koordinator = "{{ $data->kd_koordinator }}" data-nama="{{ $data->nama_lengkap }}"><i class="fa fa-info"></i> Detail</button>
                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteData" data-kd_koordinator = "{{ $data->kd_koordinator }}"><i class="fa fa-trash"></i> Delete</button>
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
                <h4 class="modal-title"><span class="fa fa-plus-circle"></span> Add Koordinator</h4>
              </div>
              <div class="modal-body">
                <form id="modal-form-add" action="#" method="post" role="form">
                  {{ csrf_field() }}
                  <div class="form-group has-success">
                    <label for="KTP" class="form-control-label">Nomor KTP</label>
                    <input type="text" id="KTP" name="KTP" class="form-control" required/>
                    <span class="text-warning" ></span>
                  </div>
                  <div class="form-group has-success">
                    <label for="nama_lengkap" class="form-control-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" class="form-control">
                        <option value="1">Laki-Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="nomer_hp" class="form-control-label">Nomor HP</label>
                    <input placeholder="exp : 089247874182123" type="number" id="nomer_hp" name="nomer_hp" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="email" class="form-control-label">Email</label>
                    <input placeholder="exp : koor@gmail.com" type="email" id="email" name="email" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="provinsi" class="form-control-label">Provinsi</label>
                    <select id="provinsi" name="provinsi" class="form-control">
                        <option value="id">- Pilih Provisi -</option>
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="kabkota" class="form-control-label">Kabupaten/Kota</label>
                    <select id="kabkota" name="kabkota" class="form-control">
                        <option value="id">- Pilih Kota/Kabupaten -</option>
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="detail_alamat" class="form-control-label">Detail Alamat</label>
                    <textarea placeholder="exp : Jl.Lohbener Raya No 08 Rt 04 Rw 01" id="detail_alamat" name="detail_alamat" class="form-control" required></textarea>
                  </div>
                  <!-- <div class="form-group has-success">
                    <label for="daerah" class="form-control-label">Kabupaten/Kota</label>
                    <select id="daerah" name="daerah" class="form-control">
                        <option value="id">- Pilih Kota/Kabupaten -</option>
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="kecamatan" class="form-control-label">Kecamatan</label>
                    <select id="kecamatan" name="provinsi" class="form-control">
                        <option value="id">- Pilih Kecamatan -</option>
                    </select>
                  </div> -->
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
                    <input type="hidden" name="kd_koordinator" id="cat_kd" value="">
                  <div class="form-group has-warning">
                    <label for="kd_koordinator" class="form-control-label">Kode Koordinator</label>
                    <input type="text" id="kd_koordinator" name="kd_koordinator" class="form-control"  readonly />
                  </div>
                  <div class="form-group has-success">
                    <label for="KTP" class="form-control-label">Nomor KTP</label>
                    <input type="text" id="KTP" name="KTP" class="form-control" required/>
                    <span class="text-warning" ></span>
                  </div>
                  <div class="form-group has-success">
                    <label for="nama_lengkap" class="form-control-label">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="jenis_kelamin" class="form-control-label">Jenis Kelamin</label>
                    <select id="jenis_kelamin" name="jenis_kelamin" class="form-control">
                        <option value="1">Laki-Laki</option>
                        <option value="0">Perempuan</option>
                    </select>
                  </div>
                  <div class="form-group has-success">
                    <label for="nomer_hp" class="form-control-label">Nomor HP</label>
                    <input type="number" id="nomer_hp" name="nomer_hp" class="form-control" required />
                  </div>
                  <div class="form-group has-success">
                    <label for="email" class="form-control-label">Email</label>
                    <input type="email" id="email" name="email" class="form-control" required />
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

          // $('#addData').on('show.bs.modal', function(event) {
          //   event.preventDefault();
          //
          // });

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
                            window.location.href = "{{ route('dataKoordinator') }}";
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
                            window.location.href = "{{ route('dataKoordinator') }}";
                          }
                        });
                      }
                    }
                })
            });

            $('#editData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button = $(event.relatedTarget) // Button that triggered the modal
              var kd_koordinator = button.data('kd_koordinator') // Extract info from data-* attributes
              var ktp = button.data('ktp')
              var nama_lengkap = button.data('nama_lengkap')
              var jenis_kelamin = button.data('jenis_kelamin')
              var nomer_hp = button.data('nomer_hp')
              var email = button.data('email')
              var password = button.data('password')

              // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
              // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
              var modal = $(this)
              modal.find('.modal-body #kd_koordinator').val(kd_koordinator)
              modal.find('.modal-body #KTP').val(ktp)
              modal.find('.modal-body #nama_lengkap').val(nama_lengkap)
              modal.find('.modal-body #jenis_kelamin').val(jenis_kelamin)
              modal.find('.modal-body #nomer_hp').val(nomer_hp)
              modal.find('.modal-body #email').val(email)
              modal.find('.modal-body #cat_kd').val(kd_koordinator)
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
                          window.location.href = "{{ route('dataKoordinator') }}";
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
                          window.location.href = "{{ route('dataKoordinator') }}";
                        }
                      });
                    }
                  }
                })
            });

            $('#deleteData').on('show.bs.modal', function (event) {
              event.preventDefault();

              var button     = $(event.relatedTarget)
              var kd_koordinator = button.data('kd_koordinator')
              var modal      = $(this)
              modal.find('.modal-body #cat_kd').val(kd_koordinator)
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
                                window.location.href = "{{ route('dataKoordinator') }}";
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


              //RAJA ONGKIR
              var getProvince = "http://localhost:8000/koodinator/apiRajaOngkir/getProvince"
              var getKabKota  = "http://localhost:8000/koodinator/apiRajaOngkir/getKabKota"

              $.ajax({
                  url: getProvince,
                  type: "GET",
                  dataType: "json",
                  success: function( res ){
                    $('#addData').on('show.bs.modal', function (event) {
                        event.preventDefault();

                        $.each(res.rajaongkir.results, function(id, obj){
                          $("#provinsi").append($("<option></option>").attr("value", obj.province_id).text(obj.province));
                        });

                        $("#provinsi").change(function (){
                            var id_provinsi = $(this).val()

                            $.ajax({
                                url: getKabKota,
                                type: "POST",
                                data: {"_token": "{{ csrf_token() }}", "id_provinsi" : id_provinsi},
                                dataType: "json",
                                success: function( res ){
                                  $('#kabkota').empty();
                                      $.each(res.rajaongkir.results, function(id, obj){
                                         $("#kabkota").append($("<option></option>").attr("value", obj.city_id).text(obj.type + " " + obj.city_name));
                                      });
                                }
                            })
                        })
                    })
                  }

              })

              //RAJA API
              // $.ajax({
              //     url: "https://x.rajaapi.com/poe",
              //     type: "GET",
              //     dataType: "json",
              //     success: function( res ){
              //       var token = res.token;
              //
              //       //Provinsi
              //       $.ajax({
              //           url: "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/provinsi",
              //           type: "GET",
              //           dataType: "json",
              //           success: function( res ){
              //
              //             $('#addData').on('show.bs.modal', function (event) {
              //               event.preventDefault();
              //
              //               $.each(res.data, function(id, obj){
              //                    $("#provinsi").append($("<option></option>").attr("value", obj.id).text(obj.name));
              //               });
              //
              //
              //
              //                $("#provinsi").change(function (){
              //                     var id_provinsi = $(this).val()
              //                     getKotaKab(id_provinsi)
              //                })
              //
              //                $("#daerah").change(function (){
              //                     var id_daerah = $(this).val()
              //                     getKecamatan(id_daerah)
              //                })
              //
              //                //DAERAH
              //                function getKotaKab(id_provinsi){
              //                  $.ajax({
              //                      url: "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/kabupaten?idpropinsi=" + id_provinsi,
              //                      type: "GET",
              //                      dataType: "json",
              //                      success: function( res ){
              //                        $('#daerah').empty();
              //                        $('#kecamatan').empty().append('<option value="id">- Pilih Kecamatan -</option>');
              //                        $.each(res.data, function(id, obj){
              //                             $("#daerah").append($("<option></option>").attr("value", obj.id).text(obj.name));
              //                        });
              //                      }
              //                   })
              //                 }
              //
              //                 //KECAMATAN
              //                 function getKecamatan(id_daerah){
              //                   $.ajax({
              //                       url: "https://x.rajaapi.com/MeP7c5ne" + token + "/m/wilayah/kecamatan?idkabupaten=" + id_daerah,
              //                       type: "GET",
              //                       dataType: "json",
              //                       success: function( res ){
              //                         $('#kecamatan').empty();
              //                         $.each(res.data, function(id, obj){
              //                              $("#kecamatan").append($("<option></option>").attr("value", obj.id).text(obj.name));
              //                         });
              //                       }
              //                    })
              //                  }
              //
              //             })
              //
              //
              //           }
              //       })
              //
              //
              //     }
              // })

        });
    </script>

</body>
</html>
