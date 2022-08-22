@extends('layout.master')

@section('title','Home')

@section('content')
<section id='dashboard-analytics'>

<div class="row">
  

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>


    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>



    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>


    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>


    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
        </div>
    </div>

    <div class="col-lg-3 col-sm-6 col-12">
        <div class="card">
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
</div>
</section>

@endsection