<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Data Pesanan | Admin Migrant Shop</title>

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
                  <li class="active">
                      <a href="{{ route('dataTransaksiDiterima') }}"><i class="menu-icon fa fa-handshake-o"></i>Transaksi Diterima</a>
                  </li>
                  <li>
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
                                <h1>Data Pesanan</h1>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-8">
                        <div class="page-header float-right">
                            <div class="page-title">
                                <ol class="breadcrumb text-right">
                                    <li><a href="{{ route('dashboardAdmin') }}">Dashboard</a></li>
                                    <li><a href="{{ route('dataTransaksiDiterima') }}">Data Transaksi</a></li>
                                    <li class="active">Data Pesanan</li>
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
                                <strong class="card-title">Data Pesanan</strong>
                                <!-- <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#addData"><i class="fa fa-plus-circle"></i> Add</button></strong> -->
                            </div>
                            <div class="card-body">
                                <table id="bootstrap-data-table" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Kd Pesanan</th>
                                            <th>Kd Transaksi</th>
                                            <!-- <th>Total Harga</th> -->
                                            <th>Kode Toko</th>
                                            <th>Status Pengiriman</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                      @foreach($pesanan as $key => $data)
                                        <tr>
                                          <td>{{ ++$key }}</td>
                                          <td>{{ $data->kd_pesanan }}</td>
                                          <td>{{ $data->kd_transaksi }}</td>
                                          <!-- @foreach($data->historis as $key => $historis)
                                            @if($key == 0)
                                              <td>{{ $historis->foto_bukti}}</td>
                                            @endif
                                          @endforeach -->

                                          <!-- <td>Rp. {{ $data->total_harga }},-</td> -->
                                          @foreach($data->list_barang as $key => $list)
                                            @if($key == 0)
                                              <td>{{ $list->barang->kd_toko }}</td>
                                            @endif
                                          @endforeach
                                          <td>
                                            @if( $data->status->id_status == 1 )
                                              <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-clock-o"></i> {{ $data->status->status }}</button>
                                            @elseif( $data->status->id_status == 2 )
                                              <button type="button" class="btn btn-success btn-sm"><i class="fa fa-check-square-o"></i> {{ $data->status->status }}</button>
                                            @elseif( $data->status->id_status == 3 )
                                              <button type="button" class="btn btn-warning btn-sm"><i class="fa fa-spinner"></i> {{ $data->status->status }}</button>
                                            @elseif( $data->status->id_status == 4 )
                                              <button type="button" class="btn btn-info btn-sm"><i class="fa fa-truck"></i> {{ $data->status->status }}</button>
                                            @else
                                              <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-check-circle"></i> {{ $data->status->status }}</button>
                                            @endif
                                          </td>
                                          <td>
                                            @foreach($data->list_barang as $key => $list)
                                              @if($key == 0)
                                              <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#detailData" data-kd_pesanan="{{ $data->kd_pesanan }}" data-kd_transaksi="{{ $data->kd_transaksi }}" data-kd_toko="{{ $list->barang->kd_toko }}" data-nama_toko="{{ $list->barang->toko->nama_toko }}" data-total_harga="{{ $data->total_harga }}" data-ongkir="{{ $data->ongkir }}" data-noresi="{{ $data->no_resi }}" data-ongkir="{{ $data->ongkir }}"
                                                data-kota="{{ $data->city->city_name }}" data-type="{{ $data->city->type }}" data-provinsi="{{ $data->city->province->province }}" data-status="{{ $data->status->status }}" data-no_rek="{{ $list->barang->toko->no_rekening }}" data-nama_nasabah="{{ $list->barang->toko->nama_nasabah }}" data-nama_bank="{{ $list->barang->toko->nama_bank }}"><i class="fa fa-info"></i> Detail</button>
                                                <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#uploadbukti" data-kd_pesanan="{{ $data->kd_pesanan }}" data-kd_transaksi="{{ $data->kd_transaksi }}"><i class="fa fa-camera"></i> Upload Bukti</button>
                                              @endif
                                            @endforeach
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
                           <th>Kode Pesanan</th>
                           <td id="kd_pesanan"></td>
                       </tr>
                       <tr>
                           <th>Kode Transaksi</th>
                           <td id="kd_transaksi"></td>
                       </tr>
                       <tr>
                         <th colspan="2"></th>
                       </tr>
                       <tr>
                           <th>Kode Toko</th>
                           <td id="kd_toko"></td>
                       </tr>
                       <tr>
                           <th>Nama Toko</th>
                           <td id="nama_toko"></td>
                       </tr>
                       <tr>
                           <th>Nomor Rekening</th>
                           <td id="no_rek" class="btn btn-danger btn-sm"></td>
                       </tr>
                       <tr>
                           <th>Nama Nasabah</th>
                           <td id="nama_nasabah"></td>
                       </tr>
                       <tr>
                         <th colspan="2"></th>
                       </tr>
                       <tr>
                           <th>Ongkir</th>
                           <td id="ongkir"></td>
                       </tr>
                       <tr>
                           <th>Total Harga</th>
                           <td id="total_harga"></td>
                       </tr>
                       <tr>
                           <th>Nomor Resi</th>
                           <td id="no_resi"></td>
                       </tr>
                       <tr>
                           <th>Provinsi</th>
                           <td id="provinsi"></td>
                       </tr>
                       <tr>
                           <th>Kota/Kab</th>
                           <td id="daerah"></td>
                       </tr>
                       <tr>
                           <th>Status Pengiriman</th>
                           <td id="status"></td>
                       </tr>
                   </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-info" data-dismiss="modal"><span class="fa fa-times-circle"></span> Close</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Modal Upload Bukti Data-->
        <div id="uploadbukti" class="modal fade" role="dialog">
          <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><span class="fa fa-camera"></span> Upload Bukti Transfer</h4>
              </div>
              <div class="modal-body">
                <form id="modal-form-uploadbukti" action="{{ route('uploadBuktiTF') }}" method="post" role="form" enctype="multipart/form-data">
                  {{ csrf_field() }}
                  <div class="form-group has-success">
                    <img src="" id="image-preview" width="100%" />
                    <br>
                    <input type="file" id="image-source" name="foto_bukti" onchange="previewImage();">
                    <input type="hidden" id="kd_pesanan" name="kd_pesanan" value="">
                    <input type="hidden" id="kd_transaksi" name="kd_transaksi" value="">
                    <!-- <span class="text-warning" ></span> -->
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
            var kd_pesanan = button.data('kd_pesanan') // Extract info from data-* attributes
            var kd_transaksi = button.data('kd_transaksi')
            var kd_toko = button.data('kd_toko')
            var nama_toko = button.data('nama_toko')
            var total_harga = button.data('total_harga')
            var ongkir = button.data('ongkir')
            var no_resi = button.data('noresi')
            var kota = button.data('kota')
            var type = button.data('type')
            var provinsi = button.data('provinsi')
            var status = button.data('status')
            var no_rek = button.data('no_rek')
            var nama_nasabah = button.data('nama_nasabah')
            var nama_bank = button.data('nama_bank')

            // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
            // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
            var modal = $(this)
            var resi;

            if(no_resi != ""){
              resi = no_resi;
            }else{
              resi = '-';
            }
            modal.find('.modal-body #kd_pesanan').text(kd_pesanan)
            modal.find('.modal-body #kd_transaksi').text(kd_transaksi)
            modal.find('.modal-body #kd_toko').text(kd_toko)
            modal.find('.modal-body #nama_toko').text(nama_toko)
            modal.find('.modal-body #no_rek').text(no_rek + ' (' + nama_bank + ')')
            modal.find('.modal-body #nama_nasabah').text(nama_nasabah)
            modal.find('.modal-body #ongkir').text('Rp. ' + ongkir +',-')
            modal.find('.modal-body #total_harga').text('Rp. ' + total_harga +',-')
            modal.find('.modal-body #no_resi').text(resi)
            modal.find('.modal-body #provinsi').text(provinsi)
            modal.find('.modal-body #daerah').text(type + ' ' + kota)
            modal.find('.modal-body #status').text(status)
          });

          $('#uploadbukti').on('show.bs.modal', function (event){
              event.preventDefault();

              var button = $(event.relatedTarget)
              var kd_pesanan = button.data('kd_pesanan')
              var kd_transaksi = button.data('kd_transaksi')

              var modal = $(this)
              modal.find('.modal-body #kd_pesanan').val(kd_pesanan)
              modal.find('.modal-body #kd_transaksi').val(kd_transaksi)
          });

          var formUploadBukti = $('#modal-form-uploadbukti');
          formUploadBukti.submit(function (e){
              e.preventDefault();

              var formData = new FormData(this);

              $.ajax({
                  url: formUploadBukti.attr('action'),
                  type: "POST",
                  data: formData,
                  dataType: "json",
                  cache: false,
                  contentType: false,
                  processData: false,
                  success: function( res ){
                    if( res.error == 0 ){
                      $('#uploadbukti').modal('hide');
                      swal(
                        'Success',
                        res.message,
                            'success'
                        ).then(OK => {
                          if(OK){
                              window.location.href = "http://localhost:8000/admin/dataTransaksi/toko/" + res.kd_transaksi + "/dataPesanan";
                          }
                        });
                    }else if( res.error == 1){
                        $('#uploadbukti').modal('hide');
                        swal(
                          'Fail',
                          res.message,
                          'error'
                        ).then(OK => {
                          if(OK){
                              window.location.href = "http://localhost:8000/admin/dataTransaksi/toko/" + res.kd_transaksi + "/dataPesanan";
                          }
                        });
                    }else if( res.error == 2){
                        $('#uploadbukti').modal('hide');
                        swal(
                          'Fail',
                          res.message,
                          'error'
                        ).then(OK => {
                          if(OK){
                              window.location.href = "http://localhost:8000/admin/dataTransaksi/toko/" + res.kd_transaksi + "/dataPesanan";
                          }
                        });
                    }else{
                      $('#uploadbukti').modal('hide');
                      swal(
                        'Fail',
                        res.message,
                        'error'
                      ).then(OK => {
                        if(OK){
                            window.location.href = "http://localhost:8000/admin/dataTransaksi/toko/" + res.kd_transaksi + "/dataPesanan";
                        }
                      });
                    }
                  }
              });
          });

        });

        function previewImage() {
  				document.getElementById("image-preview").style.display = "block";
  				var oFReader = new FileReader();
  				 oFReader.readAsDataURL(document.getElementById("image-source").files[0]);

  				oFReader.onload = function(oFREvent) {
  				  document.getElementById("image-preview").src = oFREvent.target.result;
  				};
			  };

    </script>

</body>
</html>
