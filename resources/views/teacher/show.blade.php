
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


            
        performUpdateWithTostar('/teachers/{{$teacher->id}}',formData);

    }
</script>
@endsection