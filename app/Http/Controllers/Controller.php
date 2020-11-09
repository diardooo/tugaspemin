<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

use App\Models\Users;

use Illuminate\http\Request;

use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    public function index(){
        return Users::all();
    }

    public function getid(Request $request,$id){
        $result = DB::select("SELECT * FROM Users WHERE id = $id");
        if(empty($result)){
            return response()->json(['message'=> 'Users Not Found'], 404);
        }
        else{
        return $result;
        }
    }

    public function store(Request $request){
    $this->validate($request, [
      'username' => 'required',
      'password' => 'required'
    ]);

    $Users = Users::create(
      $request->only(['username', 'password'])
    );

    return response()->json([
      'created' => true,
      'data' => $Users
    ], 201);
  }

  public function update(Request $request, $id)
  {
    try {
      $Users = Users::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'message' => 'Users not found'
      ], 404);
    }

    $Users->fill(
      $request->only(['username', 'password'])
    );
    $Users->save();

    return response()->json([
      'updated' => true,
      'data' => $Users
    ], 200);
  }
  
  public function destroy($id)
  {
    try {
      $Users = Users::findOrFail($id);
    } catch (ModelNotFoundException $e) {
      return response()->json([
        'error' => [
          'message' => 'Users not found'
        ]
      ], 404);
    }

    $Users->delete();

    return response()->json([
      'deleted' => true
    ], 200);
  }
}
