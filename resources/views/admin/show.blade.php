
@extends('layout.master')

@section('title',__('dash.account_setting'))
@section('title_page',__('dash.account_setting'))
@section('content')
<section id="page-account-settings">
    <div class="row">
        <!-- left menu section -->
        <div class="col-md-3 mb-2 mb-md-0">
            <ul class="nav nav-pills flex-column mt-md-0 mt-1">
                <li class="nav-item">
                    <a class="nav-link d-flex py-75 active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                        <i class="feather icon-globe mr-50 font-medium-3"></i>
                        {{__('dash.general')}}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link d-flex py-75" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                        <i class="feather icon-lock mr-50 font-medium-3"></i>
                        {{__('dash.change_password')}}
                    </a>
                </li>
            </ul>
        </div>
        <!-- right content section -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                <div class="media">
                                    <a href="javascript: void(0);">
                                        <img src="{{$admin->image_profile}}" class="rounded mr-75" alt="profile image" height="64" width="64">
                                    </a>
                                    <div class="media-body mt-75">
                                        <div class="col-12 px-0 d-flex flex-sm-row flex-column justify-content-start">
                                            <label class="btn btn-sm btn-primary ml-50 mb-50 mb-sm-0 cursor-pointer waves-effect waves-light" for="image_avater">{{__('dash.upload_new_image')}}</label>
                                            <input type="file" id="image_avater" hidden="">
                                            <button class="btn btn-sm btn-outline-warning ml-50 waves-effect waves-light">{{__('dash.reset')}}</button>
                                        </div>
                                        <p class="text-muted ml-75 mt-50"><small> JPG,JPEG, GIF or PNG</small></p>
                                    </div>
                                </div>
                                <hr>
                                <form class='form' >
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="full_name" class="form-control" placeholder="{{__('dash.full_name')}}"  value="{{$admin->name}}" >
                                                <label for="full_name">{{__('dash.full_name')}}</label>
                                            </div>
                                        </div>
    
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <label for="city-column">{{__('dash.countries')}}</label>
    
                                                <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="country">
                                                    @foreach ($countres as $c)
                                                        <option value="{{$c->id}}"
                                                            @selected($admin->country->id == $c->id)
                                                            >{{$c->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-label-group">
                                                <input type="email" id="email" class="form-control" placeholder="{{__('dash.email')}}" value="{{$admin->email}}"  >
                                                <label for="email">{{__('dash.email')}}</label>
                                            </div>
                                        </div>
                                       
    
                                        
                                      
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="button"   class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light" onclick="performUpdate()">{{__('dash.save')}}
                                                </button>
                                            <button type="reset" class="btn btn-outline-warning waves-effect waves-light">{{__('dash.reset')}}</button>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            {{-- This is New Tab Change Password --}}
                            <div class="tab-pane fade" id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                <form novalidate="" id='change'>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-old-password">{{__('dash.old_password')}}</label>
                                                    <input type="password" class="form-control" id="old_password" required="" placeholder="{{__('dash.old_password')}}" >
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-new-password">{{__('dash.new_password')}}</label>
                                                    <input type="password" id="new_password" class="form-control" placeholder="{{__('dash.confr_password')}}" required=""  minlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="controls">
                                                    <label for="account-retype-new-password">{{__('dash.confr_password')}}</label>
                                                    <input type="password" class="form-control" required="" id="confr_password"  placeholder="{{__('dash.new_password')}}"  minlength="6">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                            <button type="button" class="btn btn-primary mr-sm-1 mb-1 mb-sm-0 waves-effect waves-light" onclick="performResetPassword()">{{__('dash.save')}}
                                                </button>
                                            <button type="reset" class="btn btn-outline-warning waves-effect waves-light">{{__('dash.reset')}}</button>
                                        </div>
                                    </div>
                                </form>

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


            
        performUpdateWithTostar('/admins/{{$admin->id}}',formData);

    }

    function performResetPassword(){
        let dataObj = {
            old_password:document.getElementById('old_password').value,
            new_password:document.getElementById('new_password').value,
            new_password_confirmation:document.getElementById('confr_password').value,
        };
        performStoreWithTostar('/change-password',dataObj,'change');
    }
</script>
@endsection