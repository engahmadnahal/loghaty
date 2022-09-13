@extends('layout.master')

@section('title',__('dash.edit_teacher'))
@section('title_page',__('dash.edit_teacher'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="fname" class="form-control" placeholder="{{__('dash.fname')}}"  value="{{$teacher->fname}}">
                                            <label for="first-name-column">{{__('dash.fname')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="lname" class="form-control" placeholder="{{__('dash.lname')}}"  value="{{$teacher->lname}}">
                                            <label for="first-name-column">{{__('dash.lname')}}</label>
                                        </div>
                                    </div>


                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="email" id="email" class="form-control" placeholder="{{__('dash.email')}}" value="{{$teacher->email}}">
                                            <label for="email">{{__('dash.email')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="national_id" class="form-control" placeholder="{{__('dash.national_id')}}"  value="{{$teacher->national_id}}">
                                            <label for="first-name-column">{{__('dash.national_id')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="mobile" class="form-control" placeholder="{{__('dash.mobile')}}"  value="{{$teacher->mobile}}">
                                            <label for="first-name-column">{{__('dash.mobile')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.countries')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="country">
                                                @foreach ($countres as $c)
                                                    <option value="{{$c->id}}"
                                                        @selected($c->id == $teacher->country->id)
                                                        >{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="file" id="image_avater" class="form-control" placeholder="{{__('dash.upload_image')}}" required>
                                            <label for="image_avater">{{__('dash.upload_image')}}</label>
                                            <p class="text-muted ml-75 mt-50"><small>JPG,JPGE, GIF or PNG. </small></p>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.countries')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="plan_id">
                                                @foreach ($plans as $plan)
                                                    <option value="{{$plan->id}}">{{$plan->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" @checked($teacher->status == 'active')>
                                                <label class="custom-control-label" for="active"></label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" onclick="performUpdate()">{{__('dash.save')}}</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">{{__('dash.reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
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
        let fname = document.getElementById('fname').value;
        let lname = document.getElementById('lname').value;
        let country = document.getElementById('country').value;
        let email = document.getElementById('email').value;
        let national_id = document.getElementById('national_id').value;
        let mobile = document.getElementById('mobile').value;
        let image_avater = document.getElementById('image_avater').files[0];
        let active = document.getElementById('active').checked;
        let plan_id = document.getElementById('plan_id').value;

        let formData = new FormData();
        formData.append('fname',fname);
        formData.append('lname',lname);
        formData.append('country',country);
        formData.append('email',email);
        formData.append('national_id',national_id);
        formData.append('mobile',mobile);
        formData.append('image_avater',image_avater);
        formData.append('active',active);
        formData.append('plan_id',plan_id);
        formData.append('_method','PUT');

  
        performUpdateWithTostar('/teachers/{{$teacher->id}}',formData);
    }
</script>
@endsection