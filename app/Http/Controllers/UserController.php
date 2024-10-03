<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    function adduser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string|max:255',
            'userEmail' => 'required|email|unique:users,email',
            'userPassword' => 'required|string|min:8',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ]
            );
        }
        $userName = $request->userName;
        $userEmail = $request->userEmail;
        $userPassword = $request->userPassword;

        $insertedUser = User::create([
            'name' => $userName,
            'email' => $userEmail,
            'password' => $userPassword,
        ]);

        if ($insertedUser) {
            return response()->json([
                'status' => 200,
                'message' => 'User added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to add user',
            ], 500);
        }
    }

    function edituser(Request $request, $id)
    {
        $userData = User::where('id', $id)->first();
        return response()->json([
            'status' => 'success',
            'data' => $userData
        ]);
    }

    function userstatus(Request $request, $id)
    {
        $userStatus = $request->status;
        $updatedStatus = User::where('id', $id)
            ->update([
                'status' => $userStatus,
            ]);

        if ($updatedStatus) {
            return response()->json([
                'status' => 200,
                'message' => 'User Status Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to Updated User Status',
            ], 500);
        }
    }

    function updateuser(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'editUserName' => 'required|string|max:255',
            'editUserEmail' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ]
            );
        }
        $editUserName = $request->editUserName;
        $editUserEmail = $request->editUserEmail;
        $editUserData = User::where('id', $request->editUserId)->first()
            ->update([
                'name' => $editUserName,
                'email' => $editUserEmail,
            ]);

        if ($editUserData) {
            return response()->json([
                'status' => 200,
                'message' => 'User Data Edited successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to Edit User Data',
            ], 500);
        }
    }

    function deleteuser(Request $request, $id)
    {
        $deleteUserData = User::where('id', $id)->delete();
        if ($deleteUserData) {
            return response()->json([
                'status' => 200,
                'message' => 'User Deleted successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to Delete',
            ], 500);
        }
    }

    public function userpost(Request $request)
    {
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'userPostName' => 'required|string|max:255',
            'userDes' => 'required|string|max:1000',
            'userPost.*' => 'required|image|mimes:jpeg,png,jpg,gif ',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ]
            );
        }
        $uploadedImages = [];
        if ($request->hasFile('userPost')) {
            foreach ($request->file('userPost') as $image) {
                // Create a unique name for the image
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('uploads/images/');

                // Create directory if it doesn't exist
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0755, true);
                }

                // Move the image to the storage path
                $image->move($imagePath, $imageName);

                // Store the image path
                $uploadedImages[] = url('uploads/images/' . $imageName); // or use asset() function
            }
        }

        $userPostName = $request->userPostName;
        $postDescription = $request->userDes;
        $postImage = json_encode($uploadedImages);

        // dd($postDescription);
        $insertedUserPost = Post::create([
            'user_id' => $userId,
            'name' => $userPostName,
            'description' => $postDescription,
            'images' => $postImage
        ]);

        if ($insertedUserPost) {
            return response()->json([
                'status' => 200,
                'message' => 'Post added successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to add Post',
            ], 500);
        }
    }

    function editpost(Request $request, $id)
    {
        $postData = Post::where('id', $id)->first();
        $postData['images'] = json_decode($postData['images']);
        return response()->json([
            'status' => 'success',
            'data' => $postData
        ]);
    }

    function userpoststatus(Request $request, $id)
    {
        $userStatus = $request->status;
        $updatedStatus = Post::where('id', $id)
            ->update([
                'status' => $userStatus,
            ]);

        if ($updatedStatus) {
            return response()->json([
                'status' => 200,
                'message' => 'Status Updated Successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to Updated Status',
            ], 500);
        }
    }

    function updatepost(Request $request)
    {
        // dd($request->all());
        $userId = Auth::user()->id;
        $validator = Validator::make($request->all(), [
            'editPostName' => 'required|string|max:255',
            'editPostDes' => 'required|string|max:1000',
            'editPost.*' => 'required|image|mimes:jpeg,png,jpg,gif ',
        ]);
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 422,
                    'statusState' => 'error',
                    'message' => (empty($validator->errors()) ? 'Something went wrong' : $validator->errors())->first(),
                ]
            );
        }
        $uploadedImages = [];
        if ($request->hasFile('editPost')) {
            foreach ($request->file('editPost') as $image) {
                // Create a unique name for the image
                $imageName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = public_path('uploads/images/');

                // Create directory if it doesn't exist
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0755, true);
                }

                // Move the image to the storage path
                $image->move($imagePath, $imageName);

                // Store the image path
                $uploadedImages[] = url('uploads/images/' . $imageName); // or use asset() function
            }
        }
        $userPostName = $request->editPostName;
        $postDescription = $request->editPostDes;
        $postImage = json_encode($uploadedImages);
        $editPostData = Post::where('id', $request->editPostId)->first()
            ->update([
                'user_id' => $userId,
                'name' => $userPostName,
                'description' => $postDescription,
                'images' => $postImage
            ]);
        if ($editPostData) {
            return response()->json([
                'status' => 200,
                'message' => 'Post Edited successfully',
            ]);
        } else {
            return response()->json([
                'status' => 500,
                'message' => 'Failed to Edit Post',
            ], 500);
        }
    }

    function deletepost(Request $request)
    {
        $ids = $request->input('ids');

        // Delete posts with the selected IDs
        Post::destroy($ids);

        return response()->json(['message' => 'Posts deleted successfully.']);
    }
}
