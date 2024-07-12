@extends('admin.layouts.app')

@section('title')
    Update Profile
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Update Profile</h5>
                                <form id="update_admin_profile">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <div class="position-relative form-group">
                                        <label for="name" class="">Name</label>
                                        <input name="name" value="{{ Auth::guard('admin')->user()->name }}" id="emp_name" placeholder="Enter Name" type="text" class="form-control">
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="email" class="">Email</label>
                                        <input name="email" id="emp_email" value="{{ Auth::guard('admin')->user()->email }}" placeholder="Enter Email" type="email" class="form-control">
                                    </div>
                                    <div class="position-relative form-group">
                                        <label for="phone" class="">Phone Number</label>
                                        <input name="phone" id="emp_phone" value="{{ Auth::guard('admin')->user()->phone }}" placeholder="Enter Phone Number" type="text" class="form-control">
                                    </div>
                                    <button type="submit" class="mt-1 btn btn-primary">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <script>
        $("#update_admin_profile").submit(function (e) {
            e.preventDefault();
            const formData = new FormData(this);

            $.ajax({
                type: 'POST',
                url: '{{ route("admin.admin.store.profile") }}', // Fixed the route URL
                data: formData,
                dataType: 'json',
                contentType: false,
                processData: false,
                success: (data) => {
                    if (data.success) {
                        data.message.forEach(val => {
                            alert(val);
                        });
                    } else {
                        data.message.forEach(val => {
                            alert(val);
                        });
                    }
                },
                error: (xhr, status, error) => {
                    alert("An error occurred: " + xhr.responseText);
                }
            });
        });
    </script>
@endsection
