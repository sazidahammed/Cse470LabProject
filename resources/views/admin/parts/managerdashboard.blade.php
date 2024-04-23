<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="">
                <div class="card-header"><h4>Welcome,{{Auth::user()->company}}</h4>
                <div class="alert alert-success">
                    <h3>Total Users = {{ $total_user }}</h3>

                </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{-- {{ $users }} --}}
                    <table class="table table-success table-striped table-hover">
                        <tr>
                            <th>SL</th>
                            <th>Name</th>
                            <th>Company Name</th>
                            <th>Role</th>
                            <th>Email</th>
                            <th>Create At</th>
                        </tr>
                        @foreach ($users as $index=>$user_info)
                        <tr>
                            {{-- <td>{{ $loop->index+1 }}</td> --}}
                            <td>{{ $users->firstitem()+$index }}</td>
                            <td>{{ $user_info->name }}</td>
                            <td>{{ $user_info->company }}</td>
                            <td>@if ($user_info->role == 33)
                                Admin
                            @elseif($user_info->role == 22)
                                Manager
                            @elseif($user_info->role == 11)
                                General
                            @endif


                            </td>
                            <td>{{ $user_info->email }}</td>
                            <td>{{ $user_info->created_at->format('d-m-y h:i:s A') }}</td>
                        </tr>
                        @endforeach

                      </table>
                      
                      {{ $users->links() }}
                    {{-- {{ __('You are logged in!') }} --}}
                </div>
                
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Add Mamber</h3>
                </div>
                <div class="card-body">

                    <form action="{{ url('/user/insertbyadmin') }}" method="post">
                        @csrf
                        <div class="from-group">
                            <label for="" class="form-label-control">Company Name:</label>
                            <input type="text" class="form-control" name="company" required>
                        </div>
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
                                <option value="33">Admin</option>
                                <option value="22">Manager</option>
                            </select>
                        </div>
                        <div class="from-group">
                            <button type="submit" class="btn btn-primary">Add User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
