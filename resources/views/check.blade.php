@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/addmeal') }}">Add Meal</a>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                        </div>
                        <div class="card-body">

                            <h4>Add {{ App\Models\User::find($user_id)->name }} Meal</h4>
                         <h4>Total Meal:{{ $total_meal }}</h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="row"><div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                            </div>
                            <div class="card-body">
                                @for ($x = 01; $x <=15 ; $x++)
                                <form action="{{ url('/bymanager/addmeal') }}" method="POST">
                                    @csrf
                                    <div class="form-group row">

                                        <div class="col-lg-3">
                                            <label for="" class="form-label-control" > {{ $x }}-{{ $monthName }}-{{ now()->year }} </label>
                                            <input name="user_id" type="hidden" class="visually-hidden" id="ex1" value="{{ $user_id }}" required >
                                            <input name="currentdate" type="hidden" class="visually-hidden" id="ex1" value="{{ $x }}-{{ $monthName }}-{{ now()->year }}" required >
                                        </div>
                                        @php
                                        $date_check = $x."-".$monthName."-".now()->year;
                                        $db_dates = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $db_dates_lunch = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);

                                        @endphp

                                        @foreach ($db_dates as $db_date)
                                               @if ($date_check == $db_date->date )
                                               <div class="col-lg-3">
                                                   <input name="lunch" class="form-control" id="ex1"  value="{{ $db_date->lunch }}" type=number  min="0" step='.5' required>
                                               </div>
                                               <div class="col-lg-3">
                                                <input name="dinner" class="form-control" id="ex1"  placeholder="Dinner" value="{{ $db_date->dinner }}" type="number" min="0" step=".5" required>
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
                                        @php
                                        $date_check = $x."-".$monthName."-".now()->year;
                                        $db_dates = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
                                        $db_dates_lunch = App\Models\Addmeal::all()->where('user_id' ,'==',$user_id)->where('date', "==", $date_check);
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

                                        @endforeach --}}
                                            {{-- {{ $db_dates }} --}}
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
                    </div></div>
                </div>
            </div>

        </div>


    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
