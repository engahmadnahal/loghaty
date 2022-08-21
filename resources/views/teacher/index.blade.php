@extends('layout.master')

@section('title',__('dash.index_teacher'))
@section('title_page',__('dash.index_teacher'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('teachers.create')}}" class="col-2 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
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
                                    @foreach ($teachers as $teacher)
                                        <tr>
                                            <td><div class="avatar mr-1 avatar-lg">
                                                <img src="{{$teacher->image_profile}}" alt="avtar img holder">
                                            </div></td>
                                            <td>{{$teacher->full_name}}</td>
                                            <td>{{$teacher->country->name}}</td>
                                            <td>{{$teacher->created_at->format('Y-m-d')}}</td>
                                            <td> <span class="{{!is_null($teacher->email_verified_at) ? 'text-success' : 'text-danger'}}">{{$teacher->email_status}}</span></td>
                                            <td><span class="{{$teacher->status == 'active' ? 'text-success' : 'text-danger'}}">{{$teacher->status_user}}</span></td>
                                            <td>{{$teacher->last_login}}</td>
                                            <td class="action-table">
                                                <a href="{{route('teachers.show',$teacher->id)}}"  class="btn bg-gradient-info  waves-effect waves-light"><i class="fa fa-eye"></i></a>
                                                <a href="{{route('teachers.edit',$teacher->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                @if($teacher->status =='active')
                                                {{-- Show block btn where status user active --}}
                                                    <button type="button" class="btn bg-gradient-danger waves-effect waves-light" onclick="performChangeStatus({{$teacher->id}})"><i class="fa fa-lock"></i></button>
                                                @else
                                                {{-- Show active btn where status user block --}}
                                                    <button type="button" class="btn bg-gradient-success waves-effect waves-light" onclick="performChangeStatus({{$teacher->id}})"><i class="fa fa-unlock"></i></button>
                                                @endif
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$teacher->id}})"><i class="fa fa-trash"></i></button>
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
        performStoreWithTostar('/teachers/status/'+id);
    }

    function performDelete(el,id){
        performDeleteWithTostar('/teachers/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection