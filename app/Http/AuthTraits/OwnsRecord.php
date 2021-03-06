<?php
/**
 * Created by PhpStorm.
 * User: Nhut Tran
 * Date: 3/28/2017 10:58 AM
 */

namespace App\Http\AuthTraits;


use Illuminate\Support\Facades\Auth;

trait OwnsRecord
{
    public function userNotOwnerOf($modelRecord)
    {
        return $modelRecord->user_id != Auth::id();
    }

    public function currentUserOwns($modelRecord)
    {
        return $modelRecord->user_id === Auth::id();
    }

    public function adminOrCurrentUserOwns($modelRecord)
    {
        if (Auth::user()->is_admin == 1){
            return 'Admin';
        }
        return $modelRecord->user_id === Auth::id();
    }

    public function allowUserUpdate($user)
    {
        if (Auth::user()->isAdmin()){
            return true;
        }
        return $user->id === Auth::id();
    }
}