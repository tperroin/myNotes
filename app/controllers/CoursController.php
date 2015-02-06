<?php

class CoursController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $courses = Cours::all();

        $nb_cours = DB::table('cours')->count();

        return View::make('admin/courses/index')
            ->with(array('courses' => $courses, 'nb_cours' => $nb_cours));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin/courses/create');
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
                'libelle' => 'required',
                'time' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/courses/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $cours = new Cours;
            $cours->libelle = Input::get('libelle');
            $cours->time = Input::get('time');
            $cours->save();

            Session::flash('message', 'Cours créé');
            return Redirect::to('admin/courses');
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
        $cours = Cours::find($id);

        return View::make('admin/courses/show')
            ->with('cours', $cours);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{

        $cours = Cours::find($id);

        return View::make('admin/courses/edit')
            ->with('cours', $cours);
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
                'libelle' => 'required',
                'time' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/courses/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $cours = Cours::find($id);
            $cours->libelle = Input::get('libelle');
            $cours->time = Input::get('time');
            $cours->save();

            Session::flash('message', 'Cours modifié');
            return Redirect::to('admin/courses');
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
        $cours = Cours::find($id);
        $cours->delete();

        Session::flash('message', 'Cours correctement supprimé');
        return Redirect::to('admin/courses');
	}


}
