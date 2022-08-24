@extends('layout.master')

@section('title',__('dash.index_classes'))
@section('title_page',__('dash.index_classes'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-class')
                            <a id="addRow" href="{{route('classes.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.teacher_name')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($classes as $class)
                                        <tr>
                                            
                                            <td>{{$class->name}}</td>
                                            <td>{{$class->teacher->full_name}}</td>
                                            <td>{{$class->created_at->format('Y-m-d')}}</td>
                                            <td><span class="{{$class->status == 'active' ? 'text-success' : 'text-danger'}}">{{$class->status_class}}</span></td>
                                            <td class="action-table">
                                                @can('Read-class')
                                                <a href="{{route('classes.show',$class->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-class')
                                                <a href="{{route('classes.edit',$class->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @if($class->status =='active')
                                                @can('block_system')
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$class->id}})"><i class="fa fa-lock"></i></button>
                                                    @endcan
                                                    @else
                                                {{-- Show active btn where status user block --}}
                                                @can('block_system')
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$class->id}})"><i class="fa fa-unlock"></i></button>
                                               @endcan
                                                    @endif
                                                    @can('Delete-class')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$class->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/classes/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/classes/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection