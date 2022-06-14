<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
class TeamController extends Controller
{
   public function wizard(){
    return view('welcome');
   }
}
