<?php

class UserController extends \BaseController
{

    /**
     * Display a listing of users.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::all();
        $roles = DB::table('roles')->orderBy('name', 'desc')->lists('name','id');
        $nb_users = DB::table('users')->count();
        return View::make('admin/users/index', array('roles' => $roles))
            ->with(array('users' => $users, 'nb_users' => $nb_users));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $roles = DB::table('roles')->orderBy('name', 'desc')->lists('name','id');

        return View::make('admin/users/create', array('roles' => $roles));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createStudent($id)
    {
        $student = Student::find($id);

        $roles = DB::table('roles')->orderBy('name', 'desc')->lists('name','id');

        return View::make('admin/users/createFromStudent', array('roles' => $roles))
            ->with('student', $student);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeStudent()
    {
        $inputs = Input::all();

        $validator = Validator::make($inputs,
            array(
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required|min:8'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $user = new User;
            $user->lastname = Input::get('lastname');
            $user->firstname = Input::get('firstname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->role_id = Input::get('role');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            $student = Student::find(Input::get('id'));
            $student->user_id = $user->id;
            $student->save();

            Session::flash('message', 'Utilisateur créé');
            return Redirect::to('admin/users');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createFormateur($id)
    {
        $formateur = Formateur::find($id);

        $roles = DB::table('roles')->orderBy('name', 'desc')->lists('name','id');

        return View::make('admin/users/createFromFormateur', array('roles' => $roles))
            ->with('formateur', $formateur);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function storeFormateur()
    {
        $inputs = Input::all();

        $validator = Validator::make($inputs,
            array(
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required|min:8'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $user = new User;
            $user->lastname = Input::get('lastname');
            $user->firstname = Input::get('firstname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->role_id = Input::get('role');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            $formateur = Formateur::find(Input::get('id'));

            $formateur->user_id = $user->id;
            $formateur->save();

            Session::flash('message', 'Utilisateur créé');
            return Redirect::to('admin/users');
        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $inputs = Input::all();

        $validator = Validator::make($inputs,
            array(
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email|unique:users',
                'username' => 'required|unique:users',
                'password' => 'required|min:8'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/users/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $user = new User;
            $user->lastname = Input::get('lastname');
            $user->firstname = Input::get('firstname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->role_id = Input::get('role');
            $user->password = Hash::make(Input::get('password'));
            $user->save();

            Session::flash('message', 'Utilisateur créé');
            return Redirect::to('admin/users');
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return View::make('admin/users/show')
            ->with('user', $user);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        $roles = DB::table('roles')->orderBy('name', 'desc')->lists('name','id');
        return View::make('admin/users/edit', array('roles' => $roles))
            ->with('user', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        $inputs = Input::all();

        $validator = Validator::make($inputs,
            array(
                'lastname' => 'required',
                'firstname' => 'required',
                'email' => 'required|email',
                'username' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {

            $user = User::find($id);
            $user->lastname = Input::get('lastname');
            $user->firstname = Input::get('firstname');
            $user->email = Input::get('email');
            $user->username = Input::get('username');
            $user->role_id = Input::get('role');
            $user->save();

            Session::flash('message', 'Utilisateur modifié');
            return Redirect::to('admin/users');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        try {
            $user->delete();
            Session::flash('message', 'Utilisateur correctement supprimé');
            return Redirect::to('admin/users');
        } catch (Illuminate\Database\QueryException $e){
            Session::flash('message_error', "L'utilisateur ne peut être supprimé, un compte formateur ou utilisateur lui est rattaché.");
            return Redirect::to('admin/users');
        };
    }

    public function filter()
    {
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $firstname = Input::get( 'firstname' );
        $lastname = Input::get( 'lastname' );
        $username = Input::get( 'username' );
        $email = Input::get( 'email' );
        $role = Input::get( 'role' );

        $users =
            User::
            where('firstname', 'LIKE', '%' . $firstname . '%')
                ->where('lastname', 'LIKE', '%' . $lastname . '%')
                ->where('username', 'LIKE', '%' . $username . '%')
                ->where('role_id', 'LIKE', '%' . $role . '%')
                ->where('email', 'LIKE', '%' . $email . '%')
                ->get();

        return View::make('admin/users/filter')->with('users', $users);
    }
}
