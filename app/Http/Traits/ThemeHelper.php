<?php
namespace App\Http\Traits;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;

trait ThemeHelper {

    public function pageConfigs() {

        $pageConfigs = ['blankPage' => false];
        if(!Auth::check()){
            $pageConfigs = ['blankPage' => true];
        }
        return $pageConfigs;
    }
}
