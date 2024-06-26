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
use File;
class LeavereqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function insert(Request $request)
    {
        $result=new Leavereq();
        $result->rollno=$request->rollno;
        $result->name=$request->name;
        $result->phoneno=$request->phoneno;
        $result->placeofvisit=$request->placeofvisit;
        $result->purpose=$request->purpose;
        $result->outdate=$request->outdate;
        $result->outime=$request->outime;
        $result->indate=$request->indate;
        $result->intime=$request->intime;
        $result->noofdays=$request->noofdays;        
        if ($request->hasFile('image')) 
        {
            $image = $request->file('image');
            $filename = $result->rollno . '_' . $result->outdate;  
            $photoPath = $image->storeAs('leavereq_emails', $filename, 'public');
        } 
        else 
        {
            $photoPath = null;
        }
        $result->image = $photoPath;
        $result->save();
        // DB::insert('insert into leavereqs (rollno,name,phoneno,placeofvisit,purpose,outdate,outime
        // ,indate,intime,noofdays,path) values(?,?,?,?,?,?,?,?,?,?,?)',[$rollno,$name,
        // $phoneno,$placeofvisit,$purpose,$outdate,$outtime,$indate,$intime,$noofdays,$photoPath] );
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
