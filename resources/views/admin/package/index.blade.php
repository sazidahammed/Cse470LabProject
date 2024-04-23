@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/package') }}">Package</a>
    </nav>

    <div class="sl-pagebody">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    @if (session('delsuccess'))
                        <div class="alert alert-success" role="alert">
                            {{ session('delsuccess') }}
                        </div>
                    @endif
                    <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Package Name</th>
                            <th>Package Description</th>
                            <th>Package Price</th>
                            <th>Photo</th>
                            <th>Action</th>
                           

                        </tr>
                        @forelse ($packages as $package)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            <td>{{  $package->package_name }}</td>
                            <td>{{  $package->package_des }}</td>
                            <td>{{  $package->package_price }}</td>
                            <td>
                                <img width="50" src="{{ asset('uploads/package') }}/{{ $package->package_img }}" alt="{{ $package->package_img }}">
                            </td>
                            <td>
                                <a href="{{url('/package/delete')}}/{{ $package->id }}" class="btn btn-danger">Delete</a>
                            </td>
                            

                        </tr>
                        @empty
                        <tr ><td></td><td></td><td class="text-center">No Data Available</td><td></td></tr>
                        @endforelse

                      </table>


                </div>
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header">
                            <h3>Add Package</h3>
                        </div>
                        <div class="card-body">
                            @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                            @endif
                            <form action="{{ url('/addpackage') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label for="" class="form-label-control">Package Name</label>
                                    <input type="" class="form-control" name="package_name" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Package Description</label>
                                    <input type="text" class="form-control" name="package_des" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Package Price</label>
                                    <input type="text" class="form-control" name="package_price" required>
                                </div>
                                <div class="form-group">
                                    <label for="" class="form-label-control">Package Image</label>
                                    <input type="file" class="form-control" name="package_img" required>
                                </div>
                                <input name="month" type="hidden" class="visually-hidden" id="ex1" value="{{ $monthnumber }}" required >

                                <div class="from-group">
                                    <button type="submit" class="btn btn-primary">Add Package</button>
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
