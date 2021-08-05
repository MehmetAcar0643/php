<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectImage\ProjectImageCreateRequest;
use App\Project;
use App\ProjectImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;

class ProjectsImagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $project = Project::whereId($id)->with('projectImages')->first() ?? abort(404, 'Proje Bulunamadı...');
        return view("admin.projects.images.index", compact('project'));


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {


//        if ($request->hasFile('file')) {
//            foreach ($request->file('files') as $file => $asdasd) {
//                $image_encode = base64_encode(file_get_contents($asdasd));
//                $image = "data:image/png;base64," . $image_encode;
//                $img = ProjectImage::insert(
//                    [
//                        "project_id" => $project_id,
//                        "file" => $image
//                    ]
//                );
//            }
//            if ($img) {
//                //Yönlendirme methodu
//                return back()->with('success', 'İşlem Başarılı');
//            }
//        }
//        return back()->with('error', 'İşlem Başarısız');



        if ($request->hasFile('imagefile')) {
            $allowedfileExtension = ['jpg', 'png', 'docx'];
            $files = $request->file('imagefile');
            foreach ($files as $file) {
                $extension = $file->getClientOriginalExtension();
                $check = in_array($extension, $allowedfileExtension);
//dd($check);
                if ($check) {
                    foreach ($request->imagefile as $photo => $asdasd) {
                        $image_encode = base64_encode(file_get_contents($asdasd));
                        $image = "data:image/png;base64," . $image_encode;
                        $img = ProjectImage::insert(
                            [
                                "project_id" => $project_id,
                                "file" => $image
                            ]
                        );
                    }
                    if ($img) {
                        //Yönlendirme methodu
                        return back()->with('success', 'İşlem Başarılı');
                    }
                } else {
                    return back()->with('error', 'Sadece jpg,png,jpeg uzantılı resimler eklenebilir.');
                }
            }
        }
        return back()->with('error', 'İşlem Başarısız');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($project_id, $image_id)
    {
        //        $image = ProjectImage::find(intval($image_id))->delete();
        $image = Project::find($project_id)->projectImages()->whereId($image_id)->delete();
        if ($image) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public
    function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $images = ProjectImage::find(intval($value));
            $images->must = intval($key) + 1;
            $images->save();
        }
        echo true;
    }

    public
    function status(Request $request)
    {
        $image = ProjectImage::find($request->id);
        $image->status = $request->status;
        $image->save();
        if ($image) {
            return 1;
        }
        return 0;
    }
}
