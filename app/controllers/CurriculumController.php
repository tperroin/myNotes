<?php

class CurriculumController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $curriculumns = Curriculum::all();

        $nb_curriculums = DB::table('curriculums')->count();

        return View::make('admin/curriculums/index')
            ->with(array('curriculums' => $curriculumns, 'nb_curriculum' => $nb_curriculums));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin/curriculums/create');
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
                'code' => 'required|unique:curriculums',
                'libelle' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/curriculums/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $curriculum = new Curriculum;
            $curriculum->code = Input::get('code');
            $curriculum->libelle = Input::get('libelle');
            $curriculum->time = Input::get('time');
            $curriculum->save();

            Session::flash('message', 'Cursus créé');
            return Redirect::to('admin/curriculums');
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
        $curriculum = Curriculum::find($id);

        return View::make('admin/curriculums/show')
            ->with('curriculum', $curriculum);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $curriculum = Curriculum::find($id);

        return View::make('admin/curriculums/edit')
            ->with('curriculum', $curriculum);
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
                'code' => 'required|unique:curriculums',
                'libelle' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/curriculums/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $curriculum = Curriculum::find($id);
            $curriculum->code = Input::get('code');
            $curriculum->libelle = Input::get('libelle');
            $curriculum->time = Input::get('time');
            $curriculum->save();

            Session::flash('message', 'Cursus modifié');
            return Redirect::to('admin/curriculums');
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
        $curriculum = Curriculum::find($id);

        try {
            $curriculum->delete();
            Session::flash('message', 'Cursus correctement supprimé');
            return Redirect::to('admin/curriculums');
        } catch (Illuminate\Database\QueryException $e){
            Session::flash('message_error', 'Le cursus ne peut être supprimé. Une ou plusieurs classe y est rattaché');
            return Redirect::to('admin/curriculums');
        };

	}

    public function filter()
    {
        if ( Session::token() !== Input::get( '_token' ) ) {
            return Response::json( array(
                'msg' => 'Unauthorized attempt to create setting'
            ) );
        }

        $code = Input::get( 'code' );
        $libelle = Input::get( 'libelle' );
        $time = Input::get( 'time' );

        $curriculums =
            Curriculum::
            where('code', 'LIKE', '%' . $code . '%')
                ->where('libelle', 'LIKE', '%' . $libelle . '%')
                ->where('time', 'LIKE', '%' . $time . '%')
                ->get();

        return View::make('admin/curriculums/filter')->with('curriculums', $curriculums);
    }


}
