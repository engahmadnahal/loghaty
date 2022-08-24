@extends('layout.master')

@section('title',__('dash.create_children'))
@section('title_page',__('dash.create_children'))

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
                                            <input type="text" id="name_ar" class="form-control" placeholder="{{__('dash.name_ar')}}"  value="{{$level->name_ar}}">
                                            <label for="name_ar">{{__('dash.name_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_en" class="form-control" placeholder="{{__('dash.name_en')}}"  value="{{$level->name_en}}">
                                            <label for="name_en">{{__('dash.name_en')}}</label>
                                        </div>
                                    </div>



                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="number" id="points" class="form-control" placeholder="{{__('dash.points')}}"  value="{{$level->points}}">
                                            <label for="points">{{__('dash.points')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="orderd" class="form-control" placeholder="{{__('dash.orderd')}}"  value="{{$level->orderd}}">
                                            <label for="orderd">{{__('dash.orderd')}}</label>
                                        </div>
                                    </div>


                                    
                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" @checked($level->active)>
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
        let orderd = document.getElementById('orderd').value;
        let points = document.getElementById('points').value;
        let active = document.getElementById('active').checked;

        let dataObj = {
            name_ar : name_ar,
            name_en : name_en,
            orderd : orderd,
            points : points,
            active : active,
            _method : 'PUT'

        };

  
        performUpdateWithTostar('/levels/{{$level->id}}',dataObj);
    }
</script>
@endsection