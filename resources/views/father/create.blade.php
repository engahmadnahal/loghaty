@extends('layout.master')

@section('title',__('dash.create_father'))
@section('title_page',__('dash.new_father'))

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



                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="email" id="email" class="form-control" placeholder="{{__('dash.email')}}"required>
                                            <label for="email">{{__('dash.email')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="password" id="password" class="form-control" placeholder="{{__('dash.password')}}" required>
                                            <label for="password">{{__('dash.password')}}</label>
                                        </div>
                                    </div>


                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" checked>
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
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let active = document.getElementById('active').checked;

        let formData = new FormData();
        formData.append('email',email);
        formData.append('password',password);
        formData.append('active',active);

        performStoreWithTostar('/fathers',formData,'form');
    }
</script>
@endsection