@extends('layout.master')

@section('title',__('dash.create_classes'))
@section('title_page',__('dash.new_classes'))

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
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_ar" class="form-control" placeholder="{{__('dash.name_ar')}}"  required>
                                            <label for="name_ar">{{__('dash.name_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_en" class="form-control" placeholder="{{__('dash.name_en')}}"  required>
                                            <label for="name_en">{{__('dash.name_en')}}</label>
                                        </div>
                                    </div>



                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.countries')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="teacher_id">
                                                @foreach ($teachers as $t)
                                                    <option value="{{$t->id}}">{{$t->full_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" checked>
                                                <label class="custom-control-label" for="active"></label>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div class="col-12">
                                        <button type="button" class="btn btn-primary mr-1 mb-1 waves-effect waves-light" onclick="performStore()">{{__('dash.save')}}</button>
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
    function performStore(){
        let name_en = document.getElementById('name_en').value;
        let name_ar = document.getElementById('name_ar').value;
        let teacher_id = document.getElementById('teacher_id').value;
        let active = document.getElementById('active').checked;

        let dataObj = {
            name_en : name_en,
            name_ar : name_ar,
            teacher_id : teacher_id,
            active : active,
        };

  
        performStoreWithTostar('/classes',dataObj,'form');
    }
</script>
@endsection