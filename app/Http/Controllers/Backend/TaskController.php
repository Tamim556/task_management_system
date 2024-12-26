<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Models\TaskImage;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;


class TaskController extends Controller
{
    //

    public function allTaskget(){


        $tasks = Task::orderBy('id', 'desc')->get();


        if ($tasks->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'message' => 'tasks get successfully',
                'data' => $tasks
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No tasks found',
            ]);
        }



    }
    public function singleTask($id){
        $task = Task::where('id', $id)->first();
        if ($task) {
            return response()->json([
                'status' => true,
                'message' => 'task get successfully',
                'data' => $task
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'No task found',
            ]);
        }



    }


    public function show($task){

        $task = Task::where('id' , $task)->first();

        return view('backend.task.view' , compact('task'));

    }

    public function search(Request $request){


        $tasks = task::orderBY('id' , 'desc')
        ->when(!empty($request->date), function ($query) use ($request) {
            $query->where('due_date', $request->date);
        })
        ->when(!empty($request->status), function ($query) use ($request) {
            $query->where('status', $request->status);
        })->paginate(20);


        return view('backend.task.index' , compact('tasks'));

    }

    public function index(){

        $tasks = Task::orderby('id', 'desc')->paginate(12);
        return view('backend.task.index' , compact('tasks'));
    }

    public function create(){

        return(view('backend.task.create'));
    }



    public function store(Request $request){


        // dd($request->toArray());

            $validator = Validator::make($request->all(),[
                'title' => 'required',
                'task_body' => 'required',
                'status' => 'required',    
                'due_date' => 'required',    

    
            ]);
    
            if ($validator->fails())
            {
                return response()->json(['status'=>false,'error'=>$validator->errors()]);
            }

        try{
                $task = new Task();
                $task->title = $request->title;
                $task->status = $request->status;
                $task->created_by = Auth::user()->id;

                $task->due_date = $request->due_date;

                $task->task_body = $request->task_body;
                $task->image = $request->main_image;

                $task->save();

                return response()->json([
                    'status'=>true,
                    'message'=>'task added Successfully!',
                    'data' =>$task]);


            }

          

        catch (QueryException $e) {
            dd('hi', $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }

    }

    public function edit($task){

        $task = Task::where('id' , $task)->first();


        return view('backend.task.edit' , compact('task'));


    }

    public function update(Request $request){

        // dd($request->toArray());
        $validator = Validator::make($request->all(),[
            'title' => 'required',
                'task_body' => 'required',
                'status' => 'required', 
                'due_date' => 'required',    
   

        ]);

        if ($validator->fails())
        {
            return response()->json(['status'=>false,'error'=>$validator->errors()]);
        }

        try{

            $task= task::where('id' , $request->task_id)->first();
    
            $task->created_by = Auth::user()->id;

            $task->title = $request->title;
            $task->status = $request->status;
            $task->task_body = $request->task_body;
            $task->image = $request->main_image;
            $task->due_date = $request->due_date;



            $task->update();

       

            return response()->json([
                'status'=>true,
                'message'=>'task update Successfully!',
                'data' =>$task]);

    
        }
    
        catch (QueryException $e) {
            dd('hi', $e->getMessage());
            return redirect()->back()->withInput()->withErrors($e->getMessage());
        }



    }

    public function delete($task){     

        $task= Task::where('id', $task)->firstOrFail();

        $task->delete();
        return redirect()->back();
    }

    public function uploadImage(Request $request){


        $validator = Validator::make($request->all(),[
            // 'image' => 'required|mimes:jpg,jpeg,png,bmp,webp |max:6000',

            'image' => 'required|image|max:5000', 

        ]);

        if ($validator->fails())
        {
            return response()->json(['status'=>false,'error'=>$validator->errors()]);
        }


        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = $image->getClientOriginalName();


            $task_image = new TaskImage();
            $fileName = $this->processAndSaveImage($image);
            $task_image->name = $fileName;
            $task_image->original_name = $imageName;

            $task_image->save();


        } 


        return response()->json(['status'=>true,'message'=>'added Successfully']);




    }

    private function processAndSaveImage($file) {
        $fileName = rand(1234, 9999) . '_' . time() . '.webp';
        $image = Image::make($file);

        // $image->resize(550, 550);
        $desiredFileSizeKB = 100; 
        $quality = 90; 
        $maxIterations = 15; 
        $iteration = 0;
        do {
            ob_start();
            $image->encode('webp', $quality); 
            $content = ob_get_clean();
            $currentFileSizeKB = strlen($content) / 1024; // Current file size in KB
            
            if ($currentFileSizeKB > $desiredFileSizeKB) {
                $quality -= 10; // Reduce quality by 10
            } else {
                break; 
            }
            $iteration++;
        } while ($iteration < $maxIterations);
    

        $directoryPath = storage_path('app/public/task-image');

            if (!is_dir($directoryPath)) {
                mkdir($directoryPath, 0755, true);
            }
        $image->orientate();
        $image->save(storage_path('app/public/task-image/' . $fileName), $quality);
    
        return $fileName;
    }
}
