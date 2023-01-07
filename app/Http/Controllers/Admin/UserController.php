<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\StoreUpdateUser;


class UserController extends Controller
{
    private $repository;

    public function __construct(User $user)
    {
        $this->repository = $user;

        $this->middleware(['can:users']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->repository->latest()->tenantUser()->paginate();

        return view('admin.pages.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateUser $request)
    {   
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        $data['tenant_id'] = $tenant->id;
        $data['password'] = Hash::make($request->password);

        $this->repository->create($data);

        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->repository->tenantUser()->find($id);
        if(!$user)
            return redirect()->back();
        
        return view('admin.pages.users.show', compact('user'));
    }

     /**
     * Search the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $filters = $request->only('filter');
        
        $users = $this->repository->where(function($query) use($request){
            $query->where('name', 'LIKE', "%{$request->filter}%");
            $query->orWhere('email', 'LIKE', "%{$request->filter}%");
            
        })
        ->latest()
        ->tenantUser()
        ->paginate();
        
    
        return view('admin.pages.users.index', compact('users','filters'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->repository->tenantUser()->where('id', $id)->first();
        if(!$user)
            return redirect()->back();
        
        return view('admin.pages.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateuser $request, $id)
    {
        $user = $this->repository->tenantUser()->where('id', $id)->first();
        if(!$user)
            return redirect()->back();

        $data = $request->only(['name', 'email']);
        if($request->password)
            $data['password'] = Hash::make($request->password);


        $user->update($data);
        return redirect()->route('users.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->repository->tenantUser()->find($id);
        if(!$user)
            return redirect()->back();
        
        //$this->repository->destroy($id);
        $user->delete();
        return redirect()->route('users.index');
    }
}
