<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


        /*
    -------------------------------
    _desc: it will help you doing create and sometime update your record
    _there are four parameter supported this function
    _1st parameter is $table name
    _2nd parameter is request
    _3th parameter is extra_data, if you want to insert and update some extra data. it's also optional parameter.
    _4th parameter is condition, it's also optional parameter.
    ________________________________
    */

    public function recordSave($table,$req,$extra_data=null,$codition=null)
    {
        //record update
        if(isset($req['id'])){
            $model=$table::find($req['id']);

            if(! isset($model->id)){
                return false;
            }

            collect($req)->map(function($val,$key) use($model,$extra_data){

                if($key!='_token' && $key!='_method'){
                    $model->$key=$val;

                    if($extra_data!=null){
                        $extra_data->map(function($extra_data_val,$key) use($model){
                            $model->$key=$extra_data_val;
                        });
                    }

                }
            });
        }else{
            //record insert
            $model=new $table();
            collect($req)->map(function($val,$key) use($model,$extra_data){
                if($key!='_token'){
                    $model->$key=$val;

                    if($extra_data!=null){
                        $extra_data->map(function($extra_data_val,$key) use($model){
                            $model->$key=$extra_data_val;
                        });
                    }
                }
            });
        }

        return $model->save() ? $model : false;
    }



    // public function fileUpload($file, $model, $storageType='local'): array
    // {
    //     try {
    //         if($storageType == 'local'){
    //             $extension = $file->getClientOriginalExtension();
    //             $filename = $model->id.'_'.time().'.'.$extension;
    //             if($model->staff){
    //                 $filename = $model->staff->employeeId.'_'.time().'.'.$extension;
    //             }

    //             $path = tenant()->id.'/'.$model->getTable().'/';

    //             $folder = public_path('/storage/'.$path);
    //             if (!File::exists($folder)) {
    //             File::makeDirectory($folder, 0775, true, true);
    //             }

    //             $file->move($folder, $filename);
    //             $image = url('/storage/' . $path . $filename);

    //             $datas = [
    //             'name' => $filename,
    //             'title' => $filename,
    //             'file' =>'/storage/'.$path.$filename,
    //             'url'=> $image,
    //             'originalName'=> $file->getClientOriginalName(),
    //             'mimeType' =>  $file->getClientMimeType(),
    //             'addedBy' => auth()->user()->id,
    //             ];
    //             return $datas;
    //         }
    //         else{
    //             return [];
    //         }
    //     } catch (Exception $e) {
    //         return [];
    //     }
    // }



    // public function changeActiveStatus(Request $request)
    // {
    //     if($request->listing == 'bank'){
    //         $bank = MasterBank::find($request->id);
    //         $branchs = MasterBankBranch::where('bank_id', $request->id)->get();
    //         if($bank->isActive == 1){
    //             $bank->isActive = 0;
    //             if(count($branchs) > 0){
    //                 foreach($branchs as $branch){
    //                     $branch->is_active = 0;
    //                     $branch->update();
    //                 }
    //             }
    //             $bank->update();
    //             return response()->json(['status'=>'success','message'=>$bank->name.' deactivated successfully.','data'=>$bank, 'active'=>$bank->is_active]);
    //         }else{
    //             $bank->isActive = 1;
    //             if(count($branchs) > 0){
    //                 foreach($branchs as $branch){
    //                     $branch->is_active = 1;
    //                     $branch->update();
    //                 }
    //             }
    //             $bank->update();
    //             return response()->json(['status'=>'success','message'=>$bank->name.' bank activated successfully.','data'=>$bank, 'active'=>$bank->is_active]);
    //         }
    //     }
    // }

        /*
    -------------------------------
    _desc: it will help you doing imgage upload
    _there are four parameter supported this function
    _1st parameter is $table name
    _2nd parameter is file request
    _3th parameter is save path
    ________________________________
    */
    public function singleImgUpload($table,$file,$savePath,$id=null,$table_img_field)
    {
        if($file!=null){
            $filenameWithExt = $file->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $file->getClientOriginalExtension();
            $fileNameToStore = md5($filename.'_'.rand(11111, 99999)).'.'.$extension;
            $path            = $file->storeAs($savePath, $fileNameToStore);
        }

        if($id!=null){
            return $this->recordSave($table,['id'=>$id, $table_img_field=>$fileNameToStore != null? $fileNameToStore : null]);
        }

    }

    public function singlelogoUpload(Request $request)
    {
        $savePath=$request->savePath;
        if($request->prevImg!=''){
            $prev_path=$savePath.$request->prevImg;
            if(file_exists(Storage::path($prev_path))){
                unlink(Storage::path($prev_path));
            }
        }
        $file = $request->all()['logo'];
        if($file!=null){
            $filenameWithExt = $file->getClientOriginalName();
            $filename        = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension       = $file->getClientOriginalExtension();
            $fileNameToStore = md5($filename.'_'.rand(11111, 99999)).'.'.$extension;
            $path            = $file->storeAs($savePath, $fileNameToStore);
        }
        return response()->json(['status'=>'success','data'=>$fileNameToStore]);
    }


    //*****it will hlep you to update table status ***********/
    public function statusUpdate(Request $request)
    {
        //satatus update help of ajax
        if($request->post('table') || $request->post('id') || $request->post('status')){
            $table='App\Models\.'.$request->post('table');
            $table=str_replace('.','',$table);
            $model=$table::find($request->post('id'));
            if(isset($model->id)){
                $model->is_active=$request->post('status');
            }
            return $model->save() ? response()->json(['status'=>'success']) : response()->json(['status'=>'error']);
        }
    }

    //*****it will hlep you to delete single record form table *****/
    public function recordDelete(Request $request, $id=null, $table=null, $codition=null)
    {
        //ajax delete
        if($id==null && $table==null){
            $table='App\Models\.'.$request->table;
            $table=str_replace('.','',$table);
            $model=$table::find($request->post('id'));
            if(isset($model->id)){
                return $table::where(['id'=>$request->id])->delete() ? response()->json(['status'=>'success']) : response()->json(['status'=>'error']);
            }
        }
    }

    /*
    -------------------------------
    _desc: it will help you to create notification
    _arr parameter: $arr['user_id'], $arr['title'], $arr['url_path']
    ________________________________
    */
    public function toastrMsg($id=null)
    {
        if($id!=null){
            echo Toastr::success("A new record has been updated successfully", "", ["positionClass" => "toast-top-right","progressBar"=>true,"timeOut"=>"3000"]);
        }else{
            echo Toastr::success("A new record has been inserted successfully", "", ["positionClass" => "toast-top-right","progressBar"=>true,"timeOut"=>"3000"]);
        }
    }
}
