@php

@endphp


<div class="container">
    {{-- <div class="row">
        <div class="col-lg-12">
            <div class="row"><div class="col-lg-6">
                <div class="card">
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        @for ($x = 01; $x <=15 ; $x++)

                        <form action="{{ url('/general/addmeal') }}" method="POST">
                            @csrf
                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>
                                    <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $x }}-{{ $monthName }}-{{ now()->year }}" >
                                </div>
                                @php
                                    $date_check = $x."-".$monthName."-".now()->year;
                                    $db_dates = App\Models\Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check);
                                    $db_dates_lunch = App\Models\Addmeal::all()->where('user_id' ,'==',Auth::user()->id)->where('date', "==", $date_check);

                                @endphp

                                @foreach ($db_dates as $db_date)
                                       @if ($date_check == $db_date->date )
                                       <div class="col-lg-3">
                                           <input name="lunch" class="form-control" id="ex1"  value="{{ $db_date->lunch }}" type=number  min="0" step='.5'>
                                       </div>
                                       <div class="col-lg-3">
                                        <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" value="{{ $db_date->dinner }}" type="number" min="0" step=".5">
                                        </div>

                                       @endif

                                @endforeach
                                {{-- @foreach ($db_dates as $db_date)
                                       @if ($date_check != $db_date->date )


                                       @endif

                                @endforeach

                                    @if (count($db_dates) == 0)
                                    <div class="col-lg-3">
                                        <input name="lunch" placeholder="lunch" class="form-control" id="ex1"  type="number" min="0" step='.5'>
                                    </div>
                                    <div class="col-lg-3">
                                        <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" type="number" min="0" step=".5">
                                    </div>
                                    @endif
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
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
                    <div class="card-header">

                    </div>
                    <div class="card-body">
                        @for ($x = 16; $x <= 30; $x++)

                        <form action="{{ url('/general/addmeal') }}" method="POST">
                            @csrf
                            <div class="form-group row">

                                <div class="col-lg-3">
                                    <label for="" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>
                                    <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $x }}-{{ $monthName }}-{{ now()->year }}" >
                                </div>
                                <div class="col-lg-3">
                                    <input name="lunch" class="form-control" id="ex1" placeholder="Lunch" type="number" min="0" step='.5'>
                                </div>
                                <div class="col-lg-3">
                                    <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" type="number" min="0" step=".5">
                                </div>
                                <div class="col-lg-3">
                                    <button type="submit" class="btn btn-primary">Confirm</button>
                                </div>


                            </div>
                            <div class="form-group ">

                            </div>
                        </form>

                        @endfor
                    </div>
                </div>
            </div></div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-lg-9">
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
    </div>
</div>
