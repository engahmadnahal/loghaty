@extends('layout.master')

@section('title',__('dash.index_notification'))
@section('title_page',__('dash.index_notification'))

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
                                        <th>{{__('dash.title')}}</th>
                                        <th>{{__('dash.body')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.state')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (auth()->user()->unreadNotifications as $ntf)
                                        <tr>
                                            
                                            <td>{{$ntf->data['title']}}</td>
                                            <td>{{$ntf->data['body']}}</td>
                                            <td>{{$ntf->created_at->format('Y-m-d')}}</td>
                                            <td> <span class="badge badge-pill badge-primary ">{{is_null($ntf->read_at) ? ' ' : ''}}</span></td>
                                            
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
    axios.post('/admins/notification/read',{}).then(function(response){}).catch(function(response){});
</script>
@endsection