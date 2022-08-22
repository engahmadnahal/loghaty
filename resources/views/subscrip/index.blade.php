@extends('layout.master')

@section('title',__('dash.index_subs'))
@section('title_page',__('dash.index_subs'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('subscriptions.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.childrens')}}</th>
                                        <th>{{__('dash.start_subscrip_date')}}</th>
                                        <th>{{__('dash.end_subscrip_date')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($subscriptions as $subs)
                                        <tr>
                                            <td>{{$subs->children->name}}</td>
                                            <td>{{$subs->start}}</td>
                                            <td>{{$subs->end}}</td>
                                            <td>{{$subs->state_subs}}</td>
                                            <td>{{$subs->created_at->format('Y-m-d')}}</td>
                                            <td class="action-table">
                                                <a href="{{route('fathers.show',$subs->father->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('subscriptions.create')}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$subs->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/subscriptions/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/subscriptions/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection