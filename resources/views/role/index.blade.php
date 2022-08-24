@extends('layout.master')

@section('title',__('dash.index_level'))
@section('title_page',__('dash.index_level'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('levels.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.points')}}</th>
                                        <th>{{__('dash.orderd')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($levels as $level)
                                        <tr>
                                            <td>{{$level->name}}</td>
                                            <td>{{$level->points}}</td>
                                            <td>{{$level->orderd}}</td>
                                            <td>{{$level->created_at->format('Y-m-d')}}</td>
                                            <td><span class="{{$level->active ? 'text-success' : 'text-danger'}}">{{$level->state}}</span></td>
                                            <td class="action-table">
                                                <a href="{{route('levels.show',$level->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('levels.edit',$level->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @if($level->active)
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$level->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$level->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$level->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/levels/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/levels/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection