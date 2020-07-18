<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Menu;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Imports\QRCode as QRCodeSuci;
use Excel;
use Yajra\Datatables\Datatables;




class SettingController extends Controller
{
    public function __construct()
	{
		$this->middleware('auth');
	}

	public function index()
	{
		$role = Role::orderBy('created_at', 'DESC')->get();
        $permission = Permission::all()->pluck('name');

		return view('backend.setting.index_setting',compact('role','permission'));
	}


	public function role()
	{
		return view('backend.setting.role');
	}

	public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:50'
        ]);

        if(!empty($request->id))
        {
            $update  = Role::find($request->id);
            $update->name = $request->name;
            $update->save();
            return response()->json(['status'=>'success']);
        }

        $role = Role::firstOrCreate(['name' => $request->name]);
        return response()->json(['status'=>'success']);
    }

    public function edit(Request $request,$id)
    {

        $data = Role::find($id);
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();
        return response()->json(['status'=>'success']);
    }


    public function index_perm()
    {
        $perm = 
        \DB::table('e_recruit.permissions as a')
        ->join('e_recruit.menu as b','a.menu_id','b.menu_id')
        ->orderBy('a.created_at', 'DESC')->get();
        //Permission::with('menu')->orderBy('created_at', 'DESC')->get();
        $menu = Menu::orderBy('created_at', 'DESC')->get();
        return view('backend.setting.index_setting_perm',compact('perm','menu'));
    }


    public function store_perm(Request $request)
    {

        if(!empty($request->id))
        {
            $this->validate($request, [
                'name' => 'required|string',
                'menu_id'=>'required'
            ]);

            $update  = Permission::find($request->id);
            $update->name = $request->name;
            $update->menu_id = $request->menu_id;
            $update->save();
            return response()->json(['status'=>'success']);
        }


        $this->validate($request, [
               'name' => 'required|string',
               'menu_id' => 'required'
        ]);

        $permission = Permission::firstOrCreate(['name' => $request->name,'menu_id'=>$request->menu_id]);
        return response()->json(['status'=>'success']);
    }

    public function edit_perm(Request $request,$id)
    {

        $data = Permission::find($id);
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function destroy_perm($id)
    {
        $permission = Permission::findOrFail($id);
        $permission->delete();
        return response()->json(['status'=>'success']);
    }



    public function role_permission($id)
    {
        $role = Role::find($id);
        $permission = Permission::all();

        if (!empty($role)) {
            $getRole = Role::find($id);
            $hasPermission = \DB::table('e_recruit.role_has_permissions')
                ->select('permissions.name')
                ->join('e_recruit.permissions', 'role_has_permissions.permission_id', '=', 'permissions.id')
                ->where('role_id', $getRole->id)->get()->pluck('name')->all();
                
        }
        return view('backend.setting.role_permission',compact('permission','role','hasPermission'));
    }



    public function save_role_permission(Request $request)
    {
        $role = Role::findByName($request->role_name);
        $role->syncPermissions($request->role_id);
        return response()->json(['status'=>'success']);
    } 



    public function index_menu()
    {
        $menu = \DB::table('e_recruit.menu as a')
                ->select('a.menu_name','a.menu_id','a.menu_url','b.menu_name as menu_parent','a.no_urut')
                ->leftJoin('e_recruit.menu as b','b.menu_id','a.menu_parent')
                ->orderBy('a.created_at', 'DESC')
                ->get();



        // Menu::orderBy('created_at', 'DESC')->paginate(10);
        $parent = Menu::all();
        return view('backend.setting.index_setting_menu',compact('menu','parent'));
    }


    public function store_menu(Request $request)
    {
        if(!empty($request->id))
        {
            $this->validate($request, [
                'menu_name' => 'required|string',
                'menu_url' => 'required',
                'no_urut' => 'required'
            ]);

            $update  = Menu::find($request->id);
            $update->menu_name = $request->menu_name;
            $update->menu_url = $request->menu_url;
            $update->no_urut = $request->no_urut;
            $update->type = $request->type;
            $update->menu_parent = (empty($request->menu_parent)) ? 0 : $request->menu_parent;
            $update->save();
            return response()->json(['status'=>'success']);
        }


        $this->validate($request, [
               'menu_name' => 'required|string',
                'menu_url' => 'required',
                'no_urut' => 'required'
        ]);
        $menu = Menu::firstOrCreate([
                    'menu_name' => $request->menu_name,
                    'menu_url'=>$request->menu_url,
                    'no_urut'=>$request->no_urut,
                    'type'=>$request->type,
                    'menu_parent'=> (empty($request->menu_parent)) ? 0 : $request->menu_parent
                ]);
        return response()->json(['status'=>'success']);
    }

    public function edit_menu(Request $request,$id)
    {

        $data = Menu::find($id);
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function destroy_menu($id)
    {
        $menu = Menu::findOrFail($id);
        $menu->delete();
        return response()->json(['status'=>'success']);
    }


    public function index_user()
    {
        $data['role'] = Role::orderBy('created_at', 'DESC')->get();
        return view('backend.setting.index_user',$data);
    }

   public function get_data_user(Request $request)
    {

        $search  = $request->input('search.value');
        $columns = $request->get('columns');
        $order   =  'nip';
        isset($_GET[ 'order' ]) ? $_GET[ 'order' ] : 'user_id';

        $count_total = \DB::table('e_recruit.tr_users')
                            ->leftJoin('e_recruit.roles','tr_users.role_id','roles.id')
                          ->count();

        $count_filter = \DB::table('e_recruit.tr_users')
                                    ->leftJoin('e_recruit.roles','tr_users.role_id','roles.id')
                           ->where('tr_users.name', 'LIKE', '%' . $search . '%')
                           ->orWhere('email', 'LIKE', '%' . $search . '%')
                           ->orWhere('position', 'LIKE', '%' . $search . '%')
                           ->whereNull('user_delete_time')
                           ->count();



        $tr_users = \DB::table('e_recruit.tr_users')
                    ->leftJoin('e_recruit.roles','tr_users.role_id','roles.id')
                    ->select(
                        'tr_users.name',
                        'roles.name as role_name',
                        'email',
                        'position',
                        'nip',
                        'user_id',
                        'roles.id as role_id'
                    )->whereNull('user_delete_time');

        $tr_users = $tr_users->orderBy($order,'asc');
        $tr_users = $tr_users->take(10);

        return Datatables::of($tr_users)
                         ->with([
                             "recordsTotal"    => $count_total,
                             "recordsFiltered" => $count_filter,
                         ])
                ->make(TRUE);
    }

    public function add_user()
    {
        $data['division'] = \App\Models\User::select('division')->whereNotNull('division')->groupBy('division')->get();
        $data['department'] = \App\Models\User::select('department')->whereNotNull('department')->groupBy('department')->get();
        $data['position'] = \App\Models\User::select('position')->whereNotNull('position')->groupBy('position')->get();
        $data['job_desc'] = \App\Models\User::select('job_desc')->whereNotNull('job_desc')->groupBy('job_desc')->get();
        $data['cost_center'] = \App\Models\User::select('cost_center')->whereNotNull('cost_center')->groupBy('cost_center')->get();
        return view('backend.setting.add_user',$data);
    }

    public function store_user(Request $request)
    {

        if ($request->hasFile('upload_file')) 
        {
            $this->validate($request, [
               
                'upload_file' =>'required|mimes:xlsx,xls'
            ]);
            $file = $request->file('upload_file'); //GET FILE
            $data = Excel::toArray(new QRCodeSuci, $request->file('upload_file')); 


            $dt = Excel::toArray(new QRCodeSuci, $request->file('upload_file')); 
            
            \DB::beginTransaction();
            try {
                for ($i=1; $i <= count($dt[0]) - 1; $i++) 
                {
                    $exist = \App\Models\User::where('nip',$data[0][$i][0])->first();
                    if(empty($exist))
                    {
                        $save  = new \App\Models\User;
                        $save->nip = $data[0][$i][0];
                        $save->username = $data[0][$i][0];
                        $save->name = $data[0][$i][1];
                        $save->cost_center = $data[0][$i][2];
                        $save->department = $data[0][$i][3];
                        $save->division = $data[0][$i][4];
                        $save->position = $data[0][$i][5];
                        $save->parent_user = $data[0][$i][6];
                        $save->email = $data[0][$i][7];
                        $save->hp = $data[0][$i][8];
                        $save->job_desc = $data[0][$i][9];
                        $save->level_user = '';
                        $save->password = bcrypt('123123');
                        $save->save();    
                    }
                    else
                    {
                        $save  = \App\Models\User::where('nip',$data[0][$i][0])
                        ->update([
                            'nip' => $data[0][$i][0],
                            'name' => $data[0][$i][1],
                            'username' =>  $data[0][$i][0],
                            'cost_center' => $data[0][$i][2],
                            'department' => $data[0][$i][3],
                            'division' => $data[0][$i][4],
                            'position' => $data[0][$i][5],
                            'parent_user' => $data[0][$i][6],
                            'email' => $data[0][$i][7],
                            'hp' => $data[0][$i][8],
                            'job_desc' => $data[0][$i][9],
                            'level_user' => '',
                            'password' =>bcrypt('123123')
                        ]);
                        // $save->save();    
                    }
                }
                \DB::commit();
                return response()->json(['status'=>'success']);
            } catch (\Exception $e) {
                \DB::rollback();
                return response()->json(['status'=>$e->getMessage()],422);       
            }
        }
        else
        {
            $this->validate($request, [
                'email'    => 'required|email',
                'name'    => 'required',
                'password'    => 'required',
                'cost_center'    => 'required',
                'position'    => 'required',
                'job_desc'    => 'required',
                'cost_center'    => 'required',
                'email'    => 'required',
                'hp'    => 'required',
                // 'upload_file' =>'required|mimes:xlsx,xls'
            ]);
            $save  = new \App\Models\User;
            $save->name = $request->name;
            $save->email = $request->email;
            $save->hp = $request->hp;
            $save->nip = $request->nip;
            $save->division = $request->division;
            $save->department = $request->department;
            $save->division = $request->division;
            $save->position = $request->position;
            $save->job_desc = $request->job_desc;
            $save->cost_center = $request->cost_center;
            $save->password = bcrypt($request->password);
            $save->level_user = '';
            $save->save();    
            return response()->json(['status'=>'success']);
        }
    }



    public function destroy_user($id)
    {
        $user = \App\Models\User::find($id);
        $user->user_delete_time = date('Y-m-d H:i:s');
        $user->user_delete_by = 1;
        $user->save();
        return response()->json(['status'=>'success']);
    }


    public function edit_user(Request $request,$id)
    {
        $data['user'] = \App\Models\User::find($id);
        $data['division'] = \App\Models\User::select('division')->get();
        $data['department'] = \App\Models\User::select('department')->get();
        $data['position'] = \App\Models\User::select('position')->get();
        $data['job_desc'] = \App\Models\User::select('job_desc')->get();
        $data['cost_center'] = \App\Models\User::select('cost_center')->get();
        return view('backend.setting.edit_user',$data);
    }



    public function update_user(Request $request,$id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        $update  = \App\Models\User::find($id);
        $update->name = $request->name;
        $update->email = $request->email;
        $update->hp = $request->hp;
        $update->nip = $request->nip;
        $update->division = $request->division;
        $update->department = $request->department;
        $update->division = $request->division;
        $update->position = $request->position;
        $update->job_desc = $request->job_desc;
        $update->cost_center = $request->cost_center;
        $update->password = bcrypt($request->password);
        $update->save();
        return response()->json(['status'=>'success']);
    }

    public function save_role(Request $request)
    {
        $user = \App\Models\User::find($request->user_id_modal);
        $user->role_id = $request->role_id;
        $user->save();

        $user = \App\Models\User::findOrFail($request->user_id_modal);
        $user->syncRoles($request->role_id);
        return response()->json(['status'=>'success']);
    }




}
