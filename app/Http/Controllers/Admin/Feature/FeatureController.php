<?php

namespace App\Http\Controllers\Admin\Feature;

use App\DataTables\FeatureDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\FeatureRequest;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(FeatureDataTable $dataTable)
    {
        return $dataTable->render('admin.feature.feature-list',['pageConfigs' => $this->pageConfigs]);
    }

    public function feature()
    {
        // $data['state'] = State::where('country_id',101)->get();

        return view('admin.feature.feature-add', ['pageConfigs' => $this->pageConfigs]);
    }

    public function create(FeatureRequest $request)
    {
        $data=$request->all();
        $data['created_by'] =  auth('web')->user()->id;

        $this->recordSave(Feature::class,$data);
        return redirect()->back()->with($this->toastrMsg('created'));
    }

    public function edit($id =null)
    {
        $data['feature']=Feature::where('id',$id)->get()->first();
        return view('admin.feature.feature-edit',['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function update(FeatureRequest $request)
    {
        $data=$request->all();
        $this->recordSave(Feature::class,$data);
        return redirect()->back()->with($this->toastrMsg('updated'));
    }
}
