<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>User Update</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="m-2"><strong>User Update form</strong></h2>
        <div>
            <form action=" {{ url('user/update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" name="id" value="{{ $user->id }}" hidden>
                    <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name"
                        value="{{ $user->name }}">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
                        value="{{ $user->email }}" readonly>
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="radio" name="gender" value="male" @if ($user->gender == 'male') {{ 'checked' }} @endif>
                    Male
                    <input type="radio" name="gender" value="female" @if ($user->gender == 'female') {{ 'checked' }}
                    @endif> Female
                </div>
                <div class="form-group">
                    <label for="hobby">Hobby:</label>
                    <input type="checkbox" name="hobby[]" value="reading" @if ($user->hobby == 'reading') {{ 'checked' }} @endif> Reading
                    <input type="checkbox" name="hobby[]" value="playing" @if ($user->hobby == 'playing') {{ 'checked' }} @endif> Playing
                    <input type="checkbox" name="hobby[]" value="travelling" @if ($user->hobby == 'travelling') {{ 'checked' }} @endif> Travelling
                </div>
                <div class="form-group">
                    <label for="phone"> Phone Number: </label>
                    <input type="number" id="phone" name="phone" class="form-control" value="{{ $user->phone }}"
                        placeholder="Enter Mobile No." />
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    {{-- <input type="file" class="form-control" name="image"> --}}
                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                </div>
                {{-- @if ($user->image)
                {!! $user->getImage() !!}
                @endif <br> --}}
                @if(!empty($user->image))
                @php
                // Attempt to decode the JSON into an array
                $images = json_decode($user->image, true);
                @endphp
                @if(is_array($images) && count($images) > 0)
                @foreach($images as $image)
                {{-- <img src="/images/1728649223289185.png" alt="" width="100px" height="50px"> --}}
                <img src="{{ asset($image) }}" alt="User Image" width="100" style="margin: 5px;">
                @endforeach
                @else
                <p>No valid images available</p>
                @endif
                @else
                <p>No images available</p>
                @endif <br>
                <button type="submit" class="btn btn-primary mt-2">Update</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
