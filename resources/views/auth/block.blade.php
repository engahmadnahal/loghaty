@extends('layout.master2')

@section('body')
<section class="row flexbox-container">
	<div class="col-xl-7 col-md-9 col-10 d-flex justify-content-center px-0">
		<div class="card bg-authentication rounded-0 mb-0">
			<div class="row m-0">
				<div class="col-lg-6 d-lg-block d-none text-center align-self-center">
					<img src="{{asset('app-assets/images/pages/forgot-password.png')}}" alt="branding logo">
				</div>
				<div class="col-lg-6 col-12 p-0">
					<div class="card rounded-0 mb-0 px-2 py-1" style=" height: 100%; ">
						<div class="card-header pb-1">
							<div class="card-title">
								<h4 class="mb-0">{{__('dash.account_block_title')}}</h4>
							</div>
						</div>
						<p class="px-2 mb-0">{{__('dash.account_block_body')}}</p>
						
						
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection

