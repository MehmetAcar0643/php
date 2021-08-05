<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Study;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class StudiesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['study'] = Study::all()->sortBy('must');
        return view("admin.studies.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.studies.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required|max:250',
            'file' => 'mimes:jpg,png,jpeg|max:2048',
            'percent' => 'min:0|max:100'
        ]);
        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }

        $study = Study::insert(
            [
                "title" => $request->title,
                "slug" => $slug,
                "percent" => $request->percent,
                "file" => $request->kapakdata,
                "description" => $request->description,
            ]
        );
        if ($study) {
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
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $study=Study::where('id',$id)->first();
        return view("admin.studies.edit")->with("study",$study);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'description' => 'required|max:250',
            'file' => 'mimes:jpg,png,jpeg|max:2048',
            'percent' => 'min:0|max:100'
        ]);
        if (strlen($request->slug) > 3) {
            $slug = Str::slug($request->slug);
        } else {
            $slug = Str::slug($request->title);
        }

        $study = Study::Where('id',$id)->update(
            [
                "title" => $request->title,
                "slug" => $slug,
                "percent" => $request->percent,
                "file" => $request->kapakdata,
                "description" => $request->description,
            ]
        );
        if ($study) {
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
    public function destroy($id)
    {
        $study = Study::find(intval($id));
        $sil = $study->delete();
        if ($sil) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function sortable()
    {
        foreach ($_POST['item'] as $key => $value) {
            $study = Study::find(intval($value));
            $study->must = intval($key)+1;
            $study->save();
        }
        echo true;
    }

    public function status(Request $request)
    {
        $study = Study::find($request->id);
        $study->status = $request->status;
        $study->save();
        if ($study) {
            return 1;
        }
        return 0;
    }

//    KULLANILIYOR!!!!
    public function projects_status(Request $request)
    {
        $study = Study::find($request->id);
        $study->projects_status = $request->projects_status;
        $study->save();
        if ($study) {
            return 1;
        }
        return 0;
    }


}
