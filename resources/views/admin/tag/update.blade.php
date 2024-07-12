@extends('admin.layouts.app')

@section('title')
    Update Tag
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-8">
                        <div class="main-card mb-3 card">
                            <div class="card-body">
                                <h5 class="card-title">Tag Update</h5>
                                <form class="" id="update_categories">
                                    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
                                    <div class="position-relative form-group">
                                        <label for="exampleEmail" class="">Name</label>
                                        <input name="name" value="{{ $tag->name }}" id="emp_name" placeholder="Enter categories Name" type="text"
                                            class="form-control">
                                            <input name="id" value="{{ $tag->id }}" id="id" placeholder="Enter Your Name" type="hidden"
                                            class="form-control">
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
   $("#update_categories").submit( function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            type: 'POST',
            url: '{{ route("admin.task.tag.update") }}',
            data: formData,
            dataType:'json',
            contentType: false,
            processData: false,
            success: (data) => {
                if(data.success==true){
                    alert(data.message)
                }else{
                    alert(data.message)
                }
            }
        })

    })
       
    </script>
@endsection