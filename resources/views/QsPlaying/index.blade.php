@extends('layout.master')

@section('title',__('dash.index_qs'))
@section('title_page',__('dash.index_qs'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('qs_playings.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.title')}}</th>
                                        <th>{{__('dash.games')}}</th>
                                        <th>{{__('dash.points')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($qs as $q)
                                        <tr>
                                            <td>{{$q->title}}</td>
                                            <td>{{$q->game->name}}</td>
                                            <td>{{$q->points}}</td>
                                            <td>{{$q->created_at->format('Y-m-d')}}</td>
                                            <td class="action-table">
                                                {{-- <a href="{{route('qs_playings.show',$q->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a> --}}
                                                <a href="{{route('qs_playings.edit',$q->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$q->id}})"><i class="fa fa-trash"></i></button>
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

    function performDelete(el,id){
        performDeleteWithTostar('/qs_playings/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection