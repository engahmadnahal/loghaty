@extends('layout.master')

@section('title',__('dash.index_articals'))
@section('title_page',__('dash.index_articals'))

@section('content')



<section id="basic-datatable">
    <div class="row">
        
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body card-dashboard">
                        <div class="table-responsive">
                            <a id="addRow" href="{{route('articals.create')}}" class="col-xl-2 col-md-12 col-sm-12 btn btn-primary mb-2 waves-effect waves-light"><i class="feather icon-plus"></i>&nbsp; {{__('dash.add_new')}}</a>
                            <table class="table zero-configuration">
                                <thead>
                                    <tr>
                                        <th>{{__('dash.title_ar')}}</th>
                                        <th>{{__('dash.title_en')}}</th>
                                        <th>{{__('dash.publish')}}</th>
                                        <th>{{__('dash.add_date')}}</th>
                                        <th>{{__('dash.actions')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($articals as $artical)
                                        <tr>
                                            
                                            <td>{{$artical->title_ar}}</td>
                                            <td>{{$artical->title_en}}</td>
                                            <td>{{$artical->admin->name}}</td>
                                            <td>{{$artical->created_at->format('Y-m-d')}}</td>
                                            <td class="action-table">
                                                <a href="{{route('articals.edit',$artical->id)}}"  class="btn bg-gradient-primary   waves-effect waves-light"><i class="fa-solid fa-pen-to-square"></i></i></a>
                                                <button type="button" class="btn bg-gradient-danger  waves-effect waves-light" onclick="performDelete(this,{{$artical->id}})"><i class="fa fa-trash"></i></button>
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
        performDeleteWithTostar('/articals/'+id,{"_method" : 'DELETE'},el,'tr');
    }
</script>
@endsection