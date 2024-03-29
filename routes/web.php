<?php

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use GuzzleHttp\Promise\Create;
use App\Http\Requests\TaskRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


// class Task
// {
//   public function __construct(
//     public int $id,
//     public string $title,
//     public string $description,
//     public ?string $long_description,
//     public bool $completed,
//     public string $created_at,
//     public string $updated_at
//   ) {
//   }
// }

// $tasks = [
//   new Task(
//     1,
//     'Buy groceries',
//     'Task 1 description',
//     'Task 1 long description',
//     false,
//     '2023-03-01 12:00:00',
//     '2023-03-01 12:00:00'
//   ),
//   new Task(
//     2,
//     'Sell old stuff',
//     'Task 2 description',
//     null,
//     false,
//     '2023-03-02 12:00:00',
//     '2023-03-02 12:00:00'
//   ),
//   new Task(
//     3,
//     'Learn programming',
//     'Task 3 description',
//     'Task 3 long description',
//     true,
//     '2023-03-03 12:00:00',
//     '2023-03-03 12:00:00'
//   ),
//   new Task(
//     4,
//     'Take dogs for a walk',
//     'Task 4 description',
//     null,
//     false,
//     '2023-03-04 12:00:00',
//     '2023-03-04 12:00:00'
//   ),
// ];
Route::get('/', function () {
    return redirect()->route('tasks.index');
});
Route::get('/tasks', function (){
    return view('index',[
        // 'tasks'=> Task::all()//fetching all task
        'tasks'=> Task::latest()->paginate(10)
        //fetching all task sorted
        // 'tasks'=> Task::latest()->where('completed', true)->get()//fetching all completed tasks
    ]);
})->name('tasks.index');
// Route::get('/tasks/{id}', function ($id) use($tasks){
//     $task= collect($tasks)->firstWhere('id', $id);//convertir task en collection
//     if(!$task){
//      abort(Response::HTTP_NOT_FOUND);
//     }
//remove use($tasks) array because we will use yasks in db
Route::view('/tasks/create', 'create')->name('tasks.create');
Route::get('/tasks/{task}/edit', function (Task $task) {
return view('edit',['task'=> $task]);
})->name('tasks.edit');
Route::get('/tasks/{task}', function (Task $task) {
// return view('show',['task'=> \App\Models\Task::findOrFail($id)]);
//fetching task by id from data using find method  or findOrFail to generate 404 error page
return view('show',
['task'=>$task]);//automaticly fetching
})->name('tasks.show');
Route::put('/tasks/{task}', function (Task $task,TaskRequest $request) {
// $data = $request->validate([
//     // validation rules
//     'title'=> 'required|max:255',
//     'description'=>'required',
//     'long_description'=> 'required'
// ]);
// $data= $request->validated();
// $task->title = $data['title'];
// $task->description= $data['description'];
// $task->long_description= $data['long_description'];
// $task->save();
$task->update($request->validated());
return redirect()->route('tasks.show',['task'=>$task])
->with('success','Task updated successfully!');
})->name('tasks.update');
Route::delete('tasks/{task}', function (Task $task) {
$task->delete();
return redirect()->route('tasks.index')
->with('success','Task deleted successfully! ');
})->name('tasks.destroy');
Route::put('tasks/{task}/toogle-complete', function (Task $task) {
// $task->completed =!$task->completed;//toogle a=-a
// $task->save();
$task->toggleComplete();//function in task.php
return redirect()->back()->with('success','Task updated successfully!');
})->name('tasks.toggle-complete');
Route::post('/tasks', function (TaskRequest $request) {
// dd($request->all()); to fetch data dans request
// $data = $request->validate([
//     // validation rules
//     'title'=> 'required|max:255',
//     'description'=>'required',
//     'long_description'=> 'required'
// ]);
// php artisan make:request TaskRequest & contain the ruels
//affecter les données du formulaire à un nouveau ob
// $data=$request->validated();
// $task= new Task;
// $task->title = $data['title'];
// $task->description= $data['description'];
// $task->long_description= $data['long_description'];
// //insert query
// $task->save();
$task= Task::create($request->validated());//to do that should modify model $fillable
return redirect()->route('tasks.show',['task'=>$task->id])
->with('success','Task created successfully!');
})->name('tasks.store');
Route::fallback(function () {
return 'not found';
});
