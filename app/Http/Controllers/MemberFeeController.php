<?php

namespace App\Http\Controllers;

use App\MemberFee;
use Illuminate\Http\Request;

class MemberFeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $memberfees = MemberFee::all();
        return view('memberfees.index')->with(
            ['memberfees'=>$memberfees]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('memberfees.edit')->with([
            'memberfee' => null
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $memberfee = new MemberFee();
        $memberfee->fill($request->all());
        $memberfee->save();
        return redirect()->route('memberfees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Memberfee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function show(MemberFee $memberfee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Memberfee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function edit(MemberFee $memberfee)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Memberfee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MemberFee $memberfee)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Memberfee  $memberfee
     * @return \Illuminate\Http\Response
     */
    public function destroy(MemberFee $memberfee)
    {
        //
    }
}
