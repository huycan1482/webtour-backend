@extends('admin.layouts.main')
@section('content')
<!-- thay the vao cho co tu khoa content -->

<section class="content-header">
    <h1>
        Dashboard
        <small>Control panel</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <!-- Small boxes (Stat box) -->
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        {{$numTour}}
                    </h3>

                    <p>Tours</p>
                </div>
                <div class="icon">
                    <i class="fa fas fa-map-marker-alt"></i>
                </div>
                <a href="{{ route('admin.tour.index') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    {{-- <h3><sup style="font-size: 20px">%</sup></h3> --}}
                    <h3>
                        {{ $numOrder }}
                    </h3>

                    <p>Orders</p>
                </div>
                <div class="icon">
                    {{-- <i class="ion ion-stats-bars"></i> --}}
                    <i class="fa fas fa-clipboard-list"></i>
                </div>
                <a href="{{ route('admin.order.index') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>{{$numCate}}</h3>

                    <p>Catgories</p>
                </div>
                <div class="icon">
                    <i class="fa fas fa-list-ul"></i>
                </div>
                <a href="{{ route('admin.category.index') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>{{$numUser}}</h3>

                    <p>Users</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{ route('admin.user.index') }}" class="small-box-footer">More info <i
                        class="fa fa-arrow-circle-right"></i></a>
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div style="display: flex">
        <div id="piechart" style="width: 100%; height: 500px;"></div>
        <div id="chart_div1" style="width: 100%; height: 500px;"></div>
    </div>
    <div id="chart_div2" style="width: 100%; height: 500px;"></div>
    
    {{-- {{ dd($country) }} --}}

    
</section>

@endsection

@section('my_script')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
    google.charts.load('current', {
        'packages': ['corechart']
    });
    google.charts.setOnLoadCallback(drawChart1);
    google.charts.setOnLoadCallback(drawVisualization);
    google.charts.setOnLoadCallback(drawChart2);

    function drawChart2() {
        var data = google.visualization.arrayToDataTable([
          ['Year', 'Sales'],
          {!! ($test2) !!}
        //   ['2013',  1000,],
        //   ['2014',  1170,],
        //   ['2015',  660,],
        //   ['2016',  1030,]
        ]);

        var options = {
          title: 'Company Performance',
          hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
          vAxis: {minValue: 0}
        };

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div2'));
        chart.draw(data, options);
      }

    function drawVisualization() {
        // Some raw data (not necessarily accurate)
        
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Tours trong nước', 'Tours nước ngoài'],
            
            {!! ($test) !!}
    
            // ['T1',  0,      0,],
            // ['T2',  135,      11,],
            // ['T3',  157,      11,],
            // ['T4',  139,      11,],
            // ['T5',  136,      69,],
            // ['T6',  136,      69,],
            // ['T7',  165,      93,],
            // ['T8',  135,      11,],
            // ['T9',  157,      11,],
            // ['T10',  139,      11,],
            // ['T11',  136,      69,],
            // ['T12',  136,      69,],
           
        ]);

        var options = {
          title : 'Lượng Tour bán trong nước và nước ngoài theo tháng',
          vAxis: {title: 'Số lượng'},
          hAxis: {title: 'tháng'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div1'));
        chart.draw(data, options);
      }

   
    function drawChart1() {
        $.ajax({
            type: "",
            url: "url",
            data: "data",
            dataType: "json",
            success: function (response) {
                console.log('check');
            }
        });
        
        var data = google.visualization.arrayToDataTable([
            ['Task', 'Hours per Day'],
            ['Tours khả dụng', {{ $enable_tour }} ],
            ['Tours hết chỗ', {{ $outnumber_tour }}],
            ['Tours quá hạn ', {{ $outdate_tour }}],
            
        ]);

        var options = {
            title: 'Thống kê Tour'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
    }

</script>
@endsection
