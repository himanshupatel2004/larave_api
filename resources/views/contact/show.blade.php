<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=0">
    <title>Contact Details Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"   >
</head>

<body>
    <div class="container">
        @include('error_message')

        <div class="card" style="width:400px">
            <div class="card-body">
                <h4 class="card-title">{{ $contact->first_name.' '.$contact->last_name}}</h4>
                <p class="card-text">Phone Number : {{ $contact->phone}}</p>
                <a href="{{ url('contact/delete/'.$contact->id) }}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</body>

</html>


