@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/sendmail') }}">Send Mail</a>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
            <div class="col-lg-12">
                    @if (session('delsuccess'))
                        <div class="alert alert-success" role="alert">
                            {{ session('delsuccess') }}
                        </div>
                    @endif
                    <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Customer Name</th>
                            <th>Total Lunch</th>
                            <th>Total Dinner</th>
                            <th>Total Meal</th>
                            <th>Package Name</th>
                            <th>package Price</th>
                            <th>Total Bill</th>
                            <th>Paid</th>
                            <th>Due</th>
                            <th>Deposit</th>
                            <th>Action</th>



                            
                        </tr>
                        @forelse ($users as $index=>$user)
                        <tr>
                        <td>{{ $loop->index+1 }}</td>
                            {{-- <td>{{ $users->firstitem()+$index }}</td> --}}
                            <td>{{ $user_name_list[$loop->index] }}</td>
                            <td>{{ $user_total_lunch[$loop->index] }}</td>
                            <td>{{ $user_total_dinner[$loop->index] }}</td>
                            <td>{{ $user_total_meal[$loop->index]}}</td>
                            <td>{{ $user_package_name[$loop->index]}}</td>
                            <td>{{ $user_package_price[$loop->index]}} Taka</td>
                            <td>{{ $user_package_price[$loop->index]*$user_total_meal[$loop->index]}} Taka</td>
                            <td>{{ $user_paid[$loop->index]}} Taka</td>
                            <td>{{ $user_due[$loop->index]}} Taka</td>
                            <td>{{ $user_deposit[$loop->index]}} Taka</td>
                            <td>
                                <a href="{{url('/sendmail/send')}}/{{ $user->id }}/{{$user_name_list[$loop->index]}}/{{$user_total_lunch[$loop->index]}}/{{$user_total_dinner[$loop->index]}}/{{$user_total_meal[$loop->index]}}/{{$user_package_name[$loop->index]}}/{{$user_package_price[$loop->index]}}/{{$user_due[$loop->index]}}/{{$user_paid[$loop->index]}}/{{$user_deposit[$loop->index]}}" class="btn btn-success">Mail</a>
                            </td>
                            
                            
                        </tr>
                        @empty
                        <tr ><td></td><td></td><td class="text-center">No Data Available</td><td></td></tr>
                        @endforelse

                      </table>


                </div>
                
            </div>
        </div>

    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
