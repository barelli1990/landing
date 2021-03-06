<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Page;
class PagesAddController extends Controller
{
    //
    public function execute(Request $request){

        if($request->isMethod('post')){
            $input=$request->except('_token');

            $messages=[
                'required'=>'обязательно к заполнению :attribute',
                'unique'=>':attribute должно быть уникальным'
            ];

            $validator = Validator::make($input, [
                'name'=>'required|max:255',
                'alias'=>'required|unique:pages|max:255',
                'text'=>'required'
            ], $messages);
            if($validator->fails()){
                return redirect()->route('pagesAdd')->withErrors($validator)->withInput();
            }
            //dd($input);
            if($request->hasFile('images')){
                $file = $request->file('images');
                $input['images']=$file->getClientOriginalName();

                $file->move(public_path().'/assets/img',$input['images']);
            }
            
            //dd($input);

            //$page = new Page($input);
            $page = new Page();
            //$page->unguard();
            $page->fill($input);

            if($page->save()){
                return redirect('admin')->with('status', 'stranica dobavlna');
            }
        }

        if(view()->exists('admin.pages_add')){

            $data = [
                'title'=>'новая страница'
            ];
            return view('admin.pages_add', $data);
        }
        abort(404);
    }
}
