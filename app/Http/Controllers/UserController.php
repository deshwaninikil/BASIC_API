<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{
    //
    function register(Request $req)
  {
     $user= new User;
     $user->first_name=$req->input('first_name');
     $user->last_name=$req->input('last_name');
     $user->profession=$req->input('profession');
     $user->email=$req->input('email');
     $user->phone=$req->input('phone');
     $user->password=Hash::make($req->input('password'));
     $user->address=$req->input('address');
     $user->pincode=$req->input('pincode');
     $user->save();
     
     if($user)
     {
         return $user;

     }
     else
     {
         return["Result"=>"Data not save"];
     }
     

        
  }
  function login(Request $req)
  {
    $user =User::where('email',$req->email)->first();
    if(!$user || !Hash::check($req->password,$user->password))
    {
      return response([
        'error'=>["Email or password is not matched"]

      ]);
    }
    return $user;
  }

  function update(Request $req)
  {
      $user= User::find($req->id);
      $user->first_name=$req->first_name;
      $user->last_name=$req->last_name;
      $user->profession=$req->profession;
      $user->email=$req->email;
      $user->phone=$req->phone;
      $user->password=$req->password;
      $user->address=$req->address;
      $user->pincode=$req->pincode;
      $result=$user->save();

      if($result)
      {

      return["Result"=>"Data is updated"];

      }
      else
      {
          return["Result"=>"Data is not updated"];
      }
}
function delete($id)
     {
         $user= User::find($id);
         $result=$user->delete();

         if($result)
         {
 
                  return ["result"=>"Record is delete"];
         }
        }
      }
