<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="">
                <div class="card-header"><h4>Welcome,{{Auth::user()->company}}</h4>
                    {{-- $_SESSION['COMPANY'] --}}
                <div class="alert alert-success">
                    <h3>Total User = {{ $total_userbym }}</h3>
                </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('delsuccess'))
                        <div class="alert alert-success" role="alert">
                            {{ session('delsuccess') }}
                        </div>
                    @endif

                    {{-- @foreach ($cars as $car)
                        <p>{{ $loop->index+1 }}{{ $car }}</p>

                    @endforeach --}}
                    {{-- {{ $users }} --}}

                    <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Create At</th>
                            <th>Action</th>
                        </tr>
                        @foreach ($usersbym as $index=>$user_info)
                        <tr>
                            <td>{{ $loop->index+1 }}</td>
                            {{-- <td>{{ $users->firstitem()+$index }}</td> --}}
                            <td>{{ $user_info->name }}</td>
                            <td>{{ $user_info->email }}</td>
                            <td>{{ $user_info->created_at->format('d-m-y h:i:s A') }}</td>
                            <td>
                                <a href="{{url('/user/delete')}}/{{ $user_info->id }}" class="btn btn-danger">Delete</a>
                                {{-- <a href="{{url('/mail/send')}}/{{$user_info->id}}" class="btn btn-info">SendMail</a> --}}
                            </td>
                        </tr>
                        @endforeach
                        {{-- <td>{{ $loop->index+1 }}</td>

                        <td>{{ $user_info['name'] }}</td>
                        <td>{{ $user_info['email'] }}</td>
                        <td>{{ $user_info->created_at->format('d-m-y h:i:s A') }}</td> --}}

                      </table>
                      {{-- $_SESSION["type"] == 91 --}}
                      @if (Auth::user()->type == 92)
                      <div class="card-header"><h4>Customer Request</h4>
                        @if (session('requestdelsuccess'))
                        <div class="alert alert-success" role="alert">
                            {{ session('requestdelsuccess') }}
                        </div>
                        @endif
                        </div>
                      <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Customer Name</th>
                            <th>Package Name</th>
                            <th>Customer Email</th>
                            <th>Customer phone
                            </th>
                            <th>Customer Address
                            </th>
                            <th>Action
                            </th>
                        </tr>
                        @forelse ($order_requests as $order_request)
                        <tr>

                            @php
                                 $order_company = App\Models\Package::find($order_request->package_id)->company;

                            @endphp
                            @if ($order_company == $user_company)
                                 <td>{{ $loop->index }}</td>
                                 <td>{{ $order_request->customer_name }}</td>
                                 <td>{{ App\Models\Package::find($order_request->package_id)->package_name }}</td>
                                 <td>{{ $order_request->customer_email }}</td>
                                 <td>{{ $order_request->customer_phone }}</td>
                                 <td>{{ $order_request->location }}</td>
                                 <td>
                                    <a href="{{url('/request/delete')}}/{{ $order_request->id }}" class="btn btn-danger">Delete</a>
                                </td>
                            @endif
                        </tr>
                                 {{-- <td>{{ $order_request['customer_name'] }}</td>
                                 <td>{{ $order_request['customer_email'] }}</td>
                                 <td>{{ $order_request['customer_phone'] }}</td>
                                 <td>{{ $order_request['location'] }}</td> --}}
                        @empty
                        <tr ><td></td><td></td><td class="text-center">No Data Available</td><td></td></tr>
                        @endforelse

                      </table>
                      @endif
                      {{-- {{ $users->links() }} --}}
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Add General Mamber</h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('/user/insertbymanager') }}" method="post">
                        @csrf
                        <div class="from-group">
                            <label for="" class="form-label-control">User Name:</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="from-group">
                            <label for="" class="form-label-control">Email:</label>
                            <input type="email" class="form-control" name="email" required>
                        </div>
                        <div class="from-group">
                            <label for="" class="form-label-control">Phone Number:</label>
                            <input type="phone" class="form-control" name="phone" required>
                        </div>
                        <div class="from-group">
                            <label for="" class="form-label-control">Password:</label>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <div class="from-group">
                            <label for="" class="form-label-control">Role</label>
                            <select name='role' class="form-control" required>
                                <option value="">-- Select Role --</option>
                                <option value="33">Manager</option>
                                <option value="11">General Mamber</option>
                            </select>
                        </div>
                        @if (Auth::user()->role == 22 && Auth::user()->type == 91)

                        <div class="from-group">
                            <label for="" class="form-label-control">package Name</label>
                            <select name='package_id' class="form-control" required>
                                <option value="">-- Select Package --</option>
                                @foreach ($our_package as $value)
                                <option value="{{ $value->id }}" >{{ $value->package_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        @endif

                        <div class="from-group">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
