<?php

namespace App\Http\Controllers;

use App\Exports\MemberCouponExport;
use App\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $members = Member::sortable()->orderBy('updated_at', 'DESC')->paginate(10);

        return view('members.index', compact('members'));
    }

    public function export($type)
    {
        libxml_use_internal_errors(true);

        return Excel::download(new MemberCouponExport, 'memberCouponExport.'.$type);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('members.create');
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
        'name'=>'required|string',
        'email'=> 'required|email|unique:members'
      ]);
      $share = new Member([
        'name' => $request->get('name'),
        'email'=> $request->get('email'),
      ]);
      $share->save();
      return redirect('/members')->with('success', 'Member has been added');
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
        $member = Member::find($id);

        return view('members.edit', compact('member'));
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
          'name'=>'required|string',
          'email'=> 'required|email|unique:members,email,'.$id
      ]);

      $member = Member::find($id);
      $member->name = $request->get('name');
      $member->email = $request->get('email');
      $member->save();

      return redirect('/members')->with('success', 'Members has been updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $member = Member::find($id);
        $member->delete();

      return redirect('/members')->with('success', 'Member has been deleted Successfully');
    }
}
