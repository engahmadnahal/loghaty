
@extends('layout.master')

@section('title',__('dash.level_setting'))
@section('title_page',__('dash.level_setting'))
@section('content')
<section class="page-users-view">
    <div class="row">
        <!-- account start -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.name_ar')}}</td>
                                    <td>{{$level->name_ar}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.name_en')}}</td>
                                    <td>{{$level->name_en}}</td>
                                </tr>
                               
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.state')}}</td>
                                    <td>{{$level->state}}</td>
                                </tr>

                                <tr>
                                    <td class="font-weight-bold">{{__('dash.num_games')}}</td>
                                    <td>{{$level->games->count()}}</td>
                                </tr>
                               
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <a href="{{route('levels.edit',$level->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- account end -->
        <!-- information start -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.history')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($level->history as $c)
                        <div class="row pb-1">
                            <div class="col-1"><i class="fa-solid fa-person-chalkboard" style=" font-size: 21px; "></i></div>
                            <div class="col-6">{{$c->children->semester->name}}</div>
                            <div class="col-5">
                                <div class="action-table">
                                    <span>{{$c->created_at->diffForHumans()}}</span>
                                </div>
                            </div>
                    </div>
                    @empty
                        <p class='text-center'>{{__('dash.no_results')}}</p>
                    @endforelse
                 
                </div>
            </div>
        </div>
        <!-- information start -->
        <!-- social links end -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.activity_user')}}</div>
                </div>
                <div class="card-body">
                    <div id="line-chart" class="height-400"></div>
                </div>
            </div>
        </div>
        <!-- social links end -->
      
        <!-- permissions end -->
    </div>
</section>
@endsection

@section('scripts')
<script>
 

    var lineChart = echarts.init(document.getElementById('line-chart'));

    data = [["2000-06-05",116],["2000-06-06",129],["2000-06-07",135],["2000-06-08",86],["2000-06-09",73],["2000-06-10",85],["2000-06-11",73],["2000-06-12",68],["2000-06-13",92],["2000-06-14",130],["2000-06-15",245],["2000-06-16",139],["2000-06-17",115],["2000-06-18",111],["2000-06-19",309],["2000-06-20",206],["2000-06-21",137],["2000-06-22",128],["2000-06-23",85],["2000-06-24",94],["2000-06-25",71],["2000-06-26",106],["2000-06-27",84],["2000-06-28",93],["2000-06-29",85],["2000-06-30",73],["2000-07-01",83],["2000-07-02",125],["2000-07-03",107],["2000-07-04",82],["2000-07-05",44],["2000-07-06",72],["2000-07-07",106],["2000-07-08",107],["2000-07-09",66],["2000-07-10",91],["2000-07-11",92],["2000-07-12",113],["2000-07-13",107],["2000-07-14",131],["2000-07-15",111],["2000-07-16",64],["2000-07-17",69],["2000-07-18",88],["2000-07-19",77],["2000-07-20",83],["2000-07-21",111],["2000-07-22",57],["2000-07-23",55],["2000-07-24",60]];

    var dateList = data.map(function (item) {
        return item[0];
    });
    var valueList = data.map(function (item) {
        return item[1];
    });

    var lineChartoption = {

        // Make gradient line here
        visualMap: [{
            show: false,
            type: 'continuous',
            seriesIndex: 0,
            min: 0,
            max: 400,
            color: [$dark_green, $lighten_green]
        }],
        tooltip: {
            trigger: 'axis'
        },
        xAxis: [{
            data: dateList,
            splitLine: {show: true}
        }],
        yAxis: [{
            splitLine: {show: false}
        }],
        series: [{
            type: 'line',
            showSymbol: false,
            data: valueList
        }]
    };

    lineChart.setOption(lineChartoption);
</script>
@endsection