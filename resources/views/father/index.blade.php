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
                            @can('Create-father')
                            <a id="addRow" href="{{route('fathers.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.email')}}</th>
                                        <th>{{__('dash.name_plan')}}</th>
                                        <th>{{__('dash.num_children')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        {{-- <th>{{__('dash.status_email')}}</th> --}}
                                        <th>{{__('dash.status')}}</th>
                                        <th>{{__('dash.last_vist')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($fathers as $father)
                                   
                                        <tr>
                                            <td>{{$father->email}}</td>
                                            <td>{{$father->plan->name}}</td>
                                            <td>{{$father->childrens->count()}}</td>
                                            <td>{{$father->created_at->format('Y-m-d')}}</td>
                                            {{-- <td> <span class="{{!is_null($father->email_verified_at) ? 'text-success' : 'text-danger'}}">{{$father->email_status}}</span></td> --}}
                                            <td><span class="{{$father->status == 'active' ? 'text-success' : 'text-danger'}}">{{$father->status_user}}</span></td>
                                            <td>{{$father->last_login}}</td>
                                            <td class="action-table">
                                                @can('Read-father')
                                                <a href="{{route('fathers.show',$father->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-father')
                                                <a href="{{route('fathers.edit',$father->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @if($father->status =='active')
                                                @can('block_system')
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$father->id}})"><i class="fa fa-lock"></i></button>
                                                    @endcan
                                                    @else
                                                @can('block_system')
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$father->id}})"><i class="fa fa-unlock"></i></button>
                                                    @endcan
                                                    @endif
                                                @can('Delete-father')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$father->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/fathers/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/fathers/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection