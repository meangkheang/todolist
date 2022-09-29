<?php

namespace App\Http\Controllers;

use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoItemController extends Controller
{
    public function index($page = 1){

        $todolist = TodoItem::all();
        $paginate = TodoItem::paginate(8);

        return view('todolist.list')->with(['todolist'=>$todolist,'paginate'=>$paginate]);
    }
    public function store(Request $request){
           
        $userInput = $request->all();

        $page = $request->page;
        

        TodoItem::create([
            'des' => $userInput['des']
        ]);

        return redirect('/?'.'page=' . $page )->with('page');
    }

    public function delete(Request $request){

        $ids = explode(',',$request->ids[0]);     

        for ($i=0; $i < count($ids); $i++) { 
            TodoItem::where('id',$ids[$i])->update(array('is_done'=>1));
        }

        return redirect('/');
    }
    
}
