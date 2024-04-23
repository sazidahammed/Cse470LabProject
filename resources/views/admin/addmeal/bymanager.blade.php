@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/addmeal') }}">Add Meal</a>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row row-sm">
                <div class="col-sm-6 col-xl-6">
                    <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">{{ $user_name }} Your Package</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                      </div><!-- card-header -->
                      <div class="d-flex align-items-center justify-content-between">
                        
                        
                        <h5 style="color:#F6F6F6">Package Name :{{ $package_name }}</h5>
                        <h5 style="color:#F6F6F6">Package Rate :{{ $package_price }}</h5>

                       

                        {{-- <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{  $total_bill }}</h3> --}}
                      </div><!-- card-body -->
                      <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                        <div>

                        </div>
                        <div>

                        </div>
                      </div><!-- -->
                    </div><!-- card -->
                  </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-6">
                    <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">About Your Meal</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                     
                      </div><!-- card-header -->
                      <div class="d-flex align-items-center justify-content-between">
                        <h5 style="color:#F6F6F6">Meal Number : {{ $total_meal_ofuser }}</h5>
                        <h5 style="color:#F6F6F6">Total  : BDT{{ $z }}</h5>
                        {{-- <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{  App\Models\Addmoney::all()->where('company' ,'==',$user_company)->sum('amount') }}</h3> --}}
                      </div><!-- card-body -->
                      <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                        <div>

                        </div>
                        <div>

                        </div>
                      </div><!-- -->
                    </div><!-- card -->
                  </div><!-- col-3 -->

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card" style="background-color: #d8dce3">
                        <div class="card-header">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                        <div class="card">
                            {{-- <div class="card-header">
                            </div> --}}
                            <div style="background-color:#18454a;" class="card-body">
                                @for ($x = 01; $x <=15 ; $x++)
                                <form action="{{ url('/bymanager/addmeal') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-3">
                                            <label for="" style="color: #F6F6F6;" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>
                                            <input name="user_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $user_id }}" required >
                                        </div>
                                        @if (App\Models\User::find($user_id)->type == 91)
                                        @foreach ($meal_package as $value )
                                        <input name="package_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $value->package_id }}" required >
                                        @endforeach
                                        @endif

                                        @php
                                        if($x < 10){
                                            $date_check = "0".$x."-".$monthnumber."-".now()->year;
                                        }else{
                                            $date_check = $x."-".$monthnumber."-".now()->year;
                                        }
                                        $db_dates = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $db_dates_lunch = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $meals = App\Models\Addmeal::all()->where('month', '!=',$monthnumber);
                                        foreach ($meals as $meal) {
                                            $meal->delete();
                                        }

                                        @endphp
                                        <input name="month" type="hidden" class="visually-hidden" id="ex1" value="{{ $monthnumber }}" required >
                                        <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $date_check }}" >
                                        @foreach ($db_dates as $db_date)
                                               @if ($date_check == $db_date->date )
                                               <div class="col-lg-3">
                                                   <input name="lunch" class="form-control" id="ex1"  value="{{ $db_date->lunch }}" type=number  min="0" step='.5' required>
                                               </div>
                                               <div class="col-lg-3">
                                                <input name="dinner" class="form-control" id="ex1" value="{{ $db_date->dinner }}" type="number" min="0" step=".5" required>
                                                </div>

                                               @endif

                                        @endforeach
                                        {{-- @foreach ($db_dates as $db_date)
                                               @if ($date_check != $db_date->date )


                                               @endif

                                        @endforeach --}}
                                            {{-- {{ $db_dates }} --}}
                                            @if (count($db_dates) == 0)
                                            <div class="col-lg-3">
                                                <input name="lunch" placeholder="lunch" class="form-control" id="ex1"  type="number" min="0" step='.5' required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" type="number" min="0" step=".5" required>
                                            </div>
                                            @endif
                                            
                                            
                                            
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary" >Confirm</button>
                                            </div>
                                        


                                    </div>
                                    <div class="form-group ">

                                    </div>
                                </form>

                                @endfor
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card">
                            {{-- <div class="card-header">
                            </div> --}}
                            <div style="background-color:#18454a;" class="card-body">
                                @for ($x = 16; $x <=30 ; $x++)
                                <form action="{{ url('/bymanager/addmeal') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-3">
                                            <label for="" style="color: #F6F6F6;" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>
                                            <input name="user_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $user_id }}" required >
                                        </div>
                                        @if (App\Models\User::find($user_id)->type == 91)
                                        @foreach ($meal_package as $value )
                                        <input name="package_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $value->package_id }}" required >
                                        @endforeach
                                        @endif

                                        @php
                                        if($x < 10){
                                            $date_check = "0".$x."-".$monthnumber."-".now()->year;
                                        }else{
                                            $date_check = $x."-".$monthnumber."-".now()->year;
                                        }
                                        $db_dates = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $db_dates_lunch = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $meals = App\Models\Addmeal::all()->where('month', '!=',$monthnumber);
                                        foreach ($meals as $meal) {
                                            $meal->delete();
                                        }

                                        @endphp
                                        <input name="month" type="hidden" class="visually-hidden" id="ex1" value="{{ $monthnumber }}" required >
                                        <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $date_check }}" >
                                        @foreach ($db_dates as $db_date)
                                               @if ($date_check == $db_date->date )
                                               <div class="col-lg-3">
                                                   <input name="lunch" class="form-control" id="ex1"  value="{{ $db_date->lunch }}" type=number  min="0" step='.5' required>
                                               </div>
                                               <div class="col-lg-3">
                                                <input name="dinner" class="form-control" id="ex1" value="{{ $db_date->dinner }}" type="number" min="0" step=".5" required>
                                                </div>

                                               @endif

                                        @endforeach
                                        {{-- @foreach ($db_dates as $db_date)
                                               @if ($date_check != $db_date->date )


                                               @endif

                                        @endforeach --}}
                                            {{-- {{ $db_dates }} --}}
                                            @if (count($db_dates) == 0)
                                            <div class="col-lg-3">
                                                <input name="lunch" placeholder="lunch" class="form-control" id="ex1"  type="number" min="0" step='.5' required>
                                            </div>
                                            <div class="col-lg-3">
                                                <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" type="number" min="0" step=".5" required>
                                            </div>
                                            @endif
                                
                                            <div class="col-lg-3">
                                                <button type="submit" class="btn btn-primary" >Confirm</button>
                                            </div>
                            


                                    </div>
                                    <div class="form-group ">

                                    </div>
                                </form>

                                @endfor
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
