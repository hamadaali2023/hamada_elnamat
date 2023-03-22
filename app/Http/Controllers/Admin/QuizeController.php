<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Quize;
use Illuminate\Http\Request;

class QuizeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Quize  $quize
     * @return \Illuminate\Http\Response
     */
    public function show(Quize $quize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Quize  $quize
     * @return \Illuminate\Http\Response
     */
    public function edit(Quize $quize)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Quize  $quize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Quize $quize)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Quize  $quize
     * @return \Illuminate\Http\Response
     */
    public function destroy(Quize $quize)
    {
        //
    }
}
