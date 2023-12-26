@extends('layouts.app')
@section('title','The list of tasks')
@section('content')
<div>
    @foreach ($tasks as $task )
    <div><a href="{{route('tasks.show',['id'=>$task->id])}}">{{$task->title}}</a></div>
    @endforeach
</div>
@endsection
