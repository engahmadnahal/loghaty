@extends('layout.master')

@section('title',__('dash.edit_game'))
@section('title_page',__('dash.edit_game'))

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
                                            <input type="text" id="name_ar" class="form-control" placeholder="{{__('dash.name_ar')}}"  value="{{$game->name_ar}}">
                                            <label for="name_ar">{{__('dash.name_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_en" class="form-control" placeholder="{{__('dash.name_en')}}"  value="{{$game->name_en}}">
                                            <label for="name_en">{{__('dash.name_en')}}</label>
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.level')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="level_id">
                                                @foreach ($levels as $level)
                                                    <option value="{{$level->id}}" @selected($level->id == $game->level_id)>{{$level->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.plan')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="2" tabindex="-1" aria-hidden="true" id="plan_id">
                                                @foreach ($plans as $plan)
                                                    <option value="{{$plan->id}}" @selected($plan->id == $game->plan_id)>{{$plan->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-12">
                                                <div class="form-label-group">
                                                    <input type="file" id="image" class="form-control" placeholder="{{__('dash.upload_image')}}" required>
                                                    <label for="image">{{__('dash.upload_image')}}</label>
                                                    <p class="text-muted ml-75 mt-50"><small>JPG,JPGE, GIF or PNG. </small></p>
                                                </div>

                                           
                                            
                                        </div>
                                       
                                        <div class="col-md-12 col-sm-12">
                                            <div class="preview-image ">
                                                <img src="{{Storage::url($game->image)}}"  alt="">
                                            </div>
                                        </div>
                                        
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" @checked($game->active)>
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
        let name_ar = document.getElementById('name_ar').value;
        let name_en = document.getElementById('name_en').value;
        let plan_id = document.getElementById('plan_id').value;
        let level_id = document.getElementById('level_id').value;
        let active = document.getElementById('active').checked;
        let image = document.getElementById('image').files[0];
        let formData = new FormData();

        formData.append('name_ar',name_ar);
        formData.append('name_en',name_en);
        formData.append('level_id',level_id);
        formData.append('plan_id',plan_id);
        formData.append('active',active);
        formData.append('image',image);
        formData.append('_method','PUT');

  
        performUpdateWithTostar('/games/{{$game->id}}',formData);
    }
</script>
@endsection