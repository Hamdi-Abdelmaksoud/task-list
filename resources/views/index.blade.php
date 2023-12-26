<h1>
    List of tasks
</h1>
<div>
    @foreach ($tasks as $task )
    <div><a href="{{route('tasks.show',['id'])}}">{{$task->title}}</a></div>
    @endforeach

</div>
