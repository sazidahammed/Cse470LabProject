@php

@endphp


<div class="container">
<div class="row row-sm">
                <div class="col-sm-4 col-xl-4">
                    <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">{{ Auth::user()->name }} Your Package</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                      </div><!-- card-header -->
                      <div class="d-flex align-items-center justify-content-between">
                        @if (Auth::user()->type == 91)
                        @foreach ($meal_package as $value )
                        <h5 style="color:#F6F6F6" class="tx-18">Package Name :{{ App\Models\Package::find($value->package_id)->package_name }}</h5>
                        <h5 style="color:#F6F6F6" class="tx-18">Package Rate :BDT{{ App\Models\Package::find($value->package_id)->package_price }}</h5>

                        @endforeach
                         @endif

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
                <div class="col-sm-4 col-xl-4">
                    <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">About Your Meal</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                     @php
                     if (Auth::user()->type == 91) {

                            foreach ($meal_package as $value ){
                            $x = App\Models\Package::find($value->package_id)->package_price;

                            }
                     }else{
                        if($total_meal != 0 ){
                            $meal_round = App\Models\Addcost::all()->where('company' ,'==',$user_company)->sum('dailycost')/$total_meal;
                        $x = round($meal_round, 2);
                        }
                        else{
                            $x =0;
                        }


                     }
                     $y = $total_meal_ofuser;
                     $z = $x*$y;
                     @endphp

                      </div><!-- card-header -->
                      <div class="d-flex align-items-center justify-content-between">
                        <h5 style="color:#F6F6F6" class="tx-18">Meal Number : {{ $total_meal_ofuser }}</h5>
                        <h5 style="color:#F6F6F6" class="tx-18">Total  : BDT{{ $z  }}</h5>
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
                  <div class="col-sm-4 col-xl-4">
                    <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white"> Your outstanding Balance</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                      </div><!-- card-header -->
                      @php
                       $deposited = App\Models\Addmoney::all()->where('user_id' ,'==',Auth::User()->id)->sum('amount');
                       $remaining_deposits = $deposited - $z;
                       if($z < $remaining_deposits){
                           $due = 0;
                       }else{
                           $due = $z - $remaining_deposits;
                       }

                      @endphp
                      <div class="d-flex align-items-center justify-content-between">
                        @if (Auth::user()->type == 91)
                        @foreach ($meal_package as $value )
                        <h5 style="color:#F6F6F6" class="tx-18">Total Due :BDT {{$due}}</h5>
                        <h5 style="color:#F6F6F6" class="tx-18">Deposited :BDT {{$remaining_deposits}}</h5>

                        @endforeach
                         @endif

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
    <div class="row row-sm pt-4">
        <div class="col-lg-8">
            <table class="table table-success table-striped table-hover">
                <tr>
                    <th>SL</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Create At</th>
                </tr>
                @forelse ($general_user as $index=>$member)
                <tr>
                    <td>{{ $loop->index+1 }}</td>
                    {{-- <td>{{ $mambers->firstitem()+$index }}</td> --}}
                    <td>{{ App\Models\User::find($member->user_id)->name }}</td>
                    <td>{{ $member->amount }}</td>
                    <td>{{ $member->created_at->format('d-m-y h:i:s A') }}</td>
                </tr>
                {{-- <td>{{ $loop['index'] }}</td>
                <td>{{ $member['amount'] }}</td>
                <td>{{ $member['created_at'] }}</td>
                <td>{{ $order_request['location'] }}</td> --}}
                @empty
                <tr ><td></td><td></td><td class="text-center">No Data Available</td><td></td></tr>
                @endforelse<tr>
                <td></td>
                    <td><h5>TOTAL:</h5></td>
                    <td>{{ App\Models\Addmoney::all()->where('user_id' ,'==',Auth::User()->id)->sum('amount') }}</td>
                </tr>
                {{-- Select sum('amount') from Addmoney where user_id = $user_id; --}}

              </table>
        </div>
        <div class="col-lg-4">
        <div class="card pd-20 bg-primary">
                      <div class="d-flex justify-content-between align-items-center mg-b-10">
                        <h6 class="tx-11 tx-uppercase mg-b-0 tx-spacing-1 tx-white">Pay Now</h6>
                        <a href="" class="tx-white-8 hover-white"><i class="icon ion-android-more-horizontal"></i></a>
                      </div><!-- card-header -->
                      <div class="d-flex align-items-center justify-content-between">
                        @if (Auth::user()->type == 91)
                        
                        <h5 style="color:#F6F6F6" class="tx-18">Cash :Kindly ,contact the owner</h5>
                        

                        
                         @endif

                        
                      </div><!-- card-body -->
                      <div class="d-flex align-items-center justify-content-between">
                        @if (Auth::user()->type == 91)
                        
                        
                        <h5 style="color:#F6F6F6" class="tx-18">SSL Ecommerz : <a href="{{url('/example2')}}" class="btn btn-success">Cleck Here</a></h5>

                        
                         @endif

                        
                      </div><!-- card-body -->
                      <div class="d-flex align-items-center justify-content-between mg-t-15 bd-t bd-white-2 pd-t-10">
                        <div>

                        </div>
                        <div>

                        </div>
                      </div><!-- -->
                    </div><!-- card -->
        </div>
    </div>
</div>
