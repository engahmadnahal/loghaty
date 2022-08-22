
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
                                    <td class="font-weight-bold">{{__('dash.os_mobile')}}</td>
                                    <td>{{$children->os_mobile}}</td>
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
                                    <td>{{$children->classe->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.country')}}</td>
                                    <td>{{$children->country->name}}</td>
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
        <!-- account end -->
        <!-- information start -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.history_user')}}</div>
                </div>
                <div class="card-body">
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-person-chalkboard" style=" font-size: 21px; "></i></div>
                        <div class="col-6">الصف الثالث</div>
                        <div class="col-5">
                            <div class="action-table">
                                <span>منذ ساعتين</span>
                            </div>
                        </div>
                   </div>
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
        <!-- permissions start -->
        <div class="col-12">
            <div class="card">
                <div class="card-header border-bottom mx-2 px-0">
                    <h6 class="border-bottom py-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>{{__('dash.permission')}}
                    </h6>
                </div>
                <div class="card-body px-75">
                    <div class="table-responsive users-view-permission">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                    <th>Module</th>
                                    <th>Read</th>
                                    <th>Write</th>
                                    <th>Create</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Users</td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox1" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox1"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox2" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox2"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox3" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox3"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox4" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox4"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Articles</td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox5" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox5"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox6" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox6"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox7" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox7"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox8" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox8"></label>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Staff</td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox9" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox9"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox10" class="custom-control-input" disabled="" checked="">
                                            <label class="custom-control-label" for="users-checkbox10"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox11" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox11"></label>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="custom-control custom-checkbox ml-50"><input type="checkbox" id="users-checkbox12" class="custom-control-input" disabled=""><label class="custom-control-label" for="users-checkbox12"></label>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- permissions end -->
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