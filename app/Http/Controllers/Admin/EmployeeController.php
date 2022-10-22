<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\UserFile;
use App\Models\EmployeeCat;
use App\Models\EmployeeInfo;
use Illuminate\Http\Request;
use App\Models\EmployeeMainCat;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Http\Requests\UserStoreRequest;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\EmployeeStoreRequest;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        if ($error = $this->authorize('employee-manage')) {
            return $error;
        }
        if ($request->ajax()) {
            $users = User::with('employee')->whereType('3');
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('check', function ($row) {
                    return '<input type="checkbox" name="select[]" onclick="checkcheckbox()" id="check_'.$row->id.'" class="check" value="'.$row->id.'">';
                })
                ->addColumn('created_at', function ($row) {
                    return $row->created_at->diffForHumans();
                })
                ->addColumn('age', function ($row) {
                    return ageWithDays($row->d_o_b);
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    if (userCan('user-edit')) {
                        $btn .= view('button', ['type' => 'ajax-edit', 'route' => route('admin.employee.edit', $row->id) , 'row' => $row]);
                    }
                    if (userCan('user-delete')) {
                        $btn .= view('button', ['type' => 'ajax-delete', 'route' => route('admin.employee.destroy', $row->id), 'row' => $row, 'src' => 'dt']);
                    }
                    return $btn;
                })
                ->rawColumns(['check', 'age', 'action', 'created_at'])
                ->make(true);
        }
        $employeeCats = EmployeeCat::all();
        $roles = Role::all();
        return view('admin.employee.index', compact('employeeCats','roles'));
    }

    public function store(UserStoreRequest $request, EmployeeStoreRequest $employee)
    {
        if ($error = $this->authorize('employee-add')) {
            return $error;
        }
        DB::beginTransaction();

        $data = $request->validated();
        $data['type'] = '3';
        $data['image'] = imageStore($request, 'user', 'uploads/images/users/');
        $user = User::create($data);

        if($request->hasFile('name')){
            $this->validate($request, [
                'name' => 'required',
                'name.*' => 'required',
                'note' => 'required',
            ]);
            if($request->hasFile('name')) {
                $files = $request->file('name');
                foreach($files as $key => $file){
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "employee_file_".rand(0,100000).".".$extension;
                    $destinationPath = 'uploads/user_files'.'/';
                    $file->move($destinationPath, $fileName);
                    $userFile = [
                        'user_id' => $user->id,
                        'type' => '3',
                        'name' => $fileName,
                        'note' => $request->note[$key],
                    ];
                    UserFile::create($userFile);
                }
            }
        };

        $employeeInfo = $employee->validated();
        $employeeInfo['user_id'] = user()->id;
        EmployeeInfo::create($employeeInfo);
        try {
            DB::commit();
            return response()->json(['message'=> 'Data Successfully Inserted'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message'=>__('app.oops')], 500);
            // return response()->json(['message'=>$e->getMessage()], 500);
        }
    }

    // User File Store
    public function userFileStore(Request $request)
    {
        if ($error = $this->authorize('employee-cat-manage')) {
            return $error;
        }
        $user_id = $request->get('user_id');
        if ($request->hasFile('name')) {
            $this->validate($request, [
                'name' => 'required',
                'name.*' => 'required',
                'note' => 'required',
            ]);
            if ($request->hasFile('name')) {
                $files = $request->file('name');
                foreach ($files as $key => $file) {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "employee_file_".rand(0, 100000).".".$extension;
                    $destinationPath = 'files/user_file'.'/';
                    $file->move($destinationPath, $fileName);
                    $userFile = [
                        'user_id' => $user_id,
                        'type' => 3,
                        'name' => $fileName,
                        'note' => $request->note[$key],
                    ];
                    UserFile::create($userFile);
                }
                toast('File Successfully Inserted', 'success');
                return redirect()->back();
            }
        }
    }

    public function edit($id)
    {
        if ($error = $this->sendPermissionError('edit')) {
            return $error;
        }
        $employee = User::find($id);
        $emp = EmployeeInfo::where('user_id', $id)->first();
        $selectBank = BankList::where('id',$emp->bank_list_id)->first();
        $bankLists = BankList::where('id','!=',$emp->bank_list_id)->get();
        $userFiles = UserFile::where('user_id', $id)->get();

        $salesReport = SalesReport::where('user_id', $id)->get();
        // $permission = ModelHasRole::all();
        // $employeeMainCatsSelected = EmployeeMainCat::whereId($emp->employee_main_cat_id)->first();
        $employeeMainCats = EmployeeMainCat::all();
        $empInfos = EmployeeInfo::select(['user_id','employee_main_cat_id'])->get();
        $empDesignations = EmployeeInfo::select(['user_id','employee_main_cat_id'])->get();
        $dealers = User::select(['id','name','business_name'])->where('role', 2)->get();
        return view('admin.employee.edit', compact('employee','userFiles','selectBank','bankLists','empInfos','empDesignations','dealers','employeeMainCats'));
    }

    public function update(Request $request, $id)
    {
        if ($error = $this->sendPermissionError('edit')) {
            return $error;
        }
        // return$request;
        $this->validate($request, [
            'name' => 'required',
            'f_name' => 'required',
            'm_name' => 'required',
            'nid' => 'required',
            'm_status' => 'required',
            'j_date' => 'required',
            // 'salary' => 'required',
            // 'email' => 'required|email|unique:users,email',
            'phone' => 'required|numeric',
            'address' => 'required',
        ]);

        // DB::beginTransaction();

        $image_name = '';
        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $image_name = "employee_".rand(0,10000).'.'.$image->getClientOriginalExtension();
            $request->image->move('images/users/',$image_name);
        }else{
            $image_name = $request->old_image;
        }

        $data = [
            'name' => $request->input('name'),
            'tmm_so_id' => $request->get('tmm_so_id'),
            'email' => strtolower($request->input('email')),
            'phone' => $request->input('phone'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'role' => 5,
            'is_' => $request->input('permission'),
            'address' => $request->input('address'),
            'profile_photo_path' => $image_name,
            // 'password' => bcrypt($request->input('password')),
        ];
        if(!empty($request->password)){
            $data['password'] = bcrypt($request->input('password'));
        }

        $user = User::find($id)->update($data);
        $employeeInfo = [
            // 'user_id' => $user->id,
            'f_name' => $request->input('f_name'),
            'm_name' => $request->input('m_name'),
            'job_loc' => $request->input('job_loc'),
            'd_o_b' => $request->input('d_o_b'),
            'nid' => $request->input('nid'),
            'blood' => $request->input('blood'),
            'm_status' => $request->input('m_status'),
            'c_phone' => $request->input('c_phone'),
            'j_date' => $request->input('j_date'),
            'place' => $request->input('place'),
            'g_name' => $request->input('g_name'),
            'g_phone' => $request->input('g_phone'),
            'relation' => $request->input('relation'),
            'place' => $request->input('place'),
            'p_address' => $request->input('p_address'),
            'basic_pay' => $request->input('basic_pay'),
            'house_rent' => $request->input('house_rent'),
            'medical_a' => $request->input('medical_a'),
            'p_i_bill' => $request->input('p_i_bill'),
            'e_bonus' => $request->input('e_bonus'),
            'o_l_maintain' => $request->input('o_l_maintain'),
            'dearness_a' => $request->input('dearness_a'),
            'travel_a' => $request->input('travel_a'),
            'ad_salary' => $request->input('ad_salary'),
            'total' => $request->input('total'),

            'bank_list_id' => $request->bank_list_id,
            'ac_name' => $request->ac_name,
            'ac_no' => $request->ac_no,
            'cheque_no' => $request->cheque_no,
            'branch' => $request->branch,
        ];
        if(!empty($request->employee_main_cat_id)){
            return$employeeInfo['employee_main_cat_id'] = $request->employee_main_cat_id;
        }
        EmployeeInfo::where('user_id', $id)->update($employeeInfo);

        // User File
        if ($request->hasFile('name')) {
            $files = $request->file('name');
            foreach ($files as $key => $file) {
                if ($files != '') {
                    $extension = $file->getClientOriginalExtension();
                    $fileName = "employee_file_".rand(0, 100000).".".$extension;
                    $destinationPath = 'files/user_file'.'/';
                    $file->move($destinationPath, $fileName);
                    $files = UserFile::where('id', $request->id[$key])->first();
                    $path =  public_path('files/user_file/'.$files->name);
                    unlink($path);
                    $fileName = $fileName;
                } else {
                    $fileName = $request->get('old_name');
                }
                $userFile = [
                    'name' => $fileName,
                    'note' => $request->note[$key],
                ];
                $getData = UserFile::where('id', $request->id[$key])->first();
                $getData->update($userFile);
            }
        }

        if(!empty($request->employee_main_cat_id==11)){
            if ($request->employee_main_cat_id==11) {
                $salesReport = [
                    'user_id' => $id,
                    'zsm_id' => $id,
                ];
            } elseif ($request->employee_main_cat_id==12) {
                $salesReport = [
                    'zsm_id' => $request->zsm_id,
                    'sso_id' => $id,
                    'user_id' => $id,
                ];
            } elseif ($request->employee_main_cat_id==13) {
                $salesReport = [
                    'zsm_id' => $request->zsm_id,
                    'sso_id' => $request->sso_id,
                    'so_id' => $id,
                    'user_id' => $id,
                ];
            } elseif ($request->employee_main_cat_id==14) {
                $salesReport = [
                    'zsm_id' => $request->zsm_id,
                    'sso_id' => $request->sso_id,
                    'so_id' => $request->sm_id,
                    'customer_id' => $request->customer_id,
                    'user_id' => $id,
                ];
            }
        }
        // return $salesReport;
        if($request->employee_main_cat_id==11 || $request->employee_main_cat_id==12 || $request->employee_main_cat_id==13 ||$request->employee_main_cat_id==14){
            if(SalesReport::where('user_id', $id)->count()<1){
                SalesReport::create($salesReport);
            }else{
                SalesReport::where('user_id', $id)->update($salesReport);
            }
        }


        if($request->note != '' && $request->hasFile('name')==''){
            foreach($request->note as $key => $value){
                $data = [
                    'note' => $request->note[$key],
                ];
                $gdata = UserFile::where('id', $request->id[$key])->first();
                $gdata->update($data);
            }
        }

        try {
            toast('Employee Update Successfully','success');
            return redirect()->route('employee.index');
        } catch(\Exception $ex) {
            toast($ex->getMessage().'Employee Update Failed','error');
            return redirect()->back();
        }
    }

       // Only User File Delete
       public function userFileDestroy($id)
       {
        if ($error = $this->sendPermissionError('delete')) {
            return $error;
        }
           $userFile = UserFile::find($id);
           $path =  public_path('files/user_file/'.$userFile->name);

           if($userFile->name == 'company_logo.png'){
               $userFile->delete();
               toast('File Successfully Deleted','success');
               return redirect()->back();
           }else{
               if(file_exists($path)){
                   unlink($path);
                   $userFile->delete();
                   toast('File Successfully Deleted','success');
                   return redirect()->back();
               }else{
                   $userFile->delete();
                   toast('File Delete Field','error');
                   return redirect()->back();
               }
           }
       }

    public function destroy($id)
    {
        if ($error = $this->sendPermissionError('delete')) {
            return $error;
        }
        User::find($id)->delete();
        toast('File Delete Field','error');
                return redirect()->back();




        // $userFile = UserFile::where('user_id', $id)->get();
        // $path =  public_path('files/user_file/'.$userFile->name);

        // if($userFile->name == 'company_logo.png'){
        //     $userFile->delete();
        //     toast('File Successfully Deleted','success');
        //     return redirect()->back();
        // }else{
        //     if(file_exists($path)){
        //         unlink($path);
        //         $userFile->delete();
        //         toast('File Successfully Deleted','success');
        //         return redirect()->back();
        //     }else{
        //         $userFile->delete();
        //         toast('File Delete Field','error');
        //         return redirect()->back();
        //     }
        // }
    }
}
