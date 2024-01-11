@extends('layouts.app')
@section('title','The list of tasks')
@section('content')
<div>
    @foreach ($tasks as $task )
    <div><a href="{{route('tasks.show',['task'=>$task->id])}}">{{$task->title}}</a></div>
    @endforeach
</div>
@if ($tasks->count())
<nav>{{$tasks->links()}}</nav>//pagination

@endif
@endsection
