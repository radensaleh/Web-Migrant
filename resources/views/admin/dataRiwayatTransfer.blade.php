<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Riwayat Transaksi | Admin Migrant Shop</title>

    <link rel="apple-touch-icon" href="/images/icon_migran.png">
    <link rel="shortcut icon" href="/images/icon_migran.png">

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
                  <li>
                      <a href="{{ route('dataToko') }}"><i class="menu-icon fa fa-rocket"></i>Data Toko </a>
                  </li>
                  <li>
                      <a href="{{ route('dataJenisBarang') }}"><i class="menu-icon fa fa-tags"></i>Data Jenis Barang </a>
                  </li>
                  <li class="menu-title">Transaksi</li><!-- /.menu-title -->
                  <li>
                      <a href="{{ route('dataKonfirmasiPembayaran') }}"><i class="menu-icon fa fa-check-circle"></i>Konfirmasi Pembayaran </a>
                  </li>
                  <li>
                      <a href="{{ route('dataProsesTransaksi') }}"><i class="menu-icon fa fa-truck"></i>Proses Transaksi </a>
                  </li>
                  <li>
                      <a href="{{ route('dataTransaksiDiterima') }}"><i class="menu-icon fa fa-handshake-o"></i>Transaksi Diterima</a>
                  </li>
                  <li class="active">
                      <a href="{{ route('dataRiwayatTransfer') }}"><i class="menu-icon fa fa-credit-card-alt"></i>Riwayat Transfer </a>
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
                  <!-- <a class="navbar-brand" href="{{ route('dashboardAdmin')}}">// LOGO SLURR</a> -->
                  <a class="navbar-brand" href="{{ route('dashboardAdmin')}}"><img src="/images/logo_migran.png" width="120" height="40" alt="Logo" style="margin-left:20px; padding-bottom:5px"></a>
                  <a class="navbar-brand hidden" href="{{ route('dashboardAdmin') }}"><img src="/images/logo_migran.png" alt="Logo"></a>
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
                                <h1>Data Transaksi</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('dashboardAdmin') }}">Dashboard</a></li>
                                    <li class="active">Data Transaksi</li>
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
                                <strong class="card-title">Data Transaksi</strong>
                                <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus-circle"></i> Add</button></strong> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kode Transaksi</th>
                                            <th>Tanggal Transaksi</th>
                                            <th>Status Transaksi</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($transaksi as $key => $data)
                                        <tr>
                                          <td>{{ ++$key }}</td>
                                          <td>{{ $data->kd_transaksi }}</td>
                                          <td>{{ $data->tgl_transaksi }}</td>
                                          <td><span class="btn btn-success btn-sm"><i class="fa fa-check-circle"></i> Selesai</span></td>
                                          <td>
                                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailData" data-kd_transaksi="{{ $data->kd_transaksi }}" data-nama_pemesan="{{ $data->user->nama_lengkap }}" data-foto_bukti="{{ $data->foto_bukti }}" data-tgl_transaksi="{{ $data->tgl_transaksi }}" data-total_harga="{{ $data->total_harga }}" data-nama_penerima="{{ $data->nama_penerima }}"><i class="fa fa-info"></i> Detail Transaksi</button>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="dataPesanan('{{$data->kd_transaksi}}')" data-toggle="modal" data-target="#detailPesanan"><i class="fa fa-shopping-cart"></i> Detail Pesanan</button>
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

        <!-- Modal Detail Data-->
        <div id="detailData" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> <span class="fa fa-info-circle">  </span> Detail Data</h4>
              </div>
              <div class="modal-body">
                   <table class="table table-striped table-bordered table-hover no-footer">
                       <tr>
                           <th style="padding-top: 80px;">Foto Bukti Transaksi</th>
                           <th><img id="foto" src="" style="width: 100%; height: 100%" alt="Pemesan belum mengupload foto" onerror="this.onerror=null; this.src='/images/not_found.jpg'"></th>
                       </tr>
                       <tr>
                           <th>Kode Transaksi</th>
                           <td id="kd_transaksi"></td>
                       </tr>
                       <tr>
                           <th>Nama Pemesan</th>
                           <td id="nama_pemesan"></td>
                       </tr>
                       <tr>
                           <th>Tanggal Transaksi</th>
                           <td id="tgl_transaksi"></td>
                       </tr>
                       <tr>
                           <th>Total Harga</th>
                           <td id="total_harga"></td>
                       </tr>
                       <tr>
                           <th>Nama Penerima</th>
                           <td id="nama_penerima"></td>
                       </tr>
                   </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
              </div>
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

          $('#detailData').on('show.bs.modal', function (event) {
            event.preventDefault();
            var button = $(event.relatedTarget) // Button that triggered the modal
            var kd_transaksi = button.data('kd_transaksi') // Extract info from data-* attributes
            var nama_pemesan = button.data('nama_pemesan')
            var foto_bukti = button.data('foto_bukti')
            var tgl_transaksi = button.data('tgl_transaksi')
            var total_harga = button.data('total_harga')
            var nama_penerima = button.data('nama_penerima')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var loadImg;

            if(foto_bukti != ""){
              loadImg = "http://192.168.8.101:8000/images/bukti_tf/"+foto_bukti
            }else{
              loadImg = "http://192.168.8.101:8000/images/not_found.jpg"
            }

            modal.find('.modal-body #foto').attr("src", loadImg)
            modal.find('.modal-body #kd_transaksi').text(kd_transaksi)
            modal.find('.modal-body #nama_pemesan').text(nama_pemesan)
            modal.find('.modal-body #tgl_transaksi').text(tgl_transaksi)
            modal.find('.modal-body #total_harga').text('Rp. ' + total_harga +',-')
            modal.find('.modal-body #nama_penerima').text(nama_penerima)
          });

        });

        function dataPesanan(kd_transaksi){
            window.location.href = "http://192.168.8.101:8000/admin/riwayatTransfer/toko/" + kd_transaksi + "/dataPesanan";
        }

    </script>

</body>
</html>
