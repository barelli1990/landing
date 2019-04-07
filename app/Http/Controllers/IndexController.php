<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Portfolio;
use App\Service;
use App\People;
use App\Page;
use DB;
use Mail;
class IndexController extends Controller
{
    //

    public function execute(Request $request){

        if($request->isMethod('post')){

            $messages = [
                'required'=>"Поле :attribute обязательно к заполнению",
                'email'=>"поле должно соответствовать эмаил адресу"
            ];
            $this->validate($request, [
                'name'=>'required|max:255',
                'email'=>'required|email',
                'text'=>'required'
            ], $messages);

            $data = $request->all();
            $result = Mail::send('site.email', ['data'=>$data], 
            function($message) use ($data){$message->to('arzu.beytiyeva@mail.ru', 'Inna_Danylevska')->subject('FromInnaWithLove');
                 $message->from('arzu.beytiyeva@mail.ru', 'Inna_Danylevska'); });
            // $result= Mail::send('site.email', ['data'=>$data], function($message) use ($data){
            //     $mail_admin = env('MAIL_ADMIN');
            //     $message->from($data['email'], $data['name']);
            //     $message->to($mail_admin, 'admin')->subject('Question');
            // });
            $request->session()->flash('status', 'Email is sent');
            return redirect()->route('home');
            // if($result){
            //     echo "hello";
            //     $request->session()->flash('status', 'Email is sent'); 
            //     return redirect()->route('home');
            //     //return redirect()->route('home')->with('status','email. is send');
            // }
            
        }


        $pages = Page::all();
        $portfolios = Portfolio::get(array('name','filter','images'));
        $services = Service::where('id','<', 20)->get();
        $people = People::take(3)->get();
        $tags = DB::table('portfolios') ->distinct()->pluck('filter');

        $menu = array();
        foreach($pages as $page){

            $item = array('title'=>$page->name, 'alias'=>$page->alias);
            array_push($menu, $item);
        }

        $item = array('title'=>'Services', 'alias'=>'service');
        array_push($menu, $item);

        $item = array('title'=>'Portfolio', 'alias'=>'Portfolio');
        array_push($menu, $item);

        $item = array('title'=>'Team', 'alias'=>'team');
        array_push($menu, $item);

        $item = array('title'=>'Contact', 'alias'=>'contact');
        array_push($menu, $item);

        return view('site.index', array(
                                    'menu'=>$menu,
                                    'pages'=>$pages,
                                    'services'=>$services,
                                    'portfolios'=>$portfolios,
                                    'peoples'=>$people,
                                    'tags'=>$tags
        ));

    }
}
