<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Phone;

class UserController extends Controller
{
    private $users;
    public function __construct()
    {
        $this->users = new Users();
    }

    public function index(Request $request)
    {
        $title = 'Danh sách người dùng';
        $users = new Users();
        $filters = [];

        if (!empty($request->status)) {
            $status = $request->status;
            if ($status == 'active') {
                $status = 1;
            } elseif ($status == 'inactive') {
                $status = 0;
            }

            $filters[] = ['users.status', '=', $status];
        }

        if (!empty($request->group_id)) {
            $group_id = $request->group_id;
            $filters[] = ['users.group_id', '=', $group_id];
        }

        if (!empty($request->keyword)) {
            $keyword = $request->keyword;
            $filters[] = ['users.fullName', 'like', '%' . $keyword . '%'];
        }

        $ListUsers = $this->users->getAllUsers($filters);
        return view('clients.lists', compact('title', 'ListUsers'));
    }

    public function add()
    {
        $title = 'Thêm người dùng';
        $allGroups = $this->users->getAllGroups();
        return view('clients.add', compact('title', 'allGroups'));
    }

    public function postAdd(Request $request)
    {
        $request->validate([
            'fullName' => 'required|min:5',
            'email' => 'required|email|unique:users',
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Vui lòng chọn nhóm');
                }
            }],
            'status' => 'required|integer',
        ], [
            'fullName.required' => 'Họ và tên bắt buộc phải nhập',
            'fullName.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trên hệ thống',
            'group_id.required' => 'Nhóm không được để trống',
            'group_id.integer' => 'Nhóm không hợp lệ',
            'status.required' => 'Trạng thái không được để trống',
            'status.integer' => 'Trạng thái không hợp lệ',
        ]);

        $dataInsert = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->users->addUser($dataInsert);

        return redirect()->route('users.index')->with('msg', 'Thêm người dùng thành công');
    }

    public function getEdit(Request $request, $id = 0)
    {
        $title = 'Cập nhật người dùng';
        $allGroups = $this->users->getAllGroups();

        if (empty($id)) {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }

        $userDetail = $this->users->getDetail($id);
        if (empty($userDetail)) {
            return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
        }

        // store id in session for postEdit
        $request->session()->put('id', $id);

        return view('clients.edit', compact('title', 'userDetail', 'allGroups'));
    }

    public function postEdit(Request $request)
    {
        $id = session('id');
        if (empty($id)) {
            return back()->with('msg', 'Id người dùng không tồn tại');
        }

        $request->validate([
            'fullName' => 'required|min:5',
            'email' => 'required|email|unique:users,email,' . $id,
            'group_id' => ['required', 'integer', function ($attribute, $value, $fail) {
                if ($value == 0) {
                    $fail('Vui lòng chọn nhóm');
                }
            }],
            'status' => 'required|integer',
        ], [
            'fullName.required' => 'Họ và tên bắt buộc phải nhập',
            'fullName.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại trên hệ thống',
            'group_id.required' => 'Nhóm không được để trống',
            'group_id.integer' => 'Nhóm không hợp lệ',
            'status.required' => 'Trạng thái không được để trống',
            'status.integer' => 'Trạng thái không hợp lệ',
        ]);

        $dataUpdate = [
            'fullName' => $request->fullName,
            'email' => $request->email,
            'group_id' => $request->group_id,
            'status' => $request->status,
            'updated_at' => date('Y-m-d H:i:s')
        ];

        $this->users->updateUser($dataUpdate, $id);

        return back()->with('msg', 'Cập nhật người dùng thành công');
    }

    public function delete($id = 0)
    {
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)) {
                $deleteStatus = $this->users->deleteUser($id);
                if ($deleteStatus) {
                    $msg = "Xóa người dùng thành công";
                } else {
                    $msg = "Bạn không thể xóa người dùng lúc này. Vui lòng thử lại sau.";
                }
            } else {
                $msg = 'Người dùng không tồn tại';
            }
        } else {
            $msg = 'Liên kết không tồn tại';
        }

        return redirect()->route('users.index')->with('msg', $msg);
    }

    public function getDetailUser($id = 0)
    {
        $title = 'Chi tiết người dùng';
        if (!empty($id)) {
            $userDetail = $this->users->getDetail($id);
            if (!empty($userDetail)) {
                return view('clients.detail', compact('userDetail', 'title'));
            } else {
                return redirect()->route('users.index')->with('msg', 'Người dùng không tồn tại');
            }
        } else {
            return redirect()->route('users.index')->with('msg', 'Liên kết không tồn tại');
        }
    }
    public function relations()
    {
        // $phone = Users::find(1)->phone;
        // $idPhone = $phone->id;
        // $phoneNumber = $phone->phone;
        // echo "ID Phone: " . $idPhone . "<br>";
        // echo "Phone Number: " . $phoneNumber . "<br>";


        // $phone = Users::find(1)->phone;
        // dd($phone);

        $user = Phone::where('phone', "0327461459")->first()->user;
        $fullName = $user->fullName;
        $email = $user->email;
        echo "Full Name: " . $fullName . "<br>";
        echo "Email: " . $email . "<br>";
    }
}
