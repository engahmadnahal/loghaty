
@extends('layout.master')

@section('title',__('dash.teacher_setting'))
@section('title_page',__('dash.teacher_setting'))
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
                            <img src="{{$teacher->image_profile}}" class="users-avatar-shadow w-100 h-100 rounded mb-2 pr-2 ml-1" alt="avatar">
                        </div>
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.name')}}</td>
                                    <td>{{$teacher->full_name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.email')}}</td>
                                    <td>{{$teacher->email}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.national_id')}}</td>
                                    <td>{{$teacher->national_id}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.status')}}</td>
                                    <td>{{$teacher->status_user}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.mobile')}}</td>
                                    <td>{{$teacher->mobile}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.country')}}</td>
                                    <td>{{$teacher->country->name}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <a href="{{route('teachers.edit',$teacher->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
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
                    <div class="card-title mb-2">{{__('dash.classes')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($classes as $c)
                        <div class="row pb-1">
                            <div class="col-1"><i class="fa-solid fa-person-chalkboard" style=" font-size: 21px; "></i></div>
                            <div class="col-6">{{$c->name}}</div>
                            <div class="col-5">
                                <span>{{$c->created_at->diffForHumans()}}</span>
                            </div>
                    </div>
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
                    <div class="card-title mb-2">{{__('dash.last_add_children')}}</div>
                </div>
                <div class="card-body">

                   @forelse ($childrens as $c)
                        <div class="row pb-1">
                            <div class="col-1"><i class="fa-solid fa-children" style=" font-size: 21px; "></i></div>
                            <div class="col-6">{{$c->name}}</div>
                            <div class="col-5">
                                <span>{{$c->created_at->diffForHumans()}}</span>
                            </div>
                    </div>
                    @empty
                        <p class='text-center'>{{__('dash.no_results')}} </p>
                    @endforelse
                </div>
            </div>
        </div>
        <!-- social links end -->
        <!-- permissions start -->
      
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


            
        performUpdateWithTostar('/teachers/{{$teacher->id}}',formData);

    }
</script>
@endsection