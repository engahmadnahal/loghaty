@extends('layout.master')

@section('title',__('dash.index_game'))
@section('title_page',__('dash.index_game'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            @can('Create-game')
                            <a id="addRow" href="{{route('games.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            @endcan
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.level')}}</th>
                                        <th>{{__('dash.plan')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($games as $game)
                                        <tr>
                                            <td>{{$game->name}}</td>
                                            <td>{{$game->level->name}}</td>
                                            <td>{{$game->plan->name}}</td>
                                            <td>{{$game->created_at->format('Y-m-d')}}</td>
                                            <td><span class="{{$game->active ? 'text-success' : 'text-danger'}}">{{$game->state}}</span></td>
                                            <td class="action-table">
                                                @can('Read-game')
                                                <a href="{{route('games.show',$game->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Update-game')
                                                <a href="{{route('games.edit',$game->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @endcan
                                                @can('block_system')
                                                @if($game->active)
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$game->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$game->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                @endcan
                                                @can('Delete-game')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$game->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/games/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/games/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection