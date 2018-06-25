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
      Grafik Bengkel Pertahun
      <hr>
      <div class="row">
        <div class="col-md-4">
          <div class="form-group">
            <select name="tahun" class="tahun-kurva-1 form-control">
              <option>Pilih Tahun</option>
              @foreach($tahun as $data)

              <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-lg btn-primary filter-kurva-1">Terapkan</button>
          </div>
        </div>

      </div>

    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6">
          <div id="kurva-1"></div>

        </div>
        <div class="col-md-6">
          <div id="kurva-2"></div>

        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">
      Grafik Bengkel Perbulan
      <hr>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <select name="bulan" class="bulan-kurva-2 form-control">
              <option>Pilih Bulan</option>
              @for($i=1; $i<=12; $i++)
              <option {{date('m')==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <select name="tahun" class="tahun-kurva-2 form-control">
              <option>Pilih Tahun</option>
              @foreach($tahun as $data)

              <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-lg btn-primary filter-kurva-2">Terapkan</button>
          </div>
        </div>

      </div>

    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-6">
          <div id="kurva-3"></div>

        </div>
        <div class="col-md-6">
          <div id="kurva-4"></div>

        </div>
      </div>
    </div>
  </div>

  <div class="panel panel-default">
    <div class="panel-heading panel-heading-divider">
      Grafik Penjualan Sparepart Bulanan
      <hr>
      <div class="row">
        <div class="col-md-2">
          <div class="form-group">
            <select name="bulan" class="bulan-kurva-3 form-control">
              <option>Pilih Bulan</option>
              @for($i=1; $i<=12; $i++)
              <option {{date('m')==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
              @endfor
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <select name="tahun" class="tahun-kurva-3 form-control">
              <option>Pilih Tahun</option>
              @foreach($tahun as $data)

              <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
              @endforeach

            </select>
          </div>
        </div>
        <div class="col-md-2">
          <div class="form-group">
            <button type="button" class="btn btn-lg btn-primary filter-kurva-3">Terapkan</button>
          </div>
        </div>

      </div>

    </div>
    <div class="panel-body">
      <div class="row">
        <div class="col-md-12">
          <div id="kurva-5"></div>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          Grafik Kinerja Montir/Mekanik Bulanan
          <hr>
          <div class="row">
            <div class="col-md-2">
              <div class="form-group">
                <select name="bulan" class="bulan-kurva-4 form-control">
                  <option>Pilih Bulan</option>
                  @for($i=1; $i<=12; $i++)
                  <option {{date('m')==$i?'selected':''}} value="{{$i}}">{{$i}}</option>
                  @endfor
                </select>
              </div>
            </div>
            <div class="col-md-3">
              <div class="form-group">
                <select name="tahun" class="tahun-kurva-4 form-control">
                  <option>Pilih Tahun</option>
                  @foreach($tahun as $data)

                  <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
                  @endforeach

                </select>
              </div>
            </div>
        {{--     <div class="col-md-4">
              <div class="form-group">
                <select name="montir" class="montir-kurva-4 form-control select2">
                  <option>Pilih Montir</option>
                  @foreach($montir as $data)
                  <option {{$montir->first()->id==$data->id?'selected':''}} value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach

                </select>
              </div>
            </div> --}}
            <div class="col-md-2">
              <div class="form-group">
                <button type="button" class="btn btn-lg btn-primary filter-kurva-4">Terapkan</button>
              </div>
            </div>

          </div>

        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div id="kurva-6"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-6">
      <div class="panel panel-default">
        <div class="panel-heading panel-heading-divider">
          Grafik Kinerja Montir/Mekanik Tahunan
          <hr>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <select name="tahun" class="tahun-kurva-5 form-control">
                  <option>Pilih Tahun</option>
                  @foreach($tahun as $data)

                  <option {{date('Y')==$data->year?'selected':''}} value="{{$data->year}}">{{$data->year}}</option>
                  @endforeach

                </select>
              </div>
            </div>
            {{-- <div class="col-md-4">
              <div class="form-group">
                <select name="montir" class="tahun-kurva-5 form-control select2">
                  <option>Pilih Montir</option>
                  @foreach($montir as $data)
                  <option {{$montir->first()->id==$data->id?'selected':''}} value="{{$data->id}}">{{$data->nama}}</option>
                  @endforeach

                </select>
              </div>
            </div> --}}
            <div class="col-md-2">
              <div class="form-group">
                <button type="button" class="btn btn-lg btn-primary filter-kurva-5">Terapkan</button>
              </div>
            </div>

          </div>

        </div>
        <div class="panel-body">
          <div class="row">
            <div class="col-md-12">
              <div id="kurva-7"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
@section('script')
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script type="text/javascript">
  $(function(){
    var year = $('.tahun-kurva-1').val();
    var month = $('.bulan-kurva-2').val();
    grafikYear(year);
    grafikCountYear(year);
    grafikMonth(month,year);
    grafikCountMonth(month,year);
    grafikPartMonth(month,year);
    grafikMontirMonth(month,year);
    grafikMontirYear(year);


    $('.filter-kurva-1').click(function(){
      var year = $('.tahun-kurva-1').val();
      grafikYear(year);
      grafikCountYear(year);
    });

    $('.filter-kurva-2').click(function(){
      var month = $('.bulan-kurva-2').val();
      var year = $('.tahun-kurva-2').val();
      grafikMonth(month,year);
      grafikCountMonth(month,year);

    });

    $('.filter-kurva-3').click(function(){
      var month = $('.bulan-kurva-3').val();
      var year = $('.tahun-kurva-3').val();
      grafikPartMonth(month,year);
    });

    $('.filter-kurva-4').click(function(){
      var month = $('.bulan-kurva-4').val();
      var year = $('.tahun-kurva-4').val();
      grafikMontirMonth(month,year);
    });

    $('.filter-kurva-5').click(function(){
      var year = $('.tahun-kurva-5').val();
      grafikMontirYear(year);
    });




  });


  function grafikYear(year){
    $.get(`{{ url('/manager/transaksi/') }}/${year}`, function(data){

    }).done(function(data,xhr){
      if(data){
        Highcharts.chart('kurva-1', {
          chart: {
              type: 'line'
          },
          title: {
              text: 'GRAFIK TRANSAKSI TAHUN '+year
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: {
              title: {
                  text: 'Pendapatan Transaksi'
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
          series: data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikCountYear(year){
    $.get(`{{ url('/manager/transaksi/') }}/${year}/count`, function(data){

    }).done(function(data,xhr){
      if(data){
        Highcharts.chart('kurva-2', {
          chart: {
              type: 'line'
          },
          title: {
              text: 'GRAFIK TRANSAKSI TAHUN '+year
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
                  enableMouseTracking: true
              }
          },
          series: data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikMonth(month,year){
    $.get(`{{ url('/manager/transaksi/') }}/${month}/${year}`, function(data){

    }).done(function(res,xhr){
      if(res){
        Highcharts.chart('kurva-3', {
          chart: {
              type: 'line'
          },
          title: {
              text: `GRAFIK TRANSAKSI BULAN ${getMonthName(month).toUpperCase()} ${year}`
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: res.days
          },
          yAxis: {
              title: {
                  text: 'Pendapatan Transaksi'
              }
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: true
              }
          },
          series: res.data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikCountMonth(month,year){
    $.get(`{{ url('/manager/transaksi/') }}/${month}/${year}/count`, function(data){

    }).done(function(res,xhr){
      if(res){
        Highcharts.chart('kurva-4', {
          chart: {
              type: 'line'
          },
          title: {
              text: `GRAFIK TRANSAKSI BULAN ${getMonthName(month).toUpperCase()} ${year}`
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: res.days
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
                  enableMouseTracking: true
              }
          },
          series: res.data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikPartMonth(month,year){
    $.get(`{{ url('/manager/transaksi/') }}/${month}/${year}/part`, function(data){

    }).done(function(res,xhr){
      if(res){
        Highcharts.chart('kurva-5', {
          chart: {
              type: 'line'
          },
          title: {
              text: `GRAFIK PENJUALAN SPAREPART BULAN ${getMonthName(month).toUpperCase()} ${year}`
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: res.days
          },
          yAxis: {
              title: {
                  text: 'Jumlah'
              }
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: true
              }
          },
          series: res.data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikMontirMonth(month,year){
    $.get(`{{ url('/manager/transaksi/') }}/${month}/${year}/montir`, function(data){

    }).done(function(res,xhr){
      if(res){
        Highcharts.chart('kurva-6', {
          chart: {
              type: 'line'
          },
          title: {
              text: `GRAFIK KINERJA MONTIR/MEKANIK BULAN ${getMonthName(month).toUpperCase()} ${year}`
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: res.days
          },
          yAxis: {
              title: {
                  text: 'Jumlah Service Dilakukan'
              }
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: true
              }
          },
          series: res.data
        });
      }

    }).fail(function(data){

    });
  }

  function grafikMontirYear(year){
    $.get(`{{ url('/manager/transaksi/') }}/${year}/montir`, function(data){

    }).done(function(data,xhr){
      if(data){
        Highcharts.chart('kurva-7', {
          chart: {
              type: 'line'
          },
          title: {
              text: 'GRAFIK KINERJA MONTIR/MEKANIK TAHUN '+year
          },
          subtitle: {
              text: 'Bengkel Kece'
          },
          xAxis: {
              categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
          },
          yAxis: {
              title: {
                  text: 'Jumlah Service Dilakukan'
              }
          },
          plotOptions: {
              line: {
                  dataLabels: {
                      enabled: true
                  },
                  enableMouseTracking: true
              }
          },
          series: data
        });
      }

    }).fail(function(data){

    });
  }

  function getMonthName($num){

    const monthNames = ["Januari", "Februari", "Maret", "April", "Mei", "Juni",
      "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    return monthNames[$num-1];
  }
</script>
@endsection
