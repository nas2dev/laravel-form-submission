<?php

namespace App\Http\Controllers;

use Validator;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\FormSubmission;

class FormSubmissionController extends Controller
{
    public function index() {
        $users = User::all();

        return view('HomePage', compact('users'));
    }

    public function store(Request $request) {
        try {
            $validator = Validator::make($request->all(), [
                'user_id'    => 'required',
                'name'       => 'required|between:2,255',
                'email'      => 'required|email',
                'message'    => 'required|string',
                "image_path" => 'nullable|image|mimes:png,jpg,webp|max:2048'
            ]);

            if($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            if($request->hasFile('image_path')) {
                $imageName = time() . '.' . Str::random(10) . "." . $request->file("image_path")->extension();
                $request->file("image_path")->move(public_path("images/submissions"), $imageName);
                $request->image_path = "images/submissions/" . $imageName;
            }

            FormSubmission::create([
                "user_id" => $request->user_id,
                "name" => $request->name,
                "email" => $request->email,
                "message" => $request->message,
                "image_path" => $request->image_path
            ]);

            return redirect()->back()->with('success', 'Form submitted succesfully');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage())->withInput(); 
        }
    }

    // public function submissions(Request $request) {
    //     // dd($request->all());
    //     $user = User::find($request->user_id);
    //     $user_form_submissions = $user->formSubmissions;
    //     // dd($user_form_submissions);
    //     return view('SubmissionsPage', ['submissions' => $user_form_submissions]);
    // }

    public function submissions(Request $request) {
        $sortColumn = $request->query('sort', 'created_at');
        $sortDirection = $request->query('direction', 'DESC');

        $allowedColumns = ['id', 'name', 'email', 'created_at'];
        if(!in_array($sortColumn, $allowedColumns)) {
            $sortColumn = 'created_at';
        }

        $sortDirection = strtoupper($sortDirection) === 'ASC' ? 'ASC' : 'DESC';

        $user = User::find($request->user_id);
        $user_form_submissions = $user->formSubmissions()->orderBy($sortColumn, $sortDirection)->get();


        return view('SubmissionsPage', [
            'submissions' => $user_form_submissions,
            'sortColumn' => $sortColumn,
            'sortDirection' => $sortDirection,
            'allowSort' => true
        ]);
    }

    public function allSubmissions() {
        $allSubmissions =  FormSubmission::all();

        return view('SubmissionsPage', [
            'submissions' => $allSubmissions,
            'sortColumn' => '',
            'sortDirection' => '',
            'allowSort' => false
        ]);
    }
}
