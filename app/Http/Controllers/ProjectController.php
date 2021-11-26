<?php

namespace App\Http\Controllers;

use App\Mail\ChangeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

class ProjectController extends Controller
{

    public function projects(Request $request){

        //filter

        if($request->filter == null){
            $request->session()->put("filter", null);
        }
        else if($request->filter == 1){
            $filter = "Fejlesztésre vár";
            $request->session()->put("filter", $filter);
        }
        else if($request->filter == 2){
            $filter = "Folyamatban";
            $request->session()->put("filter", $filter);
        }
        else if($request->filter == 3){
            $filter = "Kész";
            $request->session()->put("filter", $filter);
        }
        else{
            return back()->with("fail", "Ilyen projekt állapot nem létezik!");
        }
            

        if(session("filter") != null){
            $projects = DB::table('projects')
            ->where("status", $filter)
            ->paginate(10);
        }
        else{
            $projects = DB::table('projects')
            ->paginate(10);
        }

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

        //send mail

        $data["option"] = "new";
        $data["title"] = $request->title;
        $data["description"] = $request->description;
        $data["status"] = "Fejlesztésre vár";

        foreach($request->contact as $contact){
            $email = explode("/", $contact);
            Mail::to($email[1])->send(new ChangeMail($data));
        }

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

        //get project data

        $project = DB::table('projects')->where("id", $request->id)->first();

        $data["option"] = "changes";
        $data["old_title"] = $project->name;

        if($project->name != $request->title){
            $data["title"] = $request->title;
        }
        else {
            $data["title"] = null;
        }

        if($project->description != $request->description){
            $data["description"] = $request->description;
        }
        else {
            $data["description"] = null;
        }

        if($project->status != $request->status){
            $data["status"] = $request->status;
        }
        else {
            $data["status"] = null;
        }

        //send mail

        if($data["title"] != null || $data["description"] != null){
            foreach($request->contact as $contact){
                $email = explode("/", $contact);
                Mail::to($email[1])->send(new ChangeMail($data));
            }
        }

        //if delete from project

        $database_contacts = json_decode($project->contacts);

        foreach($database_contacts as $database_contact){

            $delete = true;

            foreach($request->contact as $contact){
                if($contact == $database_contact){
                    $delete = false;
                }
                else if($delete == false){
                    $delete = false;
                }
                else{
                    $delete = true;
                }
            }

            if($delete == true){
                $data["option"] = "delete";
                $data["title"] = $project->name;
                $data["description"] = null;
                $data["status"] = null;
                $email = explode("/", $database_contact);
                Mail::to($email[1])->send(new ChangeMail($data));
            }

        }

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

    public function deleteProject(Request $request) {

        $project = DB::table('projects')->where("id", $request->id)->first();

        foreach(json_decode($project->contacts) as $contact){
            $data["option"] = "delete";
            $data["old_title"] = $project->name;
            $data["title"] = null;
            $data["description"] = null;
            $data["status"] = null;
            $email = explode("/", $contact);
            Mail::to($email[1])->send(new ChangeMail($data));
        }

        $affected = DB::table('projects')
            ->where('id', $request->id)
            ->delete();

        return response()->json("ok");
    }
}
