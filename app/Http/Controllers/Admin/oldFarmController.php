<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\FarmStoreRequest;

class FarmController extends Controller
{
    public function index()
    {
        if ($error = $this->authorize('farm-manage')) {
            return $error;
        }
        $farms = Farm::with('subFarms')->get();
        $users = User::whereIn('type',['1','3'])->get(['id','name']);
        return view('admin.farm.index', compact('farms','users'));
    }

    public function store(FarmStoreRequest $request)
    {
        if ($error = $this->authorize('farm-add')) {
            return $error;
        }

        $data = $request->validated();
        // $data['user_id'] =;

        try{
            Farm::create($data);
            toast('Success!','success');
            return redirect()->back();
        }catch(\Exception $ex){
            // return $ex->getMessage();
            toast('Error','error');
            return redirect()->back();
        }
    }

    public function update(Request $request, $id)
    {
        if ($error = $this->authorize('farm-manage')) {
            return $error;
        }
        $data = $this->validate($request, [
            'name' => 'required|max:191',
        ]);

        DB::beginTransaction();

        try{
            Subject::find($id)->update($data);
            DB::commit();
            toast('success','Success');
            return redirect()->back();
        }catch(\Exception $ex){
            // return $ex->getMessage();
            DB::rollBack();
            toast('error','Error');
            return redirect()->back();
        }
    }


    public function destroy($id)
    {
        if ($error = $this->sendPermissionError('delete')) {
            return $error;
        }
        try{
            Subject::find($id)->delete();
            toast('Success!','success');
            return redirect()->back();
        }catch(\Exception $ex){
            toast('Failed','error');
            return redirect()->back();
        }
    }
}
