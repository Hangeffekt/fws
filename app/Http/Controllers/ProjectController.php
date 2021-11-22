<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class ProjectController extends Controller
{

    public function projects(){

        $projects = DB::table('projects')->paginate(10);

        return view('main', ["Title"=>"Projektek", "Projects"=>$projects]);
    }

    public function createProject(Request $request) {

        //validate $request
        $request->validate([
            "title"=>"required",
            "description"=>"required",
            "contact"=>"required"
        ]);

        $contacts = json_encode($request->contact);

        //if validate successfuly

        $affected = DB::table('projects')->insert([
            'name' => $request->title,
            'description' => $request->description,
            "status" => "Fejlesztésre vár",
            "contacts" => $contacts
        ]);

        return back()->with("success", "Mentettük az új projektet!");
    }

    public function project(Request $request){

        $project = DB::table('projects')->where("id", $request->id)->first();

        $status = array("Fejlesztésre vár", "Folyamatban", "Kész");

        $Contacts = json_decode($project->contacts);

        return view('project', ["Title"=>"Projekt::".$project->name, "Project"=>$project, "Contacts"=>$Contacts, "Statuses"=>$status]);
    }

    public function updateProject(Request $request) {

        //validate $request
        $request->validate([
            "title"=>"required",
            "description"=>"required",
            "status"=>"required",
            "contact"=>"required"
        ]);

        $contacts = json_encode($request->contact);

        //if validate successfuly

        $affected = DB::table('projects')
            ->where('id', $request->id)
            ->update([
            'name' => $request->title,
            'description' => $request->description,
            "status" => $request->status,
            "contacts" => $contacts
        ]);

        return back()->with("success", "Mentettük a változásokat!");
    }
}
