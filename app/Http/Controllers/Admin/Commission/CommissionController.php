<?php

namespace App\Http\Controllers\Admin\Commission;

use App\DataTables\CommissionDataTable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commission;
use App\Models\Profile;

class CommissionController extends Controller
{
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(CommissionDataTable $dataTable)
    {
        return $dataTable->render('admin.commission.list',['pageConfigs' => $this->pageConfigs]);
    }

    public function commission()
    {
        $data['hospitals'] = Profile::where('is_active',1)->get();

        return view('admin.commission.add', ['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function create(Request $request)
    {
        $data=$request->all();
        $data['created_by'] =  auth('web')->user()->id;

        $this->recordSave(Commission::class,$data);
        return redirect()->back()->with($this->toastrMsg('created'));
    }

    public function edit($id =null)
    {
        $data['commission']=Commission::where('id',$id)->with('hospital')->first();
        $data['hospitals']=Profile::all();
        return view('admin.commission.edit',['pageConfigs' => $this->pageConfigs,'data'=>$data]);
    }

    public function update(Request $request)
    {
        $data=$request->all();
        $this->recordSave(Commission::class,$data);
        return redirect()->back()->with($this->toastrMsg('updated'));
    }
}
