@extends('layouts.cms')

@section('content')

<div class="page-head">
  <h2 class="page-head-title">Dashboard</h2>
  <ol class="breadcrumb page-head-nav">
    <li><a href="#">Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</div>
<div class="main-content container-fluid">
  <div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">
      Kurva Transaksi Bengkel

      <hr>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <select name="bulan" class="form-control">
              <option>Pilih Bulan</option>
              @for($i=1; $i<=12; $i++)
              <option {{date('m')==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <select name="tahun" class="form-control">
              <option>Pilih Tahun</option>
              @foreach($tahun as $data)

              <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-lg btn-primary">Terapkan</button>
          </div>
        </div>

      </div>

    </div>
    <div class="panel-body">
    <div id="kurva-1"></div>
    </div>
  </div>
</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script type="text/javascript">
  $(function(){
    Highcharts.chart('kurva-1', {
        chart: {
            type: 'line'
        },
        title: {
            text: 'KURVA TRANSAKSI BULAN {{strtoupper(date('F'))}} {{date('Y')}}'
        },
        subtitle: {
            text: 'Bengkel Kece'
        },
        xAxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
        },
        yAxis: {
            title: {
                text: 'Jumlah Transaksi'
            }
        },
        plotOptions: {
            line: {
                dataLabels: {
                    enabled: true
                },
                enableMouseTracking: false
            }
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.4, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
  });
</script>
@endsection
