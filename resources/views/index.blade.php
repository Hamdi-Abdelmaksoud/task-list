@extends('layouts.app')
@section('title','The list of tasks')
@section('content')
<nav class="mb-4">
    <a href="{{route('tasks.create')}}" class="link">Add Task !</a>
</nav>
<div>
    @foreach ($tasks as $task )
    <div><a href="{{route('tasks.show',['task'=>$task->id])}}" @class(['line-through'=>$task->completed])>{{$task->title}}</a></div>
    {{-- line through if task completed   @class(['font-bold','line-through'=>$task->completed])--}}
    @endforeach
</div>
@if ($tasks->count())
<nav class="mt-4">{{$tasks->links()}}</nav>
{{-- pagination --}}

@endif
@endsection
