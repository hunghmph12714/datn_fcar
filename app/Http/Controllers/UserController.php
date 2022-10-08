<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\Authenticatable;
use PHPUnit\Exception;
use Illuminate\Support\Facades\DB;
class UserController extends Controller
{
    public function index(){
        $users = User::orderBy('id_role','desc')->paginate(10);
        // $users->load('roles');
        return view('admin.users.index', [
            'users' => $users,
            // 'roles' =>$users
        ]);
    }
    public function addForm(){
        $roles = Role::all();
        
        return view('admin.users.add' , compact('roles'));
    }
    public function saveAdd(Request $request){
        
        $request->validate([
            'name' => ['required','string','min:3','max:25'],
            'phone' => ['required', 'numeric','unique:users', 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'address' => ['required','string','min:3','max:50'],
            'email' => ['required','email','unique:users'],
            'id_role' => ['required'],
            // 'password' => ['required', 'string','min:8','max:50']
        ],
            [
                'name.required' => 'Vui lòng nhập họ và tên',
                'name.string' => 'Tên phải là chuỗi ký tự',
                'name.min' => 'Tên phải có độ dài lớn hơn 3',
                'name.max' => 'Tên phải có độ dài nhỏ hơn 25',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại phải là số',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'phone.regex' => 'Số điện thoại thuộc đầu số Việt Nam',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email phải có đuôi @',
                'email.unique' => 'Email đã tồn tại',
                'id_role.required' => 'Vui lòng cấp quyền truy cập',
                'address.required' => 'Vui lòng nhập địa chỉ',
                'address.string' => 'Địa chỉ phải là chuỗi ký tự',
                'address.min' => 'Địa chỉ có độ dài lớn hơn 3 kí tự',
                'address.max' => 'Địa chỉ có độ dài nhỏ hơn 50 kí tự',
                // 'password.required' => 'Vui lòng nhập mật khẩu',
                // 'password.string' => 'Mật khẩu phải là chuỗi',
                // 'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
                // 'password.max' => 'Mật khẩu phải nhỏ hơn 50 kí tự',
                
            ]);
        try{
            DB::beginTransaction();
            $user = new User();
            
            if($request->id_role == NULL){
                $user['id_role'] = 0;
            }
            else{
                $user['id_role'] = $request->id_role;
            }
            $user->fill($request->all());
            // dd($model);
            if($request->hasFile('avatar')){
                $imgPath = $request->file('avatar')->store('public/users');
                $imgPath = str_replace('public/', 'storage/', $imgPath);
                $user->avatar = $imgPath;
            }
            $user->save();
            $roleIds = $request->role_id;
            $user->roles()->attach($request->role_id);
            DB::commit();
            Toastr::success('Tạo tài khoản thành công','Thành công');
            return redirect(route('user.index'));

        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        } 

}
    public function remove($id)
    {
        $model=User::find($id);
        if(!empty($model->avatar)){
            $imgPath = str_replace('storage/', 'public/', $model->avatar);
            Storage::delete($imgPath);
        }
        $model->delete(); 
        Toastr::success('Xóa tài khoản thành công','Thành công');
        return redirect(route('user.index'));
    }
    public function editForm($id)
    {   
        
        $user = User::find($id);
        if($user->id == 1 || !$user){
            return back();
        }
        $roles = Role::all();
        $rolesOfUser = $user->roles;
        return view(
            'admin.users.edit',
            compact('user','roles','rolesOfUser')
        );
    }
    public function saveEdit(Request $request,$id)
    {   
        // dd($request->all());
        $request->validate([
            'name' => ['required','string','min:3','max:25'],
            'phone' => ['required', 'numeric','unique:users,phone,'.$id, 'regex:/^(0)(3[2-9]|5[6|8|9]|7[0|6-9]|8[0-6|8|9]|9[0-4|6-9])[0-9]{7}$/'],
            'email' => ['required','email','unique:users,email,'.$id],
            'id_role' => ['required'],
            // 'password' => ['required', 'string','min:8','max:50']
        ],
            [
                'name.required' => 'Vui lòng nhập họ và tên',
                'name.string' => 'Tên phải là chuỗi ký tự',
                'name.min' => 'Tên phải có độ dài lớn hơn 3',
                'name.max' => 'Tên phải có độ dài nhỏ hơn 25',
                'phone.required' => 'Vui lòng nhập số điện thoại',
                'phone.numeric' => 'Số điện thoại phải là số',
                'phone.unique' => 'Số điện thoại đã tồn tại',
                'phone.regex' => 'Số điện thoại thuộc đầu số Việt Nam',
                'email.required' => 'Vui lòng nhập email',
                'email.email' => 'Email phải có đuôi @',
                'email.unique' => 'Email đã được tồn tại',
                'id_role.required' => 'Vui lòng cấp quyền truy cập',
                // 'password.required' => 'Vui lòng nhập mật khẩu',
                // 'password.string' => 'Mật khẩu phải là chuỗi',
                // 'password.min' => 'Mật khẩu phải lớn hơn 8 kí tự',
                // 'password.max' => 'Mật khẩu phải nhỏ hơn 50 kí tự',
                
            ]);
        try{
            DB::beginTransaction();
            $user_update = User::find($id);
            if($request->id_role == NULL){
                $user_id_role = 0;
            }
            else{
               $user_id_role = $request->id_role;
            }
            $user_update->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                // 'password' => Hash::make(12345678),
                'address' => $request->address,
                'id_role' => $user_id_role,
                'description' => $request->description,
            ]);
            $user = User::find($id);
            $user->roles()->sync($request->role_id);
            DB::commit();
            if($request->hasFile('avatar')){
                // $oldImg = str_replace('storage/', 'public/', $model->avatar);
                Storage::delete($user->avatar);
                $imgPath = $request->file('avatar')->store('user');
                $imgPath = str_replace('public/', 'storage', $imgPath);
                 $user->avatar = $imgPath;
                 $user->save();
                //  $user->update('avatar' => )
            }
            Toastr::success('Sửa tài khoản thành công','Thành công');
            return redirect()->route('user.index');
        }catch (\Exception $exception){
            DB::rollBack();
            Log::error('Message :' . $exception->getMessage() . '--- Line: ' . $exception->getLine());
        } 

    }
}