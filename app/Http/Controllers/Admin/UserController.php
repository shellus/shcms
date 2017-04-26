<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Service\UserService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{

    /** @var  Model $modelClass */
    protected $modelClass = User::class;
    protected $service;
    protected $trans;
    protected $name;
    protected $view;

    /**
     * UserController constructor.
     */
    public function __construct(UserService $service)
    {
        $this->trans = trans("model.{$this -> modelClass}");
        $this->service = $service;
        $this->name = $this->trans['name'];
        $this->view = new \View();


//        $this->view->offsetSet('trans',$this->trans);
    }


    public function index()
    {
        return view("admin::{$this->name}/index", ['trans' => $this->trans]);
    }

    public function create()
    {
        $model = new User();
        return view("admin::{$this->name}/edit", ['model' => $model, 'trans' => $this->trans]);
    }

    public function store()
    {
        $this->service->create();
    }

    public function destroy($id)
    {
        $rows = User::findOrFail($id)->delete();
        return $this->success('删除成功');
    }

    public function edit(User $user)
    {
        return view("admin::{$this->name}/edit", ['model' => $user, 'trans' => $this->trans]);
    }

    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
        ]);
        $params = $request->all();
        $user->name = data_get($params, 'name');
        $user->email = data_get($params, 'email');
        $user->api_token = data_get($params, 'api_token');
        if ($user->save()) {
            return redirect(route('admin.user.index'));
        }
        return redirect()->back()->withInput()->withErrors(trans('common.edit.failed'));

    }

    public function show(User $user)
    {

    }
}
