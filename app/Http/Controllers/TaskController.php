<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

class TaskController extends Controller
{
    public function create(Request $request)
    {
        Task::create([
            'emergency' => $request->emergency,
            'content' => $request->content,
        ]);
    }
    public function read()
    {
        $data = Task::get();
        return $data;
    }
    public function update(Request $request)
    {
        Task::where("id", $request->id)->update([
            "emergency" => $request->emergency,
            "content" => $request->content,
        ]);
    }
    public function delete($id)
    {
        Task::where("id", $id)->delete();
    }
    public function search(Request $request)
    {
        $query = Task::query()
        ->orderBy('id', 'asc');
    
        $query->where('emergency','=', $request->emergency);
        if(isset($request->content)){
            $query->where('content','like', "%".$request->content."%");
        }
    
        $data = $query->get();
        return $data;
    }
}
