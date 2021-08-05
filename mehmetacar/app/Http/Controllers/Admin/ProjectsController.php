<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Project\ProjectCreateRequest;
use App\Http\Requests\Project\ProjectEditRequest;
use App\Project;
use App\Study;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
//        $data['project'] = Project::all()->where('study_id',$id);
//        return view("admin.projects.index",compact('data'));
        $study = Study::whereId($id)->with('projects')->first() ?? abort(404, 'Proje Bulunamadı...');
        return view("admin.projects.index", compact('study'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $study = Study::whereId($id)->first();
        return view("admin.projects.create", compact('study'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectCreateRequest $request, $study_id)
    {
        $baslangic = $request->baslangic;
        $request->validate([
            'bitis' => "required|date|after:$baslangic",
        ]);
        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }

//        $project = Project::insert(
//            [
//                "study_id"=>$study_id,
//                "title" => $request->title,
//                "slug" => $slug,
//                "description" => $request->description,
//                "file" => $request->kapakdata,
//                "baslangic"=>$baslangic,
//                "bitis"=>$request->bitis,
//            ]
//        );


        $project = Study::find($study_id)->projects()->create([
            "title" => $request->title,
            "slug" => $slug,
            "description" => $request->description,
            "file" => $request->kapakdata,
            "baslangic" => $baslangic,
            "bitis" => $request->bitis,
        ]);
        if ($project) {
            //Yönlendirme methodu
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($study_id, $id)
    {
        return $study_id . "-" . $id;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($study_id, $project_id)
    {
        $project = Study::find($study_id)->projects()->whereId($project_id)->first() ?? abort(404, 'Proje Bulunamadı...');
        return view("admin.projects.edit", compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectEditRequest $request, $study_id, $question_id)
    {
        $baslangic = $request->baslangic;
        $request->validate([
            'bitis' => "required|date|after:$baslangic",
        ]);
        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }
        $project = Study::find($study_id)->projects()->whereId($question_id)->update(
            [
                "title" => $request->title,
                "slug" => $slug,
                "description" => $request->description,
                "file" => $request->kapakdata,
                "baslangic" => $baslangic,
                "bitis" => $request->bitis,
            ]);
//        $project = Project::Where('id', $question_id)->update(
//            [
//                "title" => $request->title,
//                "slug" => $slug,
//                "description" => $request->description,
//                "file" => $request->kapakdata,
//                "baslangic" => $baslangic,
//                "bitis" => $request->bitis,
//            ]
//        );
        if ($project) {
            //Yönlendirme methodu
            return back()->with('success', 'İşlem Başarılı');
        }
        return back()->with('error', 'İşlem Başarısız');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($study_id, $project_id)
    {
//        $project = Project::find(intval($project_id))->delete();
        $project=Study::find($study_id)->projects()->whereId($project_id)->delete();
        if ($project) {
            echo 1;
        } else {
            echo 0;
        }
    }


    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $project = Project::find(intval($value));
            $project->must = intval($key) + 1;
            $project->save();
        }
        echo true;
    }

    public function status(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        if ($project) {
            return 1;
        }
        return 0;
    }

}
