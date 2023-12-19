<h1>
    List of tasks
</h1>
<div>
    {{-- @if (count($tasks))zz --}}
    @foreach ($tasks as $task )
    <div>{{$task->title}}</div>
    @endforeach
    @else
    <div>there are no tasks</div>

    {{-- @endif --}}
</div>
