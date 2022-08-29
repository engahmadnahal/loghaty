@extends('layout.master')

@section('title',__('dash.index_admin'))
@section('title_page',__('dash.index_admin'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-admin')
                            <a id="addRow" href="{{route('admins.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.avater')}}</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.country')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.status_email')}}</th>
                                        <th>{{__('dash.status')}}</th>
                                        <th>{{__('dash.last_vist')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($admins as $admin)
                                        <tr>
                                            <td><div class="avatar mr-1 avatar-lg">
                                                <img src="{{$admin->image_profile}}" alt="avtar img holder">
                                            </div></td>
                                            <td>{{$admin->name}}</td>
                                            <td>{{$admin->country->name}}</td>
                                            <td>{{$admin->created_at->format('Y-m-d')}}</td>
                                            <td> <span class="{{!is_null($admin->email_verified_at) ? 'text-success' : 'text-danger'}}">{{$admin->email_status}}</span></td>
                                            <td><span class="{{$admin->status == 'active' ? 'text-success' : 'text-danger'}}">{{$admin->status_user}}</span></td>
                                            <td>{{$admin->last_login}}</td>
                                            <td class="action-table">
                                                @can('giv_admin_permission')
                                                <a href="{{route('admins.permissions',$admin->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-gears"></i></a>
                                                @endcan

                                                {{-- @can('Read-admin')
                                                <a href="{{route('admins.show',$admin->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan --}}
                                                
                                                @can('block_system')
                                                    @if($admin->status =='active')
                                                    {{-- Show block btn where status user active --}}
                                                            <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$admin->id}})"><i class="fa fa-lock"></i></button>
                                                    @else
                                                    {{-- Show active btn where status user block --}}
                                                            <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$admin->id}})"><i class="fa fa-unlock"></i></button>
                                                    @endif
                                                @endcan

                                                @can('Delete-admin')
                                                    <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$admin->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/admins/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/admins/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection