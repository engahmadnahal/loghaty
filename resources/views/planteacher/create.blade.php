@extends('layout.master')

@section('title',__('dash.create_plan'))
@section('title_page',__('dash.new_plan'))

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
                                            <input type="text" id="name_ar" class="form-control" placeholder="{{__('dash.name_ar')}}"required>
                                            <label for="name_ar">{{__('dash.name_ar')}}</label>
                                        </div>
                                    </div>

                                    
                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="name_en" class="form-control" placeholder="{{__('dash.name_en')}}"required>
                                            <label for="name_en">{{__('dash.name_en')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="sum_month" class="form-control" placeholder="{{__('dash.total_month')}}"required>
                                            <label for="sum_month">{{__('dash.total_month')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="max_class" class="form-control" placeholder="{{__('dash.max_class')}}"required>
                                            <label for="max_class">{{__('dash.max_class')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="max_children" class="form-control" placeholder="{{__('dash.max_children')}}"required>
                                            <label for="max_children">{{__('dash.max_children')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="price_usd" class="form-control" placeholder="{{__('dash.price_usd')}}"required>
                                            <label for="price_usd">{{__('dash.price_usd')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="price_aed" class="form-control" placeholder="{{__('dash.price_aed')}}"required>
                                            <label for="price_aed">{{__('dash.price_aed')}}</label>
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
        let sum_month = document.getElementById('sum_month').value;
        let price_usd = document.getElementById('price_usd').value;
        let price_aed = document.getElementById('price_aed').value;
        let max_class = document.getElementById('max_class').value;
        let max_children = document.getElementById('max_children').value;
        let active = document.getElementById('active').checked;

       let dataObj = {
        name_en :name_en,
        name_ar :name_ar,
        price_usd :price_usd,
        price_aed :price_aed,
        sum_month : sum_month,
        active :active,
        max_class : max_class,
        max_children : max_children
       };

        performStoreWithTostar('/plan_teachers',dataObj,'form');
    }
</script>
@endsection