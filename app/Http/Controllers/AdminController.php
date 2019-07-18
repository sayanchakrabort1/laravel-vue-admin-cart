<?php

namespace App\Http\Controllers;

use App\User;
use App\Basic;
use Illuminate\Http\Request;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Database\Eloquent\Model;
use App\Online;

class AdminController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('UserActive', ['only' => ['edit']]);
    // }

    public function index(Request $request)
    {
        $id = $request->session()
                      ->get('id');

        if ($id != null) {
            $basicModel = new Basic();
            $basicModel->onlineShuffler($id);
        }
        
        $request->session()
                ->flush();
        
        return redirect('admin/login');
    }

    public function login(Request $request)
    {
        return view('adminlogin');
    }

    public function verify(Request $request)
    {
        // print_r($request->all());
        // die();
        $customMessages=[
            'email.required' => 'A email is required',
            'pass.required'  => 'A password is required',
            'pass.min'  => 'Minimum length of password is 6',
            ];
        
             
        $validator= $this->validate(
            $request,
            [
                'email' => 'required|email|max:255',
                'pass' => 'required',  //|min:6
            ],
            $customMessages
        );
        
        if ($validator) {
            return redirect()->route('admin/login');
        } else {
            $basicModel = new Basic();
            $exist =  $basicModel->getFromDb($request);

            if ($exist) {
                // $basicModel= new Basic();
                $exist =  $basicModel->getId($request);

                $admin = $basicModel->adminChecker($exist);

                if ($admin) {
                    // dd('');
                    $request->session()->put('id', $exist);
                    $image = $basicModel->pullImage($exist);
                    $request->session()->put('image', $image);

                    $basicModel->onlineShuffler($exist);
                    
                    return redirect()->route('addashboard');
                } else {
                    return redirect()->route('adlogin')->withErrors(['Admin account not found.']);
                }
            } else {
                // dd('came');
                return redirect()->route('adlogin')->withErrors(['Invalid Username/Password']);
            }
        }
    }//Checks the login is valid or not

    public function dashboard(Request $request, User $objUser)
    {
        $id = $request->session()->get('id');

        // $basicModel = new Basic();
        // $basicModel->adminModule($id);

        // $users = Online::all();

        $users = $objUser->isOnline();

        // print_r($users);
        $basicModel = new Basic;

        foreach ($users as $key => $user) {
            $a[$key] = $basicModel->getEmail($user);
        }

        $data = $basicModel->getCount();
        $getEmail = $basicModel->getAllData($id);
        $getEmail = $getEmail["email"];
        

        $temp["data"] = $data;
        $temp["matrix"] = $a;
        $temp["email"] = $getEmail;
        // echo "<pre>";
        // print_r($temp["email"]);
        // die();
    
        return view('dashboard')->with($temp);
    }

    public function mailCatcher(request $request)
    {
        $request = $request->all();

        mail($request["recipient"], "Message from Admin", $request["text"]);

        return redirect()->route('addashboard')-> with('success', 'Your product has been added!');
    }

    

    public function adminCreate(request $request)
    {
        $customMessages=[
            'email.required' => 'A email is required',
            'pass.required'  => 'A password is required',
            ];
        
             
        $validator= $this->validate(
            $request,
            [
                'email' => 'required|email|max:255',
                'pass' => 'required',
            ],
            $customMessages
        );

        if ($validator) {
            redirect()->route('register');
        } else {
            // echo "<pre>";
            // print_r($request->all());
            // die();
            
            $request=$request->all();

            $basicModel = new Basic();
            $flag = $basicModel->adminMaker($request);

            // print_r($flag);
            // die();

            if ($flag == 0) {
                return redirect()->route('addashboard')->withErrors(['User already exist']);
            } else {
                return redirect()->route('addashboard')
                -> with('admin', 'string');
            }
        }
        // print_r($request);
        // die();
    }
}
