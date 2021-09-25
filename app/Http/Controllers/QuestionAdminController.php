<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RequestQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionAdminController extends Controller
{

    public function index()
    {
        $questions = Question::orderBy('created_at', 'desc')->get();
        return view('index',compact('questions'));
    }

    public function create()
    {
        //
    }

    public function store(RequestQuestion $request)
    {
        $data = Question::add($request->all());
        $data->user_id = Auth::check() ? Auth::id() : null;  
        $data->save();

        // отправка сообщений
        return back()->with('success','Сообщение успешно отравлено!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        $data = Question::find($id);
        $data->delete();

        return back()->with('success','Запрос удалён');
    }

    public function deleteAll(Request $request)
    {
        $ids = $request->ids;
        Question::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['success'=>"Products Deleted successfully."]);
    }
}
