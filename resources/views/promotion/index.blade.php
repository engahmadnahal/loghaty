@extends('layout.master')

@section('title',__('dash.index_promotion'))
@section('title_page',__('dash.index_promotion'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>{{__('dash.name')}}</th>
                                        <th>{{__('dash.mobile')}}</th>
                                        <th>{{__('dash.status')}}</th>
                                        <th>{{__('dash.add_date2')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($promotions as $pr)
                                        <tr>
                                            <td>{{++$loop->index}}</td>
                                            <td>{{$pr->full_name}}</td>
                                            <td>{{$pr->mobile}}</td>
                                            <td>{{$pr->created_at->format('Y-m-d')}}</td>
                                            <td><span class="
                                                @if ($pr->status == 'accept')
                                                    'text-success'
                                                @elseif ($pr->status == 'wating')
                                                    'text-warning'
                                                @else
                                                    'text-danger'
                                                @endif
                                                ">{{$pr->state}}</span></td>
                                            <td class="action-table">
                                                @can('Read-promotion')
                                                <a href="{{route('promotion_requests.show',$pr->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                @endcan
                                                @can('Delete-promotion')
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$pr->id}})"><i class="fa fa-trash"></i></button>
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

    function performDelete(el,id){
        performDeleteWithTostar('/promotion_requests/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection