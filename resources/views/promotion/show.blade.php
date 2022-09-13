
@extends('layout.master')

@section('title',__('dash.show_promotion'))
@section('title_page',__('dash.show_promotion'))
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
                    
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.name')}}</td>
                                    <td>{{$promotionRequest->full_name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.mobile')}}</td>
                                    <td>{{$promotionRequest->mobile}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.plan')}}</td>
                                    <td>{{$promotionRequest->planTeacher->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.national_id')}}</td>
                                    <td>{{$promotionRequest->national_id}}</td>
                                </tr>
                               
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mr-1 waves-effect waves-light" onclick="performStorefatherToTeacher({{$promotionRequest->id}})"><i class="feather icon-edit-1"></i> {{__('dash.promotion')}}</button>
                        </div>
                    </div>
                </div>
            </div>
            <hr>

            <div class="card">
                <div class="card-header">
                    <h2>{{__('dash.details')}}</h2>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table class='promotionTable'>
                                <tbody>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.country')}}</td>
                                    <td>{{$promotionRequest->father->country->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.add_date2')}}</td>
                                    <td>{{$promotionRequest->created_at->format('Y-m-d')}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.plan')}}</td>
                                    <td>{{$promotionRequest->planTeacher->name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.mobile')}}</td>
                                    <td>{{$promotionRequest->mobile}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.national_id')}}</td>
                                    <td>{{$promotionRequest->national_id}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.amount_paid')}}</td>
                                    <td>{{$promotionRequest->father->country->name_en == 'UAE' ? $promotionRequest->planTeacher->price_aed . ' AED' : $promotionRequest->planTeacher->price_usd . ' USD'}}</td>
                                    
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.notes')}}</td>
                                    <td>{{$promotionRequest->notes}}</td>
                                </tr>
                                
                                
                            </tbody></table>
                        </div>
                        
                    </div>
                </div>
            </div>

        </div>

        {{-- <div class="col-xl-12 ">
            <div class="card">
                   
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <h4 class="card-title">{{__('dash.history_user')}}</h4>
                           
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.levels')}}</th>
                                        <th>{{__('dash.games')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($children->histories as $h)
                                        <tr>
                                           
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$h->level->name}}</td>
                                            <td>{{$h->game->name}}</td>
                                            <td>{{$h->created_at->diffForHumans()}}</td>
                                          
                                            
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> --}}
    </div>


        
    </div>

   
</section>
@endsection

@section('scripts')
<script>
  
function performStorefatherToTeacher(idPromotion){

    let objData = {
        promotion_id : idPromotion,
    }

    performStoreWithTostar('/promotion_requests',objData);
}

       
</script>
@endsection