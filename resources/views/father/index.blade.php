@extends('layout.master')

@section('title',__('dash.index_father'))
@section('title_page',__('dash.index_father'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('fathers.create')}}" class="col-2 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.email')}}</th>
                                        <th>{{__('dash.num_children')}}</th>
                                        <th>{{__('dash.subscrip_plan')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.status_email')}}</th>
                                        <th>{{__('dash.status')}}</th>
                                        <th>{{__('dash.last_vist')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fathers as $father)
                                        <tr>
                                            <td>{{$father->email}}</td>
                                            <td>{{$father->childrens->count()}}</td>
                                            <td>{{$father->subscriptions->plan->name}}</td>
                                            <td>{{$father->created_at->format('Y-m-d')}}</td>
                                            <td> <span class="{{!is_null($father->email_verified_at) ? 'text-success' : 'text-danger'}}">{{$father->email_status}}</span></td>
                                            <td><span class="{{$father->status == 'active' ? 'text-success' : 'text-danger'}}">{{$father->status_user}}</span></td>
                                            <td>{{$father->last_login}}</td>
                                            <td class="action-table">
                                                <a href="{{route('fathers.show',$father->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('fathers.edit',$father->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @if($father->status =='active')
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$father->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$father->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$father->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/fathers/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/fathers/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection