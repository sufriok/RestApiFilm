<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Favorit;
use App\Film;
use App\User;

class FavoritController extends Controller
{
    //
    public function index()
    {
        $user_id = Auth::id();
        $myfavorit = Favorit::where('user_id', $user_id)->get();

        return response([
            'success' => true,
            'message' => 'film favorit anda : ',
            'data' => $myfavorit,
        ], 200);
        
    }

    public function store(Request $request)
    {
        $user_id = Auth::id();
        $cekFilm = Favorit::where('film_id', $request->film_id)->where('user_id',$user_id)->first();
        
        if(!$cekFilm){

            $favorit= new Favorit();
            $favorit->user_id = $user_id;
            $favorit->film_id = $request->film_id;
            $favorit->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Data favorit Tersimpan!',
            ], 200);
            
        }else {

            return response()->json([
                'success' => false,
                'message' => 'Film sudah ada di data favorit anda',
            ],401);
            
        }

    }

    public function destroy($id)
    {
        $favorit = Favorit::find($id);
        $favorit->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus!',
        ], 200);
    }
}
