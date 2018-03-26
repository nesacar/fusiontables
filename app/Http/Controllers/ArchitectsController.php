<?php

namespace App\Http\Controllers;

use App\Architect;
use App\Http\Requests\RegisterArchitectClubRequest;
use Illuminate\Http\Request;

class ArchitectsController extends Controller
{
    public function index(){
        $architects = Architect::select('id', 'name', 'email', 'city', 'created_at')->orderBy('created_at', 'DESC')->paginate(50);

        return response()->json([
            'architects' => $architects
        ]);
    }

    public function show($id){
        $architect = Architect::find($id);

        return response()->json([
            'architect' => $architect
        ]);
    }

    public function update(RegisterArchitectClubRequest $request, $id){
        $architect = Architect::find($id);
        $architect->update(request()->all());

        return response()->json([
            'architect' => $architect
        ]);
    }

    public function destroy($id){
        $architect = Architect::find($id);
        Architect::destroy($architect->id);
        return response()->json([
            'message' => 'deleted'
        ]);
    }
}
