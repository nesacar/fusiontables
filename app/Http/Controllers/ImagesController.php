<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;
use File;

class ImagesController extends Controller
{
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Image::find($id);
        File::delete($image->file_path);
        File::delete($image->file_path_small);
        $image->delete();

        return response()->json([
            'image' => $image
        ]);
    }
}
