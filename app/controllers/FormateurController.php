<?php

class FormateurController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $formateurs = Formateur::all();

        $nb_formateurs = DB::table('formateurs')->count();

        return View::make('admin/formateurs/index')
            ->with(array('formateurs' => $formateurs, 'nb_formateurs' => $nb_formateurs ));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin/formateurs/create');
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
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required|unique:formateurs'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/formateurs/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $formateur = new Formateur;
            $formateur->firstname = Input::get('firstname');
            $formateur->lastname = Input::get('lastname');
            $formateur->cp = Input::get('cp');
            $formateur->address = Input::get('address');
            $formateur->email = Input::get('email');
            $formateur->save();

            if (\Illuminate\Support\Facades\Input::get('user')) {
                $user = new User;
                $user->lastname = Input::get('lastname');
                $user->firstname = Input::get('firstname');
                $user->email = Input::get('email');
                $user->username = strtolower(substr($user->firstname, 0, 1)) . "." . strtolower($user->lastname);
                $user->role_id = 2;
                $user->password = Hash::make(strtolower(substr($user->firstname, 0, 1)) . "." . strtolower($user->lastname));
                $user->save();

                $formateur1 = Formateur::find($formateur->id);
                $formateur1->user_id = $user->id;
                $formateur1->save();
            }

            Session::flash('message', 'Formateur créé');
            return Redirect::to('admin/formateurs');
        }
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $formateur = Formateur::find($id);

        return View::make('admin/formateurs/show')
            ->with('formateur', $formateur);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $formateur = Formateur::find($id);

        return View::make('admin/formateurs/edit')
            ->with('formateur', $formateur);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $inputs = Input::all();

        $validator = Validator::make($inputs,
            array(
                'firstname' => 'required',
                'lastname' => 'required',
                'email' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/formateurs/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $formateur = Formateur::find($id);;
            $formateur->firstname = Input::get('firstname');
            $formateur->lastname = Input::get('lastname');
            $formateur->cp = Input::get('cp');
            $formateur->address = Input::get('address');
            $formateur->email = Input::get('email');
            $formateur->save();

            Session::flash('message', 'Formateur modifié');
            return Redirect::to('admin/formateurs');
        }
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $formateur = Formateur::find($id);

        try {
            $formateur->delete();
            Session::flash('message', 'Formateur correctement supprimé');
            return Redirect::to('admin/formateurs');
        } catch (Illuminate\Database\QueryException $e){
            Session::flash('message_error', 'Le formateur ne peut être supprimé. Il est rattaché à un ou plusieurs cours.');
            return Redirect::to('admin/formateurs');
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
        $address = Input::get( 'address' );
        $cp = Input::get( 'cp' );
        $email = Input::get( 'email' );

        $formateurs =
            Formateur::
                where('firstname', 'LIKE', '%' . $firstname . '%')
                ->where('lastname', 'LIKE', '%' . $lastname . '%')
                ->where('address', 'LIKE', '%' . $address . '%')
                ->where('cp', 'LIKE', '%' . $cp . '%')
                ->where('email', 'LIKE', '%' . $email . '%')
                ->get();

        return View::make('admin/formateurs/filter')->with('formateurs', $formateurs);
    }


}
