@extends('layout.master')

@section('title',__('dash.create_admin'))
@section('title_page',__('dash.new_admin'))

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
                                            <input type="text" id="full_name" class="form-control" placeholder="{{__('dash.full_name')}}"  required>
                                            <label for="first-name-column">{{__('dash.full_name')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.countries')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="country">
                                                @foreach ($countres as $c)
                                                    <option value="{{$c->id}}">{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="email" id="email" class="form-control" placeholder="{{__('dash.email')}}"required>
                                            <label for="email">{{__('dash.email')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="password" id="password" class="form-control" placeholder="{{__('dash.password')}}" required>
                                            <label for="password">{{__('dash.password')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="file" id="image_avater" class="form-control" placeholder="{{__('dash.upload_image')}}" required>
                                            <label for="image_avater">{{__('dash.upload_image')}}</label>
                                            <p class="text-muted ml-75 mt-50"><small>JPG,JPGE, GIF or PNG. </small></p>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" required>
                                                <label class="custom-control-label" for="active"></label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" onclick="performStore()">{{__('dash.save')}}</button>
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
    function performStore(){
        let full_name = document.getElementById('full_name').value;
        let country = document.getElementById('country').value;
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let image_avater = document.getElementById('image_avater').files[0];
        let active = document.getElementById('active').checked;

        let formData = new FormData();
        formData.append('full_name',full_name);
        formData.append('country',country);
        formData.append('email',email);
        formData.append('password',password);
        formData.append('image_avater',image_avater);
        formData.append('active',active);

  
        performStoreWithTostar('/admins',formData,'form');
    }
</script>
@endsection