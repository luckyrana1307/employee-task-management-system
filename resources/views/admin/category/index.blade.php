@extends('admin.layouts.app')

@section('title')
    List of Department
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                
                    <div class="card">
                        <div class="card-header">
                            <h3>List of categories</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list_categories" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Name</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach ($category as $categor)
                                        <tr>
                                            <td>{{ $categor->id }}</td>
                                            <td>{{ $categor->name }}</td>
                                            <td><button class="btn btn-danger" id="delete-categories"
                                                    data-id='{{ $categor->id }}'>Delete</button>
                                                    <a href="{{ route('admin.task.categories.edit', ['id'=>$categor->id]) }}" class="btn btn-primary" 
                                                    >Edit</a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
@endsection
@section('footer')
    <script>
        $(document).ready(function() {
            $('#list_categories').DataTable();
        });

        $(document).on('click', '#delete-categories', function(e) {
            e.preventDefault();

            const id = $(this).data('id');
            if (id != "") {
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.task.categories.delete' )}}",
                    data: {
                        id,
                        "_token":"{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: (data) => {
                        if(data.success == true){
                            alert(data.message);
                            window.location.href="{{ route('admin.task.categories.list' )}}"
                        }else{
                            alert(data.message);

                        }
                    }
                })
            }
        })
    </script>
@endsection