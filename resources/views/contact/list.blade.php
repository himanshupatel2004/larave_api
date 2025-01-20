
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>Contact List</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>

<body>
    <div class="container mt-2">
        @include('error_message')
        <div class="row">
            <div class="col-6">
                <a href="{{ url('/home') }}" class="btn btn-danger">Home</a>
                <a href="{{ url('contact/create') }}" class="btn btn-primary">Add Contact</a>
                <a href="{{ url('logout') }}" class="btn btn-danger">Logout</a>
            </div>
            <div class="col-6">
                <form action="{{ url('contact/list') }}" class="row">
                    <div class="col-10">
                        <input type="text" name="search" placeholder="Search Here" class="form-control"
                            value="{{ $search }}">
                    </div>
                    <div class="col-2">
                        <button class="btn btn-success" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>


        <table class="table table-striped">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $key=>$contact)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $contact->first_name. ' '. $contact->last_name }}</td>
                    <td>{{ $contact->phone }}</td>
                    <td>
                        <a href="{{ url('contact/show/'.$contact->id) }}" class="btn btn-sm btn-success"><i class="fa fa-eye"></i></a>
                        <a href="{{ url('contact/edit/'.$contact->id) }}" class="btn btn-sm btn-danger"><i class="fa fa-edit"></i></a>
                        <a href="{{ url('contact/delete/'.$contact->id) }}" class="btn btn-sm btn-primary"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{-- {{ $contacts->links() }} --}}
        {!! $contacts->appends(['search' => $search])->links() !!}
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
</body>

</html>
