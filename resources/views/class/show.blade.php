
@extends('layout.master')

@section('title',__('dash.class_setting'))
@section('title_page',__('dash.class_setting'))
@section('content')
<section class="page-users-view">
    <div class="row">
        <!-- account start -->
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-body">
                    <div class="row">
                       
                        <div class="col-12 col-sm-9 col-md-6 col-lg-5">
                            <table>
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.name_ar')}}</td>
                                    <td>{{$class->name_ar}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.name_en')}}</td>
                                    <td>{{$class->name_en}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.state')}}</td>
                                    <td>{{$class->state}}</td>
                                </tr>
                            </tbody></table>
                        </div>
                        <div class="col-12 col-md-12 col-lg-5">
                            <table class="ml-0 ml-sm-0 ml-lg-0">
                                <tbody><tr>
                                    <td class="font-weight-bold">{{__('dash.teacher')}}</td>
                                    <td>{{$class->teacher->full_name}}</td>
                                </tr>
                                <tr>
                                    <td class="font-weight-bold">{{__('dash.num_childrens')}}</td>
                                    <td>{{$class->childrens->count()}}</td>
                                </tr>
                             
                            </tbody></table>
                        </div>
                        <div class="col-12">
                            <a href="{{route('semesters.edit',$class->id)}}" class="btn btn-primary mr-1 waves-effect waves-light"><i class="feather icon-edit-1"></i> {{__('dash.edit')}}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- account end -->
        <!-- information start -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.childrens')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($class->childrens->take(5) as $c)
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-children" style=" font-size: 21px; "></i></div>
                        <div class="col-6">{{$c->name}}</div>
                        <div class="col-5">
                            <div class="action-table">
                                <p>{{$c->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                   </div>
                    @empty
                        <p>{{__('dash.no_results')}}</p>
                    @endforelse
                   
                </div>
            </div>
        </div>
        <!-- information start -->
        <!-- social links end -->
        <div class="col-md-6 col-12 ">
            <div class="card">
                <div class="card-header">
                    <div class="card-title mb-2">{{__('dash.last_add_children')}}</div>
                </div>
                <div class="card-body">
                    @forelse ($latestChild as $c)
                    <div class="row pb-1">
                        <div class="col-1"><i class="fa-solid fa-children" style=" font-size: 21px; "></i></div>
                        <div class="col-6">{{$c->name}}</div>
                        <div class="col-5">
                            <div class="action-table">
                                <p>{{$c->created_at->diffForHumans()}}</p>
                            </div>
                        </div>
                   </div>
                    @empty
                        <p>{{__('dash.no_results')}}</p>
                    @endforelse
                   
                </div>
            </div>
        </div>
        <!-- social links end -->
       
    </div>
</section>
@endsection

@section('scripts')
<script>
    function performUpdate(){
        let full_name = document.getElementById('full_name').value;
        let country = document.getElementById('country').value;
        let email = document.getElementById('email').value;
        let image_avater = document.getElementById('image_avater').files[0];


        let formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('full_name',full_name);
        formData.append('country',country);
        formData.append('email',email);
        formData.append('image_avater',image_avater);


            
        performUpdateWithTostar('/classs/{{$class->id}}',formData);

    }
</script>
@endsection