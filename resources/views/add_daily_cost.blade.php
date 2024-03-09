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
                <div class="col-sm-6 col-xl-3">
                  <div class="card pd-20 bg-primary">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                      <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">The whole amount</h6>
                      <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                      <h5 style="color:#F6F6F6">Total Money :</h5>
                      <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{  App\Models\Addmoney::all()->where('company' ,'==',$user_company)->sum('amount') }}</h3>
                       {{-- Select SUM('amount') From Addmoney Where company = $user_company; --}}
                    </div><!-- card-body -->
                    <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                      <div>

                      </div>
                      <div>

                      </div>
                    </div><!-- -->
                  </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-sm-t-0">
                  <div class="card pd-20 bg-info">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                      <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">This month's Cost</h6>
                      <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 style="color:#F6F6F6">Cost :</h5>
                      <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ App\Models\Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost') }}</h3>
                      {{-- Select SUM('dailycost') From Addcost Where company = $user_company; --}}
                    </div><!-- card-body -->
                    <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                      <div>

                      </div>
                      <div>

                      </div>
                    </div><!-- -->
                  </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                  <div class="card pd-20 bg-purple">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                      <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Remaining Money till now </h6>
                      <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 style="color:#F6F6F6;">Rest Money :</h5>
                      <h3 class="mg-b-0 tx-white tx-lato tx-bold">{{ App\Models\Addmoney::all()->where('company' ,'==',$user_company)->sum('amount') - App\Models\Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')}}</h3>
                       {{--Select SUM('amount') From Addmoney Where company = $user_company - Select SUM('dailycost') From Addcost Where company = $user_company; --}}
                    </div><!-- card-body -->
                    <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                      <div>

                      </div>
                      <div>

                      </div>
                    </div><!-- -->
                  </div><!-- card -->
                </div><!-- col-3 -->
                <div class="col-sm-6 col-xl-3 mg-t-20 mg-xl-t-0">
                  <div class="card pd-20 bg-sl-primary">
                    <div class="d-flex justify-content-between align-items-center mg-b-10">
                      <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Current Meal Rate</h6>
                      <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                    </div><!-- card-header -->
                    <div class="d-flex align-items-center justify-content-between">
                        <h5 style="color:#F6F6F6;">Rate :</h5>
                      <h3 class="mg-b-0 tx-white tx-lato tx-bold">
                        @if ($total_meal != 0)
                          @php
                              $meal_round = App\Models\Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')/$total_meal;
                               $meal_rate = round($meal_round, 2);
                          @endphp
                        {{ $meal_rate }}
                        @endif
                         {{-- Select SUM('dailycost') From Addcost Where company = $user_company ;/$total_meal --}}
                      </h3>
                    </div><!-- card-body -->
                    <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                      <div>

                      </div>
                      <div>

                      </div>
                    </div><!-- -->
                  </div><!-- card -->
                </div><!-- col-3 -->
              </div><!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card" >
                                <div style="background-color:#d8dce3; padding:20px; " class="card-header  ">
                                        <div class="row " style="">

                                           <div class="col-lg-6" style="background-color:#5b93d3;">
                                            <h3 style="  color:#F6F6F6; margin:20px 0px; " >Total Meal:{{ $total_meal }} </h3>
                                           </div>
                                           <div class="col-lg-6" style="background-color:#5b93d3;">
                                            <h3 style=" color:#F6F6F6;  margin:20px 0px;" >Today's Meal:{{ $today_meal}} </h3>
                                           </div>
                                        </div>
                                </div>
                                <div style="background-color:#18454a;"  class="card-body">

                                    @for ($x = 01; $x <=30 ; $x++)

                                    <form action="{{ url('/cost/insert') }}" method="POST">
                                        @csrf
                                        <div class="form-group row">

                                            <div class="col-lg-2">
                                                <label for="" style="color: #F6F6F6;" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>

                                            </div>
                                            @php
                                                if($x < 10){
                                                    $date_check = "0".$x."-".$monthnumber."-".now()->year;
                                                }else{
                                                    $date_check = $x."-".$monthnumber."-".now()->year;
                                                }
                                                $db_dates = App\Models\Addcost::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check)->where('company', "==", Auth::user()->company);
                                                $costs = App\Models\Addcost::all()->where('month', '!=',$monthnumber);
                                                 foreach ($costs as $cost) {
                                                    $cost->delete();
                                                 }

                                            @endphp
                                            {{-- $db_dates = Select * From Addcost Where company = $user_company and user_id = $user_id and date = $date_check;
                                            $costs = Select * From Addcost Where month != $monthnumber;
                                            foreach ($costs as $cost) {
                                                Delete From Addcost Where id = $cost['id']
                                             }
                                             --}}

                                            <input name="month" type="hidden" class="visually-hidden" id="ex1" value="{{ $monthnumber }}" required >

                                            <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $date_check }}" required >
                                            @foreach ($db_dates as $db_date)
                                            @if ($date_check == $db_date->date)
                                            <div class="col-lg-4">
                                                <textarea name="describe" class="form-control" placeholder="" id="textAreaExample1" value="" rows="4" required>{{ $db_date->describe }}</textarea>
                                                {{-- "{{ $db_date['describe'] }}" --}}
                                            </div>
                                            <div class="col-lg-2">
                                                <input name="dailycost" placeholder="Amount" class="form-control" id="ex1" value="{{ $db_date->dailycost }}"  type="number" min="0" required>
                                                {{-- value="{{ $db_date['dailycost'] }}" --}}
                                            </div>
                                            <div class="col-lg-2">
                                                <select name='marketby' class="form-control" required>
                                                    <option value="{{ $db_date->marketby }}">{{ App\Models\User::find($db_date->marketby)->name }}</option>
                                                    @foreach ($members as $member)
                                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                                    @endforeach


                                                </select>
                                            </div>

                                            @endif

                                            @endforeach

                                            @if (count($db_dates) == 0)
                                            <div class="col-lg-4">
                                                <textarea name="describe" class="form-control" placeholder="Describe your meal" id="textAreaExample1" value="" rows="4" required></textarea>
                                            </div>
                                            <div class="col-lg-2">
                                                <input name="dailycost" placeholder="Amount" class="form-control" id="ex1" value=""  type="number" min="0" required>
                                            </div>
                                            <div class="col-lg-2">
                                                <select name='marketby' class="form-control" required>
                                                    <option value="">-- Select Member --</option>
                                                    @foreach ($members as $member)
                                                    <option value="{{ $member->id }}">{{ $member->name }}</option>
                                                    @endforeach


                                                </select>
                                            </div>
                                            @endif




                                            @if ( $date_check <= $date)
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary" disabled>Confirm</button>
                                            </div>
                                            @else
                                            <div class="col-lg-2">
                                                <button type="submit" class="btn btn-primary" >Confirm</button>
                                            </div>
                                            @endif


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

        </div>


    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
