<?php

class ClassroomController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $classrooms = Classroom::all();

        $nb_classrooms = DB::table('classrooms')->count();
        $nb_students_by_classroom = DB::table('classrooms')
            ->join('students', 'classrooms.id', '=', 'students.classroom_id')
            ->select('classrooms.id', DB::raw('count(*) as total'))
            ->groupBy('classrooms.id')
            ->get();

        $curriculums = DB::table('curriculums')->orderBy('code', 'asc')->lists('code','id');

        return View::make('admin/classrooms/index', array('curriculums' => $curriculums))
            ->with(array('classrooms' => $classrooms, 'nb_classrooms' => $nb_classrooms, 'nb_students_by_classroom' => $nb_students_by_classroom));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $curriculums = DB::table('curriculums')->orderBy('code', 'asc')->lists('code','id');

        return View::make('admin/classrooms/create', array('curriculums' => $curriculums));
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
                'code' => 'required|unique:classrooms',
                'libelle' => 'required',
                'curriculum' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/classrooms/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $curriculum = new Classroom;
            $curriculum->code = Input::get('code');
            $curriculum->libelle = Input::get('libelle');
            $curriculum->curriculum_id = Input::get('curriculum');
            $curriculum->save();

            Session::flash('message', 'Classe créée');
            return Redirect::to('admin/classrooms');
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
        $classroom = Classroom::find($id);

        return View::make('admin/classrooms/show')
            ->with('classroom', $classroom);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $classroom = Classroom::find($id);

        $curriculums = DB::table('curriculums')->orderBy('code', 'asc')->lists('code','id');
        return View::make('admin/classrooms/edit', array('curriculums' => $curriculums))
            ->with('classroom', $classroom);
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
                'code' => 'required|unique:classrooms',
                'libelle' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/classrooms/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $classroom = Classroom::find($id);
            $classroom->code = Input::get('code');
            $classroom->libelle = Input::get('libelle');
            $classroom->save();

            Session::flash('message', 'Classe modifiée');
            return Redirect::to('admin/classrooms');
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
        $classroom = Classroom::find($id);

        try {
            $classroom->delete();
            Session::flash('message', 'Classe correctement supprimée');
            return Redirect::to('admin/classrooms');
        } catch (Illuminate\Database\QueryException $e){
            Session::flash('message_error', 'La classe ne peut être supprimée. Un ou plusieurs élèves y sont rattachés');
            return Redirect::to('admin/classrooms');
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
        $curriculum = Input::get( 'curriculum' );

        $nb_students_by_classroom = DB::table('classrooms')
            ->join('students', 'classrooms.id', '=', 'students.classroom_id')
            ->select('classrooms.id', DB::raw('count(*) as total'))
            ->groupBy('classrooms.id')
            ->get();

        $classrooms =
            Classroom::
            where('code', 'LIKE', '%' . $code . '%')
                ->where('curriculum_id', 'LIKE', '%' . $curriculum . '%')
                ->get();

        return View::make('admin/classrooms/filter')->with(array('classrooms' => $classrooms, 'nb_students_by_classroom' => $nb_students_by_classroom));
    }


}
