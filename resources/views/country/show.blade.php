
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
        <div class="col-md-4 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.childrens')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($country->childrens as $c)
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-children" style=" font-size: 21px; "></i></div>
                        <div class="col-6">{{$c->name}}</div>
                        <div class="col-5">
                            <div class="action-table">
                                <p>{{$c->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                   </div>
                    @empty
                        <p>{{__('dash.no_results')}}</p>
                    @endforelse
                   
                </div>
            </div>
        </div>
        <!-- social links end -->
       
        <div class="col-md-4 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.teachers')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($country->teachers as $t)
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-person-chalkboard" style=" font-size: 21px; "></i></div>
                        <div class="col-6">{{$t->full_name}}</div>
                        <div class="col-5">
                            <div class="action-table">
                                <p>{{$t->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                   </div>
                    @empty
                        <p>{{__('dash.no_results')}}</p>
                    @endforelse
                   
                </div>
            </div>
        </div>

        <div class="col-md-4 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.admins')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($country->admins as $a)
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-user" style=" font-size: 21px; "></i></div>
                        <div class="col-6">{{$a->name}}</div>
                        <div class="col-5">
                            <div class="action-table">
                                <p>{{$a->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                   </div>
                    @empty
                        <p>{{__('dash.no_results')}}</p>
                    @endforelse
                   
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