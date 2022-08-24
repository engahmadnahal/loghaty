@extends('layout.master')

@section('title','Home')

@section('content')
<section id='dashboard-analytics'>

<div class="row">
  
    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('admins.index')}}" class='anlytics'>
                <div class="card-header d-flex align-items-start pb-0">
                    <div>
                        <h2 class="text-bold-700 mb-0">{{$admins->count()}}</h2>
                        <p>{{__('dash.num_admins')}}</p>
                    </div>
                    <div class="avatar bg-rgba-primary p-50 m-0">
                        <div class="avatar-content">
                            <i class="fa-solid fa-user text-primary font-medium-5"></i>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('teachers.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$teachers->count()}}</h2>
                    <p>{{__('dash.num_teachers')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-person-chalkboard text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>



    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('fathers.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$fathers}}</h2>
                    <p>{{__('dash.num_fathers')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-people-roof text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>


    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('childrens.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$childrens->count()}}</h2>
                    <p>{{__('dash.num_childrens')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-children text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('subscriptions.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$totalSub}}</h2>
                    <p>{{__('dash.num_subscripers')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-user-tie text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('plans.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$plans}}</h2>
                    <p>{{__('dash.plan')}}</p> 
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-dollar-sign text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
            <a href="{{route('levels.index')}}" class='anlytics'>

            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$levles}}</h2>
                    <p>{{__('dash.num_levels')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-chart-simple text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
            </a>
        </div>
    </div>


    <div class="col-lg-3 col-sm-6 col-12">
        
        <div class="card">
            <a href="{{route('games.index')}}" class='anlytics'>
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$games}}</h2>
                    <p>{{__('dash.num_games')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-book text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        
        <div class="card">
            <a href="{{route('classes.index')}}" class='anlytics'>
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$classes->count()}}</h2>
                    <p>{{__('dash.num_class')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-graduation-cap text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </a>
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">

        <div class="card">
            <div class="card-header d-flex align-items-start pb-0">
                <div>
                    <h2 class="text-bold-700 mb-0">{{$permission}}</h2>
                    <p>{{__('dash.num_permission')}}</p>
                </div>
                <div class="avatar bg-rgba-primary p-50 m-0">
                    <div class="avatar-content">
                        <i class="fa-solid fa-gears text-primary font-medium-5"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>


    
</div>

<div class='row'>
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card" style="height: 469.227px;">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">{{__('dash.last_login')}}</h4>
                 
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($admins->take(7) as $a)
                    <li class="list-group-item">
                        <span class="badge badge-pill bg-primary float-right">{{$a->last_login}} </span>
                        {{$a->name}}
                    </li>
                    @endforeach
                   
                   
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card" style="height: 469.227px;">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">{{__('dash.last_add_teacher')}}</h4>
                 
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($teachers->take(7) as $t)
                    <li class="list-group-item">
                        <span class="badge badge-pill bg-primary float-right">{{$t->created_at->diffForhumans()}} </span>
                        {{$t->full_name}}
                    </li>
                    @endforeach
                   
                   
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card" style="height: 469.227px;">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">{{__('dash.last_login_father')}}</h4>
                 
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($fathersData->take(7) as $f)
                    <li class="list-group-item">
                        <span class="badge badge-pill bg-primary float-right">{{$f->last_login}} </span>
                        {{$f->email}}
                    </li>
                    @endforeach
                   
                   
                </ul>
            </div>
        </div>
    </div>
</div>

<div class='row'>
    <div class="col-xl-12 ">
        <div class="card">
               
            <div class="card-content">
                <div class="card-body card-dashboard">
                    <div class="table-responsive">
                        <h4 class="card-title">{{__('dash.history_analytics')}}</h4>
                       
                        <table class="table zero-configuration">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>{{__('dash.name')}}</th>
                                    <th>{{__('dash.levels')}}</th>
                                    <th>{{__('dash.games')}}</th>
                                    <th>{{__('dash.add_date2')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histores as $h)
                                    <tr>
                                       
                                        <td>{{++$loop->index}}</td>
                                        <td>{{$h->children->name}}</td>
                                        <td>{{$h->level->name}}</td>
                                        <td>{{$h->game->name}}</td>
                                        <td>{{$h->created_at->diffForHumans()}}</td>
                                      
                                        
                                    </tr>
                                @endforeach
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class='row'>
    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card" style="height: 469.227px;">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">{{__('dash.last_subs')}}</h4>
                 
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($subsData->take(7) as $s)
                    <li class="list-group-item">
                        <span class="badge badge-pill bg-primary float-right">{{$s->created_at->diffForHumans()}} </span>
                        {{$s->children->name}}
                    </li>
                    @endforeach
                   
                   
                </ul>
            </div>
        </div>
    </div>

    <div class="col-xl-4 col-md-6 col-sm-12">
        <div class="card" style="height: 469.227px;">
            <div class="card-content">
                <div class="card-body">
                    <h4 class="card-title">{{__('dash.last_add_children')}}</h4>
                 
                </div>
                <ul class="list-group list-group-flush">
                    @foreach ($childrens->take(7) as $c)
                    <li class="list-group-item">
                        <span class="badge badge-pill bg-primary float-right">{{$c->last_login}} </span>
                        {{$c->name}}
                    </li>
                    @endforeach
                   
                   
                </ul>
            </div>
        </div>
    </div>


</div>



</section>

@endsection