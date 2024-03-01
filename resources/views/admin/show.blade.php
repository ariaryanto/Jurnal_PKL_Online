<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Jurnal PKL Online - Show</title>

    {{-- Fav Icon --}}
    @include('admin.layouts.icon')

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.css" rel="stylesheet">

        <!-- Custom styles for this page -->
        <link href="../../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        @include('admin.layouts.sidebar')
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                @include('admin.layouts.navbar')
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Show</h1>
                    </div>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Show</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Kegiatan</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Tanggal</th>
                                            <th>Waktu</th>
                                            <th>Kegiatan</th>
                                            <th>Edit</th>
                                        </tr>
                                    </tfoot>
                                    @foreach ($kegiatans as $index => $k )
                                        <tbody>
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $k->name }}</td>
                                            <td>{{ $k->tanggal }}</td>
                                            <td>{{ $k->waktu }}</td>
                                            <td>{{ $k->kegiatan }}</td>
                                        <td>
                                            <div class="container text-center">
                                                <div class="row">
                                                  <div class="col-xs">
                                                    <a href="{{ route('admin.sedit', $k->id) }}" class="btn btn-primary">Edit</a>
                                                  </div>
                                                  <div class="col-xs">
                                                    <form onsubmit="return confirm('Apakah Anda Yakin Ingin Menghapus ?');" action="{{ route('admin.sdelete', $k->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                                  </div>
                                                </div>
                                              </div>
                                        </td>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                                <center>
                                    {{  $kegiatans->withQueryString()->links() }}
                                </center>
                                <a href="{{ route('admin.pdf', $kegiatans->id) }}" target="_blank" class="btn btn-outline-secondary">Print</a>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

           <!-- Footer -->
            @include('admin.layouts.footer')
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!--Logout Modal-->
    @include('admin.layouts.modal-logout')
    <!--End Of Logout Modal-->

    <!--Tutor Modal-->
    @include('admin.layouts.modal-tutor')
    <!--End Of Tutor Modal-->
    
    <!-- Bootstrap core JavaScript-->
    <script src="../../../../vendor/jquery/jquery.min.js"></script>
    <script src="../../../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../../../vendor/datatables/dataTables.bootstrap4.min.js"></script>


    <!-- Page level plugins -->
    <script src="../../../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../../../js/demo/chart-area-demo.js"></script>
    <script src="../../../../js/demo/chart-pie-demo.js"></script>

        <!-- Page level custom scripts -->
        <script src="../../../../js/demo/datatables-demo.js"></script>

    <script>
        $('#tutor2').modal('show');
    </script>

    <script>
        setTimeout(function(){$('#tutor2').modal('hide')},5000);
    </script>

</body>

</html>