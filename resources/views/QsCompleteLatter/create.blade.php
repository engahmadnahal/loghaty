@extends('layout.master')

@section('title',__('dash.create_qs'))
@section('title_page',__('dash.create_qs'))

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
                                            <input type="text" id="title_ar" class="form-control" placeholder="{{__('dash.title_ar')}}"  required>
                                            <label for="title_ar">{{__('dash.title_ar')}}</label>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-12">
                                        <div class="form-label-group">
                                            <input type="text" id="title_en" class="form-control" placeholder="{{__('dash.title_en')}}"  required>
                                            <label for="title_en">{{__('dash.title_en')}}</label>
                                        </div>
                                    </div>



                                    

                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="quess_ar" class="form-control" placeholder="{{__('dash.quess_ar')}}"  required>
                                                <label for="quess_ar">{{__('dash.quess_ar')}}</label>
                                            </div>
                                        </div>
    
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="quess_en" class="form-control" placeholder="{{__('dash.quess_en')}}"  required>
                                                <label for="quess_en">{{__('dash.quess_en')}}</label>
                                            </div>
                                        </div>





        
                                        <div class="col-md-6 col-12">
                                            <div class="form-label-group">
                                                <input type="text" id="answer_ar" class="form-control" placeholder="{{__('dash.answer_ar')}}"  required>
                                                <label for="answer_ar">{{__('dash.answer_ar')}}</label>
                                            </div>
                                        </div>


                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="answer_en" class="form-control" placeholder="{{__('dash.answer_en')}}"  required>
                                                    <label for="answer_en">{{__('dash.answer_en')}}</label>
                                                </div>
                                            </div>

                                            


                                            <div class="col-md-6 col-12">
                                                <div class="form-label-group">
                                                    <input type="text" id="option_one_ar" class="form-control" placeholder="{{__('dash.option_one_ar')}}"  required>
                                                    <label for="option_one_ar">{{__('dash.option_one_ar')}}</label>
                                                </div>
                                            </div>
    
                                            
                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="option_one_en" class="form-control" placeholder="{{__('dash.option_one_en')}}"  required>
                                                        <label for="option_one_en">{{__('dash.option_one_en')}}</label>
                                                    </div>
                                                </div>



                                                <div class="col-md-6 col-12">
                                                    <div class="form-label-group">
                                                        <input type="text" id="option_two_ar" class="form-control" placeholder="{{__('dash.option_two_ar')}}"  required>
                                                        <label for="option_two_ar">{{__('dash.option_two_ar')}}</label>
                                                    </div>
                                                </div>
        
                                                
                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="option_two_en" class="form-control" placeholder="{{__('dash.option_two_en')}}"  required>
                                                            <label for="option_two_en">{{__('dash.option_two_en')}}</label>
                                                        </div>
                                                    </div>





                                                    <div class="col-md-6 col-12">
                                                        <div class="form-label-group">
                                                            <input type="text" id="option_three_ar" class="form-control" placeholder="{{__('dash.option_three_ar')}}"  required>
                                                            <label for="option_three_ar">{{__('dash.option_three_ar')}}</label>
                                                        </div>
                                                    </div>
            
                                                    
                                                        <div class="col-md-6 col-12">
                                                            <div class="form-label-group">
                                                                <input type="text" id="option_three_en" class="form-control" placeholder="{{__('dash.option_three_en')}}"  required>
                                                                <label for="option_three_en">{{__('dash.option_three_en')}}</label>
                                                            </div>
                                                        </div>




                                                            <div class="col-md-6 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="number" id="points" class="form-control" placeholder="{{__('dash.points')}}"  required>
                                                                    <label for="points">{{__('dash.points')}}</label>
                                                                </div>
                                                            </div>


                                                            <div class="col-md-12 col-12">
                                                                <div class="form-label-group">
                                                                    <input type="file" id="image_one" class="form-control" placeholder="{{__('dash.image')}}" required>
                                                                    <label for="image_one">{{__('dash.image')}}</label>
                                                                    <p class="text-muted ml-75 mt-50"><small>JPG,JPGE, GIF or PNG. </small></p>
                                                                </div>
                                                            </div>


                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group">
                                            <label for="city-column">{{__('dash.games')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="game_id">
                                                @foreach ($games as $game)
                                                    <option value="{{$game->id}}">{{$game->name}}</option>
                                                @endforeach
                                            </select>
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

        let quess_en = document.getElementById('quess_en').value;
        let quess_ar = document.getElementById('quess_ar').value;

        let answer_en = document.getElementById('answer_en').value;
        let answer_ar = document.getElementById('answer_ar').value;

        let option_one_ar = document.getElementById('option_one_ar').value;
        let option_one_en = document.getElementById('option_one_en').value;

        let option_two_ar = document.getElementById('option_two_ar').value;
        let option_two_en = document.getElementById('option_two_en').value;

        let option_three_ar = document.getElementById('option_three_ar').value;
        let option_three_en = document.getElementById('option_three_en').value;

        let points = document.getElementById('points').value;
        let game_id = document.getElementById('game_id').value;

        let image_one = document.getElementById('image_one').files[0];

        let formData = new FormData();

        formData.append('title_ar',title_ar);
        formData.append('title_en',title_en);

        formData.append('quess_en',quess_en);
        formData.append('quess_ar',quess_ar);

        formData.append('answer_en',answer_en);
        formData.append('answer_ar',answer_ar);

        formData.append('option_one_ar',option_one_ar);
        formData.append('option_one_en',option_one_en);

        formData.append('option_two_ar',option_two_ar);
        formData.append('option_two_en',option_two_en);

        formData.append('option_three_ar',option_three_ar);
        formData.append('option_three_en',option_three_en);

        formData.append('points',points);
        formData.append('game_id',game_id);
        formData.append('image_one',image_one);
  
        performStoreWithTostar('/qs_complete_latters',formData,'form');
    }
</script>
@endsection