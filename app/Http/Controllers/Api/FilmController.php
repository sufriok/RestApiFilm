<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Film;
use App\Rating;
use App\Favorit;
use File;

class FilmController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $filmTayang=Film::where('status', 'tayang')->get();
        $filmComingSoon=Film::where('status', 'coming soon')->get();
        
        return response([
            'success' => true,
            'message' => 'List film Tayang dan Coming Soon : ',
            'filmTayang' => $filmTayang,
            'filmComingSoon' => $filmComingSoon,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validate data
        $validator = Validator::make($request->all(), [
            'judul'     => 'required',
            'video'   => 'required|mimes:mp4,x-flv,x-mpegURL,MP2T,3gpp,quicktime,x-msvideo,x-ms-wmv',
            'deskripsi' => 'required',
            'status'    => 'required|in:tayang,coming soon',
        ],
            [
                'judul.required' => 'Masukkan Judul Film !',
                'video.required' => 'Masukkan Film !',
                'deskripsi.required' => 'Masukkan Deskripsi Film !',
                'status.required'=> 'Masukkan Status Film, tayang atau coming soon !',
            ]
        );

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'Silahkan Isi Bidang Yang Sesuai',
                'data'    => $validator->errors()
            ],401);

        } else {

            $destination = "uploadVideo";
        
            $video = $request->file('video');
            $extension = $video->getClientOriginalExtension(); 
            // RENAME THE UPLOAD WITH RANDOM NUMBER 
            $videoName = rand(11111, 33333) . '.' . $extension; 
            // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY 
            $video->move($destination, $videoName);

            $film = new Film();
            $film->judul = $request->judul;
            $film->video = $videoName;
            $film->deskripsi = $request->deskripsi;
            $film->status = $request->status;
            $film->save();

            return response()->json([
                'success' => true,
                'message' => 'Film Berhasil Disimpan!',
            ], 200);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $film = Film::whereId($id)->first();


        if ($film) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $film
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Post Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $film = Film::find($id);

        if ($film) {
            return response()->json([
                'success' => true,
                'message' => 'Detail Post!',
                'data'    => $film
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Film Tidak Ditemukan!',
                'data'    => ''
            ], 401);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $film = Film::find($id);
        
        if($request->hasFile('video'))
            {
                $destination = "uploadVideo";
        
                $video = $request->file('video');
                $extension = $video->getClientOriginalExtension(); 
                // RENAME THE UPLOAD WITH RANDOM NUMBER 
                $videoName = rand(33334, 55555) . '.' . $extension; 
                // MOVE THE UPLOADED FILES TO THE DESTINATION DIRECTORY 
                $video->move($destination, $videoName);

                File::delete('uploadVideo/'.$film->video);

            }
        else
            {
                $videoName = $film->video;
            }
        
        $film->judul = $request->judul;
        $film->video = $videoName;
        $film->deskripsi = $request->deskripsi;
        $film->status = $request->status;
        $film->push();
        
        return response()->json([
            'success' => true,
            'message' => 'Data Terupdate!',
        ], 200);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $film = Film::find($id);
        $film_id = $film->id;
        // return response ($film_id);
        File::delete('uploadVideo/'.$film->video);
        $adaRating = Rating::where('film_id', $film_id)->first();
        if($adaRating)
        {
            $adaRating->delete();
        }
        $adaFavorit = Favorit::where('film_id', $film_id)->first();
        if($adaFavorit) 
        {
            $adaFavorit->delete();
        }
        
        $film->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data Terhapus!',
        ], 200);
    }
}
