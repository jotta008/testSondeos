<?php

namespace App\Http\Controllers\Api\Genders;

use App\Http\Controllers\Controller;
use App\Models\Genders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GendersController extends Controller
{
  function __construct()
  {
    $this->middleware('auth');
  }

  public function getGenders()
  {
    $genders = Genders::where('active', 1)->orderBy('id')->get();
    return response()->json($genders);
  }

  public function getBook(Request $request)
  {
    $gender = Genders::where(['active' => 1, 'id' => $request->id])->get();
    return response()->json($gender);
  }

  public function createGender(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'name' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
    $gender = new Genders();
    $gender->name = $data['name'];
    $gender->save();
    return response()->json($gender);
  }
  public function updateGender(Request $request)
  {
    $data = $request->all();
    $validator = Validator::make($request->all(), [
      'id' => 'required',
    ]);
    if ($validator->fails()) {
      return response()->json($validator->errors());
    }
    $gender = Genders::where(['active' => 1, 'id' => $data['id']])->first();
    if($gender == null){
      return response()->json(['error' => 'No se encontró el género']);
    }

    $gender->name = $data['name'] ?? $gender->name;
    $gender->save();
    return response()->json($gender);
  }
  public function deleteGender(Request $request)
  {
    $data = $request->all();
    $book = Genders::where(['active' => 1, 'id' => $data['id']])->first();
    $book->active = 0;
    $book->save();
    return response()->json($book);
  }
}
