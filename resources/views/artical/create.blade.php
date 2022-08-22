@extends('layout.master')

@section('title',__('dash.create_artical'))
@section('title_page',__('dash.create_artical'))

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
                                            <input type="text" id="title_ar" class="form-control" placeholder="{{__('dash.title_ar')}}"  required>
                                            <label for="title_ar">{{__('dash.title_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="title_en" class="form-control" placeholder="{{__('dash.title_en')}}"  required>
                                            <label for="title_en">{{__('dash.title_en')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <textarea type="text" id="body_ar" class="form-control" placeholder="{{__('dash.artical_ar')}}"  required></textarea>
                                            <label for="body_ar">{{__('dash.artical_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <textarea type="text" id="body_en" class="form-control" placeholder="{{__('dash.artical_en')}}"  required></textarea>
                                            <label for="body_en">{{__('dash.artical_en')}}</label>
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
        let title_ar = document.getElementById('title_ar').value;
        let title_en = document.getElementById('title_en').value;
        let body_ar = document.getElementById('body_ar').value;
        let body_en = document.getElementById('body_en').value;

        
        let dataObj = {
            title_en : title_en,
            body_en : body_en,
            body_ar : body_ar,
            title_ar : title_ar,
        };

        performStoreWithTostar('/articals',dataObj,'form');
    }
</script>
@endsection