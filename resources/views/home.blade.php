@extends('layouts.starlight')

@section('content')
@include('layouts.nav')
 <!-- ########## START: MAIN PANEL ########## -->
 <div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
      <a class="breadcrumb-item" href="{{ url('/dashboard') }}">Dashboard</a>

    </nav>

    <div class="sl-pagebody">
      <div class="sl-page-title">
        {{-- $_SESSION["type"] == 22; --}}
        @if (Auth::user()->role == 22)
            @include('admin.parts.managerdashboard')
        {{-- $_SESSION["type"] == 33; --}}
        @elseif(Auth::user()->role == 33)
           @include('admin.parts.admindashboard')
        {{-- $_SESSION["type"] == 11; --}}
        @elseif(Auth::user()->role == 11)
            @include('admin.parts.generaldashboard')
        @endif
      </div><!-- sl-page-title -->

    </div><!-- sl-pagebody -->
  </div><!-- sl-mainpanel -->
  <!-- ########## END: MAIN PANEL ########## -->


@endsection
