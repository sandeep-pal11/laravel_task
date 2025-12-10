<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-light">

<div class="container mt-4">
    <h3 class="text-center mb-4">My Profile</h3>

    <div class="row">
        <!-- Left Profile Info -->
        <div class="col-md-4 text-center">
            <div class="card p-3 shadow">

                @if($user->profile_img)
                    <img src="{{ asset('storage/profile/'.$user->profile_img) }}"
                         class="rounded-circle" width="120" height="120">
                @else
                    <img src="https://via.placeholder.com/120"
                         class="rounded-circle">
                @endif

                <h5 class="mt-3">{{ $user->first_name }} {{ $user->last_name }}</h5>
                <p>{{ $user->email }}</p>
                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mt-2">Logout</a>
            </div>
        </div>

        <!-- Right Edit Form -->
        <div class="col-md-8">
            <div class="card p-4 shadow">
                <h5>Update Profile</h5>
                <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-2">
                            <label>First Name</label>
                            <input type="text" name="first_name" class="form-control" value="{{ $user->first_name }}" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Last Name</label>
                            <input type="text" name="last_name" class="form-control" value="{{ $user->last_name }}" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Phone</label>
                            <input type="text" name="phone_number" class="form-control" value="{{ $user->phone_number }}" required>
                        </div>

                        <div class="col-md-6 mb-2">
                            <label>Email (Read Only)</label>
                            <input type="email" class="form-control" value="{{ $user->email }}" disabled>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label>Country</label>
                            <select name="country_id" id="country" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($countries as $country)
                                    <option value="{{$country->id}}"
                                        {{ $user->country_id == $country->id ? 'selected' : ''}}>
                                        {{$country->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-2">
                            <label>State</label>
                            <select name="state_id" id="state" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($states as $state)
                                    <option value="{{$state->id}}"
                                        {{ $user->state_id == $state->id ? 'selected' : ''}}>
                                        {{$state->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>City</label>
                            <select name="city_id" id="city" class="form-control" required>
                                <option value="">Select</option>
                                @foreach ($cities as $city)
                                    <option value="{{$city->id}}"
                                        {{ $user->city_id == $city->id ? 'selected' : ''}}>
                                        {{$city->name}}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label>Profile Image</label>
                            <input type="file" name="profile_img" class="form-control">
                        </div>
                    </div>

                    <button class="btn btn-primary w-100">Save Changes</button>
                </form>
            </div>

            <div class="card p-4 shadow mt-4">
                <h5>Change Password</h5>
                <form action="{{ route('customer.password.update') }}" method="POST">
                    @csrf

                    <input type="password" name="current_password" class="form-control mb-2" placeholder="Current Password" required>
                    <input type="password" name="password" class="form-control mb-2" placeholder="New Password" required>
                    <input type="password" name="password_confirmation" class="form-control mb-3" placeholder="Confirm Password" required>

                    <button class="btn btn-warning w-100">Update Password</button>
                </form>
            </div>

        </div>
    </div>
</div>

<!-- SWEET ALERT -->
@if(session('success'))
<script>
Swal.fire({
    icon: 'success',
    title: "{{ session('success') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

@if(session('error'))
<script>
Swal.fire({
    icon: 'error',
    title: "{{ session('error') }}",
    timer: 2000,
    showConfirmButton: false
});
</script>
@endif

</body>
</html>
