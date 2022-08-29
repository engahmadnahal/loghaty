
@extends('layout.master')

@section('title',__('dash.country_setting'))
@section('title_page',__('dash.country_setting'))
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
                                    <td>{{$country->name_ar}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.name_en')}}</td>
                                    <td>{{$country->name_en}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.state')}}</td>
                                    <td>{{$country->state}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                       
                        <div class="col-12">
                            <a href="{{route('countries.edit',$country->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- social links end -->
        <div class="col-md-12 col-12 ">
            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.childrens')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country->childrens  as $c)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$c->name}}</td>
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
        <!-- social links end -->
       
        <div class="col-md-12 col-12 ">
            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.teachers')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country->teachers  as $c)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$c->full_name}}</td>
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

        <div class="col-md-12 col-12 ">

            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.admins')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($country->admins  as $c)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$c->name}}</td>
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
    </div>
</section>
@endsection

@section('scripts')
<script>

</script>
@endsection