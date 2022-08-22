@extends('layout.master')

@section('title',__('dash.new_countriy'))
@section('title_page',__('dash.new_countriy'))
@section('content')
<section id="multiple-column-form">
    <div class="row match-height">
        <div class="col-12">
            <div class="card">
               
                <div class="card-content">
                    <div class="card-body">
                        <form class="form" id="form">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" class="form-control" placeholder="{{__('dash.name_ar')}}" id="name_ar">
                                            <label for="first-name-column">{{__('dash.name_ar')}}</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_en" class="form-control" placeholder="{{__('dash.name_en')}}" required>
                                            <label for="last-name-column">{{__('dash.name_en')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <p class="mb-0">{{__('dash.active')}}</p>
                                                <input type="checkbox" class="custom-control-input" id="active" required>
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
        let dataObj = {
            name_en: document.getElementById('name_en').value,
            name_ar: document.getElementById('name_ar').value,
            active: document.getElementById('active').checked
        };
        performStoreWithTostar('/countries',dataObj);
        document.getElementById('form').reset();
    }
</script>
@endsection