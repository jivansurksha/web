<?php

namespace App\Http\Controllers\Admin\Feature;

use App\DataTables\AmenityDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\AmenityRequest;
use App\Models\Amenity;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class AmenityController extends Controller
{
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(AmenityDataTable $dataTable)
    {
        return $dataTable->render('admin.feature.amenity-list',['pageConfigs' => $this->pageConfigs]);
    }

    public function amenity()
    {
        return view('admin.feature.amenity-add', ['pageConfigs' => $this->pageConfigs]);
    }

    public function create(AmenityRequest $request)
    {
        $data=$request->all();
        $data['created_by'] =  auth('web')->user()->id;

        $this->recordSave(Amenity::class,$data);

        return redirect()->back()->with($this->toastrMsg('created'));
    }

    public function edit($id =null)
    {
        $data['amenity']=Amenity::where('id',$id)->get()->first();
        return view('admin.feature.amenity-edit',['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function update(AmenityRequest $request)
    {
        $data=$request->all();
        $this->recordSave(Amenity::class,$data);
        return redirect()->back()->with($this->toastrMsg('updated'));
    }
}
