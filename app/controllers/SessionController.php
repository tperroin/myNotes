<?php

class SessionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $sessions = Sessions::orderBy('date', 'DESC')->get();
        $nb_sessions = DB::table('sessions')->count();

        return View::make('manage/sessions/index')->with(array('sessions' => $sessions, 'nb_sessions' => $nb_sessions));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        $classrooms = DB::table('classrooms')->orderBy('code', 'desc')->lists('code','id');
        $courses = DB::table('cours')->orderBy('libelle', 'desc')->lists('libelle','id');
        $formateurs = DB::table('formateurs')->orderBy('lastname', 'desc')->lists('lastname','id');
        $students = DB::table('students')->orderBy('lastname', 'desc')->lists('lastname','id');

        return View::make('manage/sessions/create', array(
            'classrooms' => $classrooms, 'courses' => $courses,
            'formateurs' => $formateurs, 'students' => $students
        ));
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
                'date' => 'required',
                'cours' => 'required',
                'formateur' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('sessions/create')
                ->withErrors($validator)
                ->withInput();
        } else {

            $session = new Sessions;
            $session->date = new DateTime(Input::get('date'));
            $session->cours_id = Input::get('cours');
            $session->formateur_id = Input::get('formateur');
            $session->save();

            if (Input::get('classroom')) {
                $students = DB::table('classrooms')
                    ->join('students', 'classrooms.id', '=', 'students.classroom_id')
                    ->select('students.id')
                    ->get();

                foreach($students as $key => $input) {
                    DB::table('sessions_student')->insert(
                        array('sessions_id' => $session->id, 'student_id' => $input->id)
                    );
                }
            }

            if(Input::get('students')[0]) {
                foreach(Input::get('students') as $key => $input) {
                    DB::table('sessions_student')->insert(
                        array('sessions_id' => $session->id, 'student_id' => $input)
                    );
                }
            }

            Session::flash('message', 'Session créée');
            return Redirect::to('sessions');
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
        $session = Sessions::find($id);

        return View::make('manage/sessions/show')->with('session', $session);
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
