<?php

namespace App\Http\Controllers\Article;

use App\Http\Controllers\Controller;
use App\Model\Article\LeaveMessageModel;
use Illuminate\Http\Request;

class LeaveMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $page = (int)$request->get('p');
        $page = empty($page) ? 1 : (int)$page;
        $offset = ($page - 1) * 10;
        // 留言的展示
        $list = LeaveMessageModel::skip($offset)->take(10)->orderBy('id', 'desc')->get();

        return view('articles.message',[
            'dataList' => $list,
            'page'=>$page,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('articles.messageForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if (!$input['username'] || !$input['email'] || !$input['message']) {
            echo '请用正确的姿势留言!';
            return;
        }
        $res = \App\Model\Article\LeaveMessageModel::create($input);
        if($res){
            return redirect('http://laravel.suhanyu.top/');
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
        $res = \App\Model\Article\LeaveMessageModel::find($id);
        return $res['message'];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
