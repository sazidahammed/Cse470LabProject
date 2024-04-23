@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/addmoney') }}">Add Money</a>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>Create At</th>
                        </tr>
                        @forelse ($mambers as $index=>$mamber)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            {{-- <td>{{ $mambers->firstitem()+$index }}</td> --}}
                            <td>{{ $member_name_list[$loop->index] }}</td>
                            <td>{{ $mamber->amount }}</td>
                            <td>{{ $mamber->created_at->format('d-m-y h:i:s A') }}</td>
                        </tr>
                        @empty
                        <tr ><td></td><td></td><td class="text-center">No Data Available</td><td></td></tr>
                        @endforelse

                      </table>
                      
                      {{-- {{ $categories }} --}}
                      <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>

                            <th>Total Amount</th>

                        </tr>
                        
                        @foreach ($categories as $index=>$category)
                        @php
                            
                            $value = $value_list[$loop->index];
                            

                        @endphp
                        

                        @if ($value  != NUll)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{ $category_name_list[$loop->index] }}</td>
                            
                            <td>{{ $sum_list[$loop->index]}}</td>
                        </tr>
                         
                        @endif
                        @endforeach
                        <tr>
                            <td></td>
                            <td><h5>TOTAL:</h5></td>
                            <td>{{ $total }}</td>
                        </tr>
                        
                      </table>


                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Money</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{ url('/addmoney/insert') }}" method="POST">
                                @csrf
                                <div class="from-group">
                                    <label for="" class="form-label-control">General Mamber Name:</label>
                                    <select name='user_id' class="form-control" required>
                                        <option value="">-- Select member --</option>
                                        @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{$user->name}}</option>
                                        @endforeach


                                    </select>
                                </div>
                                <input name="month" type="hidden" class="visually-hidden" id="ex1" value="{{ $monthnumber }}" required >
                                <div class="from-group">
                                    <label for="" class="form-label-control">Amount</label>
                                    <input type="number" class="form-control" name="amount" required>
                                </div>
                                <div class="from-group">
                                    <button type="submit" class="btn btn-primary">Add Money</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- sl-pagebody -->
</div><!-- sl-mainpanel -->

@endsection
