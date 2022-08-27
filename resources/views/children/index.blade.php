@extends('layout.master')

@section('title',__('dash.index_children'))
@section('title_page',__('dash.index_children'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-children')
                            <a id="addRow" href="{{route('childrens.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.avater')}}</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.country')}}</th>
                                        <th>{{__('dash.class')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.status')}}</th>
                                        <th>{{__('dash.last_vist')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($childrens as $children)
                                        <tr>
                                            <td><div class="avatar mr-1 avatar-lg">
                                                <img src="{{$children->image_profile}}" alt="avtar img holder">
                                            </div></td>
                                            <td>{{$children->name}}</td>
                                            <td>{{$children->country->name}}</td>
                                            <td>{{$children->semester->name}}</td>
                                            <td>{{$children->created_at->format('Y-m-d')}}</td>
                                            <td><span class="{{$children->status == 'active' ? 'text-success' : 'text-danger'}}">{{$children->status_user}}</span></td>
                                            <td>{{$children->last_login}}</td>
                                            <td class="action-table">
                                                @can('Read-children')
                                                <a href="{{route('childrens.show',$children->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-children')
                                                <a href="{{route('childrens.edit',$children->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @if($children->status =='active')
                                                {{-- Show block btn where status user active --}}
                                                    @can('block_system')
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$children->id}})"><i class="fa fa-lock"></i></button>
                                                    @endcan
                                                @else
                                                    {{-- Show active btn where status user block --}}
                                                    @can('block_system')
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$children->id}})"><i class="fa fa-unlock"></i></button>
                                                    @endcan
                                                @endif
                                                @can('Delete-children')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$children->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/childrens/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/childrens/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection