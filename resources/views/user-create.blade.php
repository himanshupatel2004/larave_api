<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X UA- Compatible" content="ie=edge">
    <title>User Create</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <h2 class="m-2"><strong>User Create form</strong></h2>
        <div>
            <form action=" {{ url('user/store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                        placeholder="Enter Name" name="name" value="{{ old('name') }}">
                    @error('name')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                        placeholder="Enter email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                        placeholder="Enter password" name="password" value="{{ old('password') }}">
                    @error('password')
                    </div>
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="gender">Gender:</label>
                    <input type="radio" name="gender" value="male" checked> Male
                    <input type="radio" name="gender" value="female"> Female
                </div>
                <div class="form-group">
                    <label for="hobby">Hobby:</label>
                    <input type="checkbox" name="hobby[]" value="reading"> Reading
                    <input type="checkbox" name="hobby[]" value="playing"> Playing
                    <input type="checkbox" name="hobby[]" value="travelling"> Travelling
                </div>
                <div class="form-group">
                    <label for="phone"> Phone Number: </label>
                    <input type="number" id="phone" name="phone" value="{{ old('phone') }}"
                        class="form-control @error('phone') is-invalid @enderror" placeholder="Enter Mobile No." />
                    @error('phone')
                    {{-- <div class="alert alert-danger">Enter Your Phone No</div> --}}
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="image">Image:</label>
                    {{--  <input type="file" class="form-control" name="image">  --}}
                    <input type="file" class="form-control" name="images[]" id="images" multiple>
                </div>
                <div class="form-group">
                    <label for="address"> Address: </label>
                    <textarea name="address" id="address" class="form-control @error('address') is-invalid @enderror"
                        cols="30" rows="10" value="{{ old('address') }}"></textarea>
                    @error('address')
                    {{-- <div class=" alert alert-danger">Enter Your Address</div> --}}
                    <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Store</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
