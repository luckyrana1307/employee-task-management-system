@extends('admin.layouts.app')

@section('title')
    List of tag
@endsection

@section('content')
    <div class="app-main__outer">
        <div class="app-main__inner">
            <div class="container">
                
                    <div class="card">
                        <div class="card-header">
                            <h3>List of tag</h3>
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
                                    @foreach ($tags as $tag)
                                        <tr>
                                            <td>{{ $tag->id }}</td>
                                            <td>{{ $tag->name }}</td>
                                            <td><button class="btn btn-danger" id="delete-categories"
                                                    data-id='{{ $tag->id }}'>Delete</button>

                                                    <a href="{{ route('admin.task.tag.edit', ['id'=>$tag->id]) }}" class="btn btn-primary" 
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
                    url: "{{ route('admin.task.tag.delete' )}}",
                    data: {
                        id,
                        "_token":"{{ csrf_token() }}"
                    },
                    dataType: 'json',
                    success: (data) => {
                        if(data.success == true){
                            alert(data.message);
                            window.location.href="{{ route('admin.task.tag.list' )}}"
                        }else{
                            alert(data.message);

                        }
                    }
                })
            }
        })
    </script>
@endsection