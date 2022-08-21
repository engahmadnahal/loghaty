@extends('layout.master')

@section('title',__('dash.edit_children'))
@section('title_page',__('dash.edit_children'))

@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name" class="form-control" placeholder="{{__('dash.name')}}"  value="{{$children->name}}">
                                            <label for="name">{{__('dash.name')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="date" id="dob" class="form-control" placeholder="{{__('dash.dob')}}"  value="{{$children->date_of_birth}}">
                                            <label for="dob">{{__('dash.dob')}}</label>
                                        </div>
                                    </div>


                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="file" id="image_avater" class="form-control" placeholder="{{__('dash.upload_image')}}" >
                                            <label for="image_avater">{{__('dash.upload_image')}}</label>
                                            <p class="text-muted ml-75 mt-50"><small>JPG,JPGE, GIF or PNG. </small></p>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.fathers')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="father_id" >
                                                @foreach ($fathers as $f)
                                                    <option value="{{$f->id}}" @checked($f->id == $children->father_id)>{{$f->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.teacher')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="class_id">
                                                @foreach ($classes as $class)
                                                    <option value="{{$class->id}}" @checked($f->id == $children->class_id)>{{$class->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>



                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.countries')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="country_id">
                                                @foreach ($countres as $c)
                                                    <option value="{{$c->id}}" @checked($c->id == $children->country_id)>{{$c->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" @checked($children->status == 'active')>
                                                <label class="custom-control-label" for="active"></label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" onclick="performUpdate()">{{__('dash.save')}}</button>
                                        <button type="reset" class="btn btn-outline-warning mr-1 mb-1 waves-effect waves-light">{{__('dash.reset')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@section('scripts')
<script>
    function performUpdate(){
        let name = document.getElementById('name').value;
        let dob = document.getElementById('dob').value;
        let country_id = document.getElementById('country_id').value;
        let father_id = document.getElementById('father_id').value;
        let class_id = document.getElementById('class_id').value;
        let image_avater = document.getElementById('image_avater').files[0];
        let active = document.getElementById('active').checked;

        let formData = new FormData();
        formData.append('name',name);
        formData.append('dob',dob);
        formData.append('country_id',country_id);
        formData.append('father_id',father_id);
        formData.append('class_id',class_id);
        formData.append('image_avater',image_avater);
        formData.append('active',active);
        formData.append('_method','PUT');

  
        performUpdateWithTostar('/childrens/{{$children->id}}',formData);
    }
</script>
@endsection