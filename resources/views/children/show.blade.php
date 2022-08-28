
@extends('layout.master')

@section('title',__('dash.account_setting'))
@section('title_page',__('dash.account_setting'))
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
                        <div class="users-view-image mb-1">
                            <img src="{{$children->image_profile}}" class="users-avatar-shadow w-100 h-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.name')}}</td>
                                    <td>{{$children->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.father')}}</td>
                                    <td>{{$children->father->email}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.country')}}</td>
                                    <td>{{$children->country->name}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.status')}}</td>
                                    <td>{{$children->status_user}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.class')}}</td>
                                    <td>{{$children->semester->name}}</td>
                                </tr>
                               
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <a href="{{route('childrens.edit',$children->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 ">
            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.history_user')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.levels')}}</th>
                                        <th>{{__('dash.games')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($children->histories as $h)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$h->level->name}}</td>
                                            <td>{{$h->game->name}}</td>
                                            <td>{{$h->created_at->diffForHumans()}}</td>
                                          
                                            
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
    </div>


        <!-- account end -->
        <!-- information start -->
        <div class="col-md-6 col-12 ">
            <div class="card" style="height: 510.227px;">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">{{__('dash.last_playing_game')}}</h4>
                    </div>
                   @forelse ($children->histories as $c)
                        <ul class="list-group list-group-flush">
                            <a href="{{route('games.show',$c->id)}}">
                                <li class="list-group-item">
                                    <span class="badge badge-pill bg-primary float-right">{{$c->created_at->diffForHumans()}}</span>
                                    {{$c->game->name}}
                                </li>
                            </a>
                        </ul>
                    @empty
                        <p class='text-center'>{{__('dash.no_results')}} </p>
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
       
        
    </div>

   
</section>
@endsection

@section('scripts')
<script>
    function performUpdate(){
        let full_name = document.getElementById('full_name').value;
        let country = document.getElementById('country').value;
        let email = document.getElementById('email').value;
        let image_avater = document.getElementById('image_avater').files[0];


        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('full_name',full_name);
        formData.append('country',country);
        formData.append('email',email);
        formData.append('image_avater',image_avater);


            
        performUpdateWithTostar('/childrenss/{{$children->id}}',formData);

    }


        var lineChart = echarts.init(document.getElementById('line-chart'));
         axios.get('/childrens/{{$children->id}}/anlytics').then(function(response){
            data =  response.data.data;

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


            }).catch(function(error){
        });
</script>
@endsection