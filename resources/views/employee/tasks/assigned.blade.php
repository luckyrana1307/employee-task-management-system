



    @extends('employee.layouts/app')

    @section('title')
        List of Tasks
    @endsection

    @section('content')
        <div class="app-main__outer">
            <div class="app-main__inner">
                <div class="container">

                    <div class="card">
                        <div class="card-header">
                            <h3>List of tasks</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="list_tasks" class="table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Task Title</th>
                                            <th>Description</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            
                                        </tr>
                                    </thead>
                                    @forelse($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title }}</td>
                                        <td>{{ $task->content }}</td>
                                        <td>{{ $task->date }}</td>
                                        <td>
                                            @if($task->status == 0)
                                            <form action="{{ route('employee.tasks.complete') }}" method="POST" id="updateStatusForm">
                                                @csrf
                                                <input type="hidden" name="task_id" value="{{ $task->id }}">
                                                <select name="status" id="status" class="form-control" onchange="submitForm()">
                                                    <option value="1" {{ $task->status == 1 ? 'selected' : '' }}>Completed</option>
                                                    <option value="0" {{ $task->status == 0 ? 'selected' : '' }}>Pending</option>
                                                </select>
                                            </form>
                                            @else
                                                Completed
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No tasks assigned.</td>
                                    </tr>
                                @endforelse
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
    function submitForm() {
    document.getElementById('updateStatusForm').submit();
}
</script>
@endsection