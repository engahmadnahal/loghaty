@extends('layout.master2')

@section('title','Login')

@section('body')
<section class="row flexbox-container">
    <div class="col-xl-8 col-11 d-flex justify-content-center">
        <div class="card bg-authentication rounded-0 mb-0">
            <div class="row m-0">
                <div class="col-lg-6 d-lg-block d-none text-center align-self-center px-1 py-0" style="width: 400px; height: 230px;">
                    <img src="{{asset('app-assets/images/pages/login.png')}}" alt="branding logo">
                </div>
                <div class="col-lg-6 col-12 p-0">
                    <div class="card rounded-0 mb-0 px-2">
                        <div class="card-header pb-1">
                            <div class="card-title">
                                <h4 class="mb-0">{{__('dash.login_title')}}</h4>
                            </div>
                        </div>
                        <p class="px-2">{{__('dash.login_text')}}.</p>
                        <div class="card-content">
                            <div class="card-body pt-1">
                                <form action="index.html">
                                    <fieldset class="form-label-group form-group position-relative has-icon-left">
                                        <input type="email" class="form-control" id="email" placeholder="{{__('dash.email')}}" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-user"></i>
                                        </div>
                                        <label for="user-name">{{__('dash.email')}}</label>
                                    </fieldset>

                                    <fieldset class="form-label-group position-relative has-icon-left">
                                        <input type="password" class="form-control" id="password" placeholder="{{__('dash.password')}}" required>
                                        <div class="form-control-position">
                                            <i class="feather icon-lock"></i>
                                        </div>
                                        <label for="user-password">{{__('dash.password')}}</label>
                                    </fieldset>
                                    <div class="form-group d-flex justify-content-between align-items-center">
                                        <div class="text-left">
                                            <fieldset class="checkbox">
                                                <div class="vs-checkbox-con vs-checkbox-primary">
                                                    <input type="checkbox" id="remember">
                                                    <span class="vs-checkbox">
                                                        <span class="vs-checkbox--check">
                                                            <i class="vs-icon feather icon-check"></i>
                                                        </span>
                                                    </span>
                                                    <span class="">{{__('dash.remember_me')}}</span>
                                                </div>
                                            </fieldset>
                                        </div>
                                        <div class="text-right"><a href="{{route('auth.forgot')}}" class="card-link">{{__('dash.forgot_password')}}</a></div>
                                    </div>
                                    <button type="button" class="btn btn-primary float-right btn-inline" onclick="preformLogin()">{{__('dash.login')}}</button>
                                </form>
                            </div>
                        </div>
                        <div class="login-footer">
                            <div class="divider">
                                <div class="divider-text">OR</div>
                            </div>
                            <div class="footer-btn d-inline">
                                <p class="text-center">{{__('dash.welcome_back')}}</p>
                            </div>
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
    function preformLogin(){
        let email = document.getElementById('email').value;
        let password = document.getElementById('password').value;
        let remember = document.getElementById('remember').checked; 

        axios.post('/login',{
            email : email,
            password : password,
            remember : remember
        }).then(function(response){
            window.location.href = "{{route('home.index')}}";
        }).catch(function(error){
            toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
        });
    }

</script>
@endsection
