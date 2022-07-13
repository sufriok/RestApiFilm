<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Rating;
use App\Film;
use App\User;

class RatingController extends Controller
{
    //
    public function store(Request $request)
    {
        $user_id = Auth::id();

        $cekFilm = Rating::where('film_id', $request->film_id)->where('user_id',$user_id)->first();
        
        if(!$cekFilm){

            //validate data
            $validator = Validator::make($request->all(), [
                'rating'     => 'required|integer|between:1,5',
                'film_id'   => 'required',
            ],
                [
                    'rating.required' => 'Masukkan rating 1-5 !',
                    'film_id' => 'Tidak ada film yang dipilih !',
                ]
            );
            if($validator->fails()) {

                return response()->json([
                    'success' => false,
                    'message' => 'Silahkan Isi Bidang Yang Sesuai',
                    'data'    => $validator->errors()
                ],401);

            } else {

                $rating= new Rating();
                $rating->rating = $request->rating;
                $rating->user_id = $user_id;
                $rating->film_id = $request->film_id;
                $rating->save();

                return response()->json([
                    'success' => true,
                    'message' => 'Rating film berhasil disimpan!',
                ], 200);
            }
            
        }else {

            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memberi rating pada film ini',
            ],401);
            
        }

    }

    public function update(Request $request, $id)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'rating'     => 'required|integer|between:1,5',
        ],
            [
                'rating.required' => 'Masukkan rating 1-5 !',
            ]
        );
        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Sesuai',
                'data'    => $validator->errors()
            ],401);

        } else {

            $rating= Rating::find($id);
            $rating->rating = $request->rating;
            $rating->push();

            // return response('Data Rating Tersimpan');
            return response()->json([
                'success' => true,
                'message' => 'Rating Film Berhasil Diperbaharui!',
            ], 200);
        }
    }

    public function destroy($id)
    {
        $rating = Rating::find($id);
        $rating->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus!',
        ], 200);
    }
}
