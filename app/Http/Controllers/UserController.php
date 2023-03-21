<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class UserController extends Controller
{

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::get();
            // return DataTables::of($data)->addColumn('action', function ($row) {
            //     $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit">Edit</a> ';
            //     $html .= '<button data-rowid="' . $row->id . '" class="btn btn-xs btn-danger btn-delete">Del</button>';
            //     return $html;
            // })
            //     ->editColumn('Status', function ($data) {
            //         if ($data->status == 1) {
            //             $active = "Active";
            //             return '<span class="status active">' . $active . '</span>';
            //         } else {
            //             $active = "Inactive";
            //             return '<span class="status blocked">' . $active . '</span>';
            //         }
            //     })
            //     ->toJson();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($data) {
                    $html = '<a href="#" class="btn btn-xs btn-secondary btn-edit"><i class="fas fa-pencil-alt"></i></a> ';
                    return $html;
                })
                ->editColumn('status', function ($data) {
                    if ($data->status == 1) {
                        $active = "Active";
                        return '<span class="status active">' . $active . '</span>';
                    } else {
                        $active = "Inactive";
                        return '<span class="status blocked">' . $active . '</span>';
                    }
                })

                ->rawColumns(['action', 'name', 'status', 'email', 'phone', 'status'])
                ->make(true);
        }

        return view('users.index');
    }

    public function store(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'country' => $request->country,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'status' => $request->status,
        ]);

        if ($user) {
            return ['success' => true, 'message' => 'Saved Successfully'];
            die;
        }
        return ['success' => false, 'message' => 'Couldnot Save'];
    }


    public function update(Request $request)
    {
        $id = $request->id;
        $user = User::whereid($id)->first();

        $user =  $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'dob' => $request->dob,
            'country' => $request->country,
            'gender' => $request->gender,
            'bio' => $request->bio,
            'status' => $request->status,
        ]);

        if ($user) {
            return ['success' => true, 'message' => 'Updated Successfully'];
            die;
        }
        return ['success' => false, 'message' => 'Couldnot Update'];
    }
}
