<?php

namespace App\Http\Controllers;

use App\Position;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $position = Position::latest()->paginate(10);
        return view ('admin.position.index', [
            'data' => $position
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('admin.position.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255'
        ],[
            'name.required' => 'Yêu cầu không để trống'
        ]);

        $position = new Position();
        $position->name = $request->input('name');

        $is_active = "0";
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
            $position->is_active = $is_active;
        }

        $position->save();

        return redirect()->route('admin.position.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Position::all();
        $position = Position::findOrFail($id);
        return view ('admin.position.edit', [
            'data' => $data,
            'position' => $position
        ]);
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
        $request->validate([
            'name' => 'required|max:255'
        ],[
            'name.required' => 'Yêu cầu không để trống'
        ]);

        $position = Position::findOrFail($id);
        $position->name = $request->input('name');
        
        $is_active = "0";
        if ($request->has('is_active')) {//kiem tra is_active co ton tai khong?
            $is_active = $request->input('is_active');
            $position->is_active = $is_active;
        }
        $position->save();

        return redirect()->route('admin.position.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Position::destroy($id);

        $dataResp = [
            'status' => true
        ];

        return response()->json($dataResp, 200);
    }
}
