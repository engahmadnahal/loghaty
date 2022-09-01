@extends('layout.master')

@section('title',__('dash.index_plan'))
@section('title_page',__('dash.index_plan'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-plan')
                            <a id="addRow" href="{{route('plans.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.total_month')}}</th>
                                        <th>{{__('dash.price_usd')}}</th>
                                        <th>{{__('dash.price_aed')}}</th>
                                        <th>{{__('dash.total_num')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plans as $plan)
                                        <tr>
                                            <td>{{$plan->name}}</td>
                                            <td>{{$plan->sum_month}}</td>
                                            <td>{{$plan->price_usd}}</td>
                                            <td>{{$plan->price_aed}}</td>
                                            <td>{{$plan->totale_child_subscrip}}</td>
                                            <td><span class="{{boolval($plan->active) ? 'text-success' : 'text-danger'}}">{{$plan->state}}</span></td>
                                            <td>{{$plan->created_at->format('Y-m-d')}}</td>
                                            <td class="action-table">
                                                @can('Read-plan')
                                                <a href="{{route('plans.show',$plan->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-plan')
                                                <a href="{{route('plans.edit',$plan->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @can('block_system')
                                                @if($plan->active)
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$plan->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$plan->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                @endcan
                                                @can('Delete-plan')
                                                @if($plan->id != 1)
                                                    <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$plan->id}})"><i class="fa fa-trash"></i></button>
                                                @endif
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach
                                    
                                    
                                </tbody>
                            </table>
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
    function performChangeStatus(id){
        performStoreWithTostar('/plans/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/plans/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection