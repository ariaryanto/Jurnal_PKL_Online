<!DOCTYPE html>
<html>
<head>
  <title>Jurnal PKL Online - Print</title>

  {{-- Fav Icon --}}
    @include('user.layouts.icon')

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-lg-12" style="margin-top: 15px ">
        <div class="pull-left">
          <h2>Jurnal PKL Online</h2>
        </div>
      </div>
    </div><br>
    <table class="table table-bordered">
      <tr>
        <th>Nama</th>
        <th>Tanggal</th>
        <th>waktu</th>
        <th>Kegiatan</th>
      </tr>
      @foreach ($printkegiatans as $k)
      <tr>
        <td>{{ $k->name }}</td>
        <td>{{ $k->tanggal }}</td>
        <td>{{ $k->waktu }}</td>
        <td>{{ $k->kegiatan }}</td>
      </tr>
      @endforeach
    </table>
  </div>

  <script type="text/javascript">
  window.print();
  </script>

</body>
</html>