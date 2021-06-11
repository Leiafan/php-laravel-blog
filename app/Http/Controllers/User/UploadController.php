<?php

namespace App\Http\Controllers\User;

use App\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class UploadController extends Controller
{
    //
    public function article() {
        return view('user.upload_article');
    }

    public function upload(Request $request) {

        $rules = array(
            'title'         =>  'required',
            'description'   =>  'required',
            'user_id'       =>  'required',
            'text'          =>  'required',
            'file'          =>  'required'
        );

        $validation = Validator::make($request->all() , $rules);

        if($validation->fails()) {
            return response()->json(['errors' => $validation->errors()->all()]);
        }

        $file = $request->file('file');
        $filename = time() . '.' . $file->getClientOriginalExtension();
        $path = 'storage/images/' . $filename;
        $file->move(public_path('storage/images'), $filename);
        $request->merge(['image' => $path]);

        $form_data = array(
            'title'         => $request->title,
            'description'   => $request->description,
            'user_id'       => $request->user_id,
            'text'          => $request->text,
            'image'         => $request->image
        );

        Article::create($form_data);
        return redirect()->route('index')->with(['message', 'Статья подана на обработку']);
//        return response()->json(['success' => 'Данные успешно добавлены']);
    }
}
