<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{

    /** @var  Model $modelClass */
    protected $modelClass = \App\User::class;
    protected $trans;
    protected $name;
    protected $view;

    /**
     * UserController constructor.
     */
    public function __construct()
    {
        $this->trans = trans("model.{$this -> modelClass}");
        $this->name = $this->trans['name'];
        $this->view = new \View();


        $this->view->offsetSet('trans',$this->trans);
    }

    public function index()
    {
        return view("admin::{$this->name}/index",['trans'=>$this->trans]);
    }

    public function destroy($id)
    {
        $rows = User::findOrFail($id)->delete();
        return $this->success('删除成功');
    }

    public function edit(User $user)
    {
        return view("admin::{$this->name}/edit",['model' => $user,'trans'=>$this->trans]);
    }
}
