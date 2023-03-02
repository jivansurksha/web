<?php

namespace App\Http\Controllers\Admin\Hospital;

use App\DataTables\UsersDataTable;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class HospitalOverviewController extends Controller
{
    //
    private $pageConfigs;
    private $data;

    public function __construct()
    {
        $this->pageConfigs = ['blankPage' => false];
    }

    public function index(UsersDataTable $dataTable)
    {
        return $dataTable->with('type','vendor')->render('admin.hospital.overview',['pageConfigs' => $this->pageConfigs]);
    }

}
