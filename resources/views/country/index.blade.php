@extends('layout.master')

@section('title',__('dash.index_country'))
@section('title_page',__('dash.index_country'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-country')
                            <a id="addRow" href="{{route('countries.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.name_ar')}}</th>
                                        <th>{{__('dash.name_en')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $c)
                                        <tr>
                                            
                                            <td>{{$c->name_ar}}</td>
                                            <td>{{$c->name_en}}</td>
                                            <td>{{$c->created_at->format('Y-m-d')}}</td>
                                            <td><span class="{{$c->active ? 'text-success' : 'text-danger'}}">{{$c->state}}</span></td>
                                            <td class="action-table">
                                                @can('Read-country')
                                                <a href="{{route('countries.show',$c->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-country')
                                                <a href="{{route('countries.edit',$c->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @can('block_system')
                                                @if($c->active)
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$c->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$c->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                @endcan
                                                @can('Delete-country')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$c->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/countries/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/countries/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection