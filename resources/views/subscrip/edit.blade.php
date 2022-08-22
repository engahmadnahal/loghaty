@extends('layout.master')

@section('title',__('dash.new_subs'))
@section('title_page',__('dash.new_subs'))

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
                                            <label for="city-column">{{__('dash.fathers')}}</label>

                                            <select class="select2 form-control select2-hidden-accessible" data-select2-id="1" tabindex="-1" aria-hidden="true" id="father_id">
                                                <option value="-1">{{__('dash.father')}}</option>
                                                @foreach ($fathers as $f)

                                                    <option value="{{$f->id}}" @checked($f->id  == $subscription->father->id )>{{$f->email}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    

                                  

                                    <div class="col-md-12 col-12">
                                        <div class="form-label-group" id="childrens">

                                            

                                        </div>
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


window.onload = function(){
getChildrens({{$subscription->father->id}});

}

let father = document.getElementById('father_id');
    father.onchange = function(e){
        getChildrens(father.value)
    }


    function performStore(el,children_id){
        let father_id = document.getElementById('father_id').value;

        let formData = new FormData();
        formData.append('father_id',father_id);
        formData.append('children_id',children_id);
  
        axios.post('/subscriptions',formData).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                getChildrens(father_id)
                el.remove();
            }).catch(function(error){
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });
    }


    function performUpdate(el,children_id){
        let father_id = document.getElementById('father_id').value;

        let formData = new FormData();
        formData.append('father_id',father_id);
        formData.append('children_id',children_id);
        formData.append('_method','DELETE');
  
        axios.post('/subscriptions/change-subs',formData).then(function(response){
                toastr.success(response.data.message,response.data.title, { "progressBar": true });
                getChildrens(father_id)
                el.remove();
            }).catch(function(error){
                toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
            });
    }




    function getChildrens(id){
        let inputChild = "";

        let childrens = document.getElementById('childrens');

        axios.post('/subscriptions/getChildrens',{
            'father_id' : id
        }).then(function(response){
            for(let i = 0; i < response.data.childrens.length; i++){
                inputChild += `
                                            <div class="vs-checkbox-con vs-checkbox-primary" onclick="${response.data.childrens[i].subscrip ? 'performUpdate(this,'+response.data.childrens[i].id+')' : 'performStore(this,'+response.data.childrens[i].id+')'} ">
                                                <input type="checkbox"  ${response.data.childrens[i].subscrip ? 'checked' : ''}>
                                                <span class="vs-checkbox">
                                                    <span class="vs-checkbox--check">
                                                        <i class="vs-icon feather icon-check"></i>
                                                    </span>
                                                </span>
                                                <span class="">${response.data.childrens[i].name}</span>
                                            </div>
                                            `;
            }
            
            childrens.innerHTML = inputChild;
        }).catch(function(error){
            toastr.error(error.response.data.message,error.response.data.title, { "progressBar": true });
        });

    }

</script>
@endsection