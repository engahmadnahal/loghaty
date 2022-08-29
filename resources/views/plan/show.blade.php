
@extends('layout.master')

@section('title',__('dash.plan_setting'))
@section('title_page',__('dash.plan_setting'))
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
                                    <td class="font-weight-bold">{{__('dash.name')}}</td>
                                    <td>{{$plan->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.price_usd')}}</td>
                                    <td>{{$plan->price_usd}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.price_aed')}}</td>
                                    <td>{{$plan->price_aed}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.state')}}</td>
                                    <td>{{$plan->state}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.total_num')}}</td>
                                    <td>{{$plan->totale_child_subscrip}}</td>
                                </tr>
               
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <a href="{{route('plans.edit',$plan->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- account end -->
        <!-- information start -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.subscripers')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.semester')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($childrens as $c)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$c->name}}</td>
                                            <td>{{$c->semester->name}}</td>
                                            <td>{{$c->created_at->diffForHumans()}}</td>
                                          
                                            
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            
          
        </div>

        <div class="col-md-6 col-12 ">
            <div class="card" style="">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="card-title">{{__('dash.latest_subscripers')}}</h4>
                     
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($latestChild->take(10) as $c)
                        <a href="{{route('childrens.show',$c->id)}}">
                            <li class="list-group-item">
                                <span class="badge badge-pill bg-primary float-right">{{$c->created_at->diffForHumans()}} </span>
                                {{$c->name}}
                            </li>
                        </a>
                        @endforeach
                       
                       
                    </ul>
                </div>
            </div>
          
        </div>
        <!-- information start -->
       
       
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


            
        performUpdateWithTostar('/plans/{{$plan->id}}',formData);

    }

    
   
</script>
@endsection