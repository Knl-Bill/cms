<?php

namespace App\Http\Controllers;

use App\Models\leavereq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Hash;
use Carbon\Carbon;

class LeavereqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $rollno = $request->input('rollno');
        $name= $request->input('name');
        $phoneno= $request->input('phoneno');
        $placeofvisit= $request->input('placeofvisit');
        $purpose= $request->input('purpose');
        $outdate= Carbon::parse($request->input('outdate'))->format('Y-m-d');
        $outtime= Carbon::parse($request->input('outime'))->format('H:i:s');
        $indate= Carbon::parse($request->input('indate'))->format('Y-m-d');
        $intime= Carbon::parse($request->input('intime'))->format('H:i:s');
        $noofdays= $request->input('noofdays');
        DB::insert('insert into leavereqs (rollno,name,phoneno,placeofvisit,purpose,outdate,outime
        ,indate,intime,noofdays) values(?,?,?,?,?,?,?,?,?,?)',[$rollno,$name,
        $phoneno,$placeofvisit,$purpose,$outdate,$outtime,$indate,$intime,$noofdays] );
        echo "Record inserted successfully.<br/>";   
    }

    public function show_leave_det()
    {
        $students = DB::select('select * from leavereqs');
        return view('show_stud_det',['students'=>$students]);
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
     * @param  \App\Models\leavereq  $leavereq
     * @return \Illuminate\Http\Response
     */
    public function show(leavereq $leavereq)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\leavereq  $leavereq
     * @return \Illuminate\Http\Response
     */
    public function edit(leavereq $leavereq)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\leavereq  $leavereq
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, leavereq $leavereq)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\leavereq  $leavereq
     * @return \Illuminate\Http\Response
     */
    public function destroy(leavereq $leavereq)
    {
        //
    }
}
