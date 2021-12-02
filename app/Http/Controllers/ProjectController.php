<?php

namespace App\Http\Controllers;

use App\Mail\ChangeMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Project;
use App\Models\Status;
use Illuminate\Support\Carbon;

class ProjectController extends Controller
{

    public function projects(Request $request){

        if($request->filter == null){
            $projects = Project::paginate(10);
        }
        else {
            $request->session()->put("filter", $request->filter);
            $projects = Status::find($request->filter)
                ->getProjects()
                ->paginate(10);
        }

        $statuses = Status::get();

        return view('main', ["Title"=>"Projektek", "Projects"=>$projects, "Statuses"=>$statuses]);
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
        $data["status"] = 0;

        foreach($request->contact as $contact){
            $email = explode("/", $contact);
            //Mail::to($email[1])->send(new ChangeMail($data));
        }

        $newProject = new Project;
        $newProject->name = $request->title;
        $newProject->description = $request->description;
        $newProject->status_id = 1;
        $newProject->contacts = $contacts;
        $newProject->save();

        return back()->with("success", "Mentettük az új projektet!");
    }

    public function project(Request $request){

        $project = Project::where("id", $request->id)->first();

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

        $project = Project::where("id", $request->id)->first();

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

        $existingProject = Project::find($request->id);
        if($existingProject){
            $existingProject->name = $request->title;
            $existingProject->description = $request->description;
            $existingProject->status = $request->status;
            $existingProject->contacts = $contacts;
            $existingProject->save();

            return back()->with("success", "Mentettük a változásokat!");
        }

        return back()->with("success", "Nem található projekt!");
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

        $affected = Project::where('id', $request->id)
            ->delete();

        return response()->json("ok");
    }
}
