<?php

namespace App\Http\Controllers\Admin;

use App\Models\Farm;
use App\Models\SubFarm;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\SubFarmStoreRequest;

class SubFarmController extends Controller
{
    public function store(SubFarmStoreRequest $request)
    {
        if ($error = $this->authorize('sub-farm-add')) {
            return $error;
        }

        $data = $request->validated();
        $data['user_id'] = user()->id;
        try{
            SubFarm::create($data);
            toast('Success!','success');
            return redirect()->back();
        }catch(\Exception $ex){
            // // return $ex->getMessage();
            toast('Error','error');
            return redirect()->back();
        }
    }

    public function edit($id)
    {
        $farms = Farm::all();
        $subFarm = SubFarm::find($id);
        return view('admin.farm.edit', compact('farms', 'subFarm'));
    }

    public function update(SubFarmStoreRequest $request, SubFarm $subFarm)
    {
        if ($error = $this->authorize('sub-farm-edit')) {
            return $error;
        }

        $data = $request->validated();
        $data['user_id'] = user()->id;
        try{
            $subFarm->update($data);
            toast('Success!','success');
            return redirect()->back();
        }catch(\Exception $ex){
            // // return $ex->getMessage();
            toast('Error','error');
            return redirect()->back();
        }
    }

    public function destroy(SubFarm $subFarm)
    {
        try{
            $subFarm->delete();
            Alert::success('Success','Successfully Deleted');
            return redirect()->back();
        }catch (\Exception $ex) {
            Alert::error('Oops...','Delete Failed');
            return back();
        }
    }
}
