<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>Contact Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="m-2"><strong>Contact Update form</strong></h2>
        <div>
            <form action=" {{ url('contact/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="first_name">First Name:</label>
                    <input type="text" class="form-control" name="id" value="{{ $contact->id }}" hidden>
                    <input type="text" class="form-control" id="first_name" placeholder="Enter First Name" name="first_name"
                        value="{{ $contact->first_name }}">
                </div>
                <div class="form-group">
                    <label for="last_name">Last Name:</label>
                    <input type="text" class="form-control" name="id" value="{{ $contact->id }}" hidden>
                    <input type="text" class="form-control" id="last_name" placeholder="Enter Last Name" name="last_name"
                        value="{{ $contact->last_name }}">
                </div>
                <div class="form-group">
                    <label for="phone"> Phone Number: </label>
                    <input type="number" id="phone" name="phone" class="form-control" value="{{ $contact->phone }}"
                        placeholder="Enter Mobile No." />
                </div>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
