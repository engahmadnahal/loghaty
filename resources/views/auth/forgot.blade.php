@extends('layout.master2')

@section('title','Forgot Password')

@section('body')
<section class="row flexbox-container">
	<div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0">
		<div class="card bg-authentication rounded-0 mb-0">
			<div class="row m-0">
				<div class="col-lg-6 d-lg-block d-none text-center align-self-center">
					<img src="{{asset('app-assets/images/pages/forgot-password.png')}}" alt="branding logo">
				</div>
				<div class="col-lg-6 col-12 p-0">
					<div class="card rounded-0 mb-0 px-2 py-1">
						<div class="card-header pb-1">
							<div class="card-title">
								<h4 class="mb-0">{{__('dash.send_email_forgot')}}</h4>
							</div>
						</div>
						<p class="px-2 mb-0">{{__('dash.send_email_forgot_body')}}</p>
						<div class="card-content">
							<div class="card-body">
								<form >
									<div class="form-label-group">
										<input type="email" id="email" class="form-control" placeholder="{{__('dash.email')}}">
										<label for="email">{{__('dash.email')}}</label>
									</div>
								</form>
							
								<div class="float-md-right d-block mb-1">
									<button type="button" class="btn btn-primary btn-block px-75 waves-effect waves-light" onclick="performForgotPassword()">{{__('dash.send_email')}}</a>
								</div>
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
  function performForgotPassword(){
        axios.post('/reset',{
            email:document.getElementById('email').value
        }).then(function(response){
			toastr.success(response.data.message,response.data.title, { "progressBar": true });
        }).catch(function(error){
            toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });

        });
    }
</script>
@endsection
