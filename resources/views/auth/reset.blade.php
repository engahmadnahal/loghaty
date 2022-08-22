@extends('layout.master2')

@section('title','Reset Password')

@section('body')
<section class="row flexbox-container">
	<div class="col-xl-7 col-10 d-flex justify-content-center">
		<div class="card bg-authentication rounded-0 mb-0 w-100">
			<div class="row m-0">
				<div class="col-lg-6 d-lg-block d-none text-center align-self-center p-0">
					<img src="../../../app-assets/images/pages/reset-password.png" alt="branding logo">
				</div>
				<div class="col-lg-6 col-12 p-0">
					<div class="card rounded-0 mb-0 px-2">
						<div class="card-header pb-1">
							<div class="card-title">
								<h4 class="mb-0">{{__('dash.reset_password_title')}}</h4>
							</div>
						</div>
						<p class="px-2">{{__('dash.reset_password_body')}}.</p>
						<div class="card-content">
							<div class="card-body pt-1">
								<form>
								

									<fieldset class="form-label-group">
										<input type="password" class="form-control" id="password" placeholder="{{__('dash.password')}}" required="">
										<label for="password">{{__('dash.password')}}</label>
									</fieldset>

									<fieldset class="form-label-group">
										<input type="password" class="form-control" id="confirm_password" placeholder="{{__('dash.confr_password')}}" required="">
										<label for="confirm_password">{{__('dash.confr_password')}}</label>
									</fieldset>
									<div class="row pt-2">
									
										<div class="col-12 col-md-6 mb-1">
											<button type="button" class="btn btn-primary btn-block px-0 waves-effect waves-light" onclick="performResetPassword()">{{__('dash.reset_password')}}</button>
										</div>
									</div>
								</form>
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
function performResetPassword(){
        axios.post('/reset-password',{
            email:'{{$email}}',
            password:document.getElementById('password').value,
            password_confirmation:document.getElementById('confirm_password').value,
            token : '{{$token}}'
        }).then(function(response){
            window.location.href = "{{route('auth.login')}}";
            toastr.success(response.data.message,response.data.title, { "progressBar": true });
        }).catch(function(error){
            toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
        });
    }
</script>
@endsection
