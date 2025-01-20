<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>User List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="container">
        @include('error_message')
        <div class="row">
            <div class="col-6">
                <a href="{{ url('user/create') }}" class="btn btn-sm btn-primary mt-2">Add User</a>
                <a href="{{ url('logout') }}" class="btn btn-sm btn-danger mt-2">Logout</a>
            </div>
            <div class="col-6">
                <form action="{{ url('user/list') }}" class="row">
                    <div class="col-10">
                        <input type="text" name="search" placeholder="Search Here" class="form-control mt-2"
                            value="{{ $search }}">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success mt-2" type="submit">Search</button>
                    </div>
                </form>

            </div>
        </div>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Hobby</th>
                    <th>Image</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($users as $key=>$user)
                <tr class="@if($user->id == Auth::id()) {{ 'table-warning' }}
                    @endif">
                    <td>{{ $key+1 }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->gender }}</td>
                    <td>
                        @if (isset($user->phone))
                        {{ $user->phone }}
                        @else
                        {{ '__________' }}
                        @endif
                    </td>

                    <td>{{ $user->address }}</td>
                    <td>{{ $user->hobby }}</td>
                    {{-- <td> --}}
                        {{-- @if($user->image) --}}
                        {{-- <img src="{{ asset('image/'.$user->image) }}" alt="" height="80px" width="150px"> --}}
                        {{-- <img src="{{ asset($user->image) }}" alt="" height="80px" width="150px"> --}}
                        {{-- @endif --}}

                        {{-- {!! $user->getImage() !!} --}}
                        {{-- </td> --}}
                    <td>
                        @if(!empty($user->image))
                        @php
                        // Attempt to decode the JSON into an array
                        $images = json_decode($user->image, true);
                        @endphp
                        @if(is_array($images) && count($images) > 0)
                        @foreach($images as $image)
                        <img src="{{ asset($image) }}" alt="User Image" width="50" style="margin: 5px;">
                        @endforeach
                        @else
                        <p>No valid images available</p>
                        @endif
                        @else
                        <p>No images available</p>
                        @endif
                    </td>

                    <td>{{ $user->status }}</td>
                    <td>
                        <a href="{{ url('user/show/'.$user->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('user/edit/'.$user->id) }}" class="btn btn-sm btn-danger"><i
                                class="fa fa-edit"></i></a>
                        <a href="{{ url('user/delete/'.$user->id) }}" class="btn btn-sm btn-primary"><i
                                class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {!! $users->appends(['search' => $search])->links() !!}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>
