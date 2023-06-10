<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' =>'index']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();

        return response()->json([
            'data' => $sliders
        ]);
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
        $validator = Validator::make($request->all(), [
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'required|image|mimes:jpg,png,jpeg,webp'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(), 422
            );
        }

        $input = $request->all();
        if ($image = $request->file('gambar')) {
            $destinationPath = "image/";
            $imageName = $image->getClientOriginalName(); // Menggunakan nama asli file
            $imageName = date('Ymd') . '_' . $imageName; // Menambahkan tanggal ke nama file
            $image->move($destinationPath, $imageName);
            $input['gambar'] = $imageName;
        }

        $slider = Slider::create($input);

        return response()->json([
            'data' => $slider
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slider $slider)
    {
        $validator = Validator::make($request->all(), [
            'nama_slider' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image'
        ]);

        if ($validator->fails()) {
            return response()->json(
                $validator->errors(),
                422
            );
        }

        $input = $request->all();
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $destinationPath = "image/";
            $imageName = date('Ymd') . '_' . $image->getClientOriginalName();
            $image->move($destinationPath, $imageName);
            $input['gambar'] = $imageName;

            // Hapus gambar lama jika ada
            if ($slider->gambar) {
                $imagePath = public_path('image/' . $slider->gambar);
                if (file_exists($imagePath)) {
                    unlink($imagePath);
                }
            }
        } else {
            $input['gambar'] = $slider->gambar;
        }

        $slider->update($input);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $slider
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slider  $slider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slider $slider)
    {
        $slider->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus'
        ]);
    }
}
