<?php

class StudentController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $students = Student::all();

        $classrooms = DB::table('classrooms')->orderBy('code', 'asc')->lists('code','id');
        $curriculums = DB::table('curriculums')->orderBy('code', 'asc')->lists('code','id');
        $nb_students = DB::table('students')->count();

        return View::make('admin/students/index', array('classrooms' => $classrooms, 'curriculums' => $curriculums))
            ->with(array('students' => $students, 'nb_students' => $nb_students));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $classrooms = DB::table('classrooms')->orderBy('code', 'asc')->lists('code','id');

        return View::make('admin/students/create', array('classrooms' => $classrooms));
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
                'classroom' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/students/create')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $student = new Student;
            $student->firstname = Input::get('firstname');
            $student->lastname = Input::get('lastname');
            $student->classroom_id = Input::get('classroom');
            $student->save();

            if (\Illuminate\Support\Facades\Input::get('user')) {
                $user = new User;
                $user->lastname = Input::get('lastname');
                $user->firstname = Input::get('firstname');
                $user->email = Input::get('email');
                $user->username = strtolower(substr($user->firstname, 0, 1)) . "." . strtolower($user->lastname);
                $user->role_id = 3;
                $user->password = Hash::make(strtolower(substr($user->firstname, 0, 1)) . "." . strtolower($user->lastname));
                $user->save();

                $student1 = Student::find($student->id);
                $student1->user_id = $user->id;
                $student1->save();
            }

            Session::flash('message', 'Elève créé');
            return Redirect::to('admin/students');
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
        $student = Student::find($id);

        return View::make('admin/students/show')
            ->with('student', $student);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $student = Student::find($id);

        $classrooms = DB::table('classrooms')->orderBy('code', 'asc')->lists('code','id');
        return View::make('admin/students/edit', array('classrooms' => $classrooms))
            ->with('student', $student);
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
                'classroom' => 'required'
            )
        );

        if ($validator->fails()) {
            return Redirect::to('admin/students/'.$id.'/edit')
                ->withErrors($validator)
                ->withInput(Input::all());
        } else {

            $student = Student::find($id);
            $student->firstname = Input::get('firstname');
            $student->lastname = Input::get('lastname');
            $student->classroom_id = Input::get('classroom');
            $student->save();

            Session::flash('message', 'Elève modifié');
            return Redirect::to('admin/students');
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
        $student = Student::find($id);
        $student->delete();

        Session::flash('message', 'Elève correctement supprimé');
        return Redirect::to('admin/students');
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
        $classroom = Input::get( 'classroom' );
        $curriculum = Input::get( 'curriculum' );

        $students = DB::table('students')
            ->join('classrooms', 'classrooms.id', '=', 'students.classroom_id')
            ->join('curriculums', 'curriculums.id', '=', 'classrooms.curriculum_id')
            ->leftJoin('users', 'users.id', '=', 'students.user_id')
            ->where('students.firstname', 'LIKE', '%' . $firstname . '%')
            ->where('students.lastname', 'LIKE', '%' . $lastname . '%')
            ->where('students.classroom_id', 'LIKE', '%' . $classroom . '%')
            ->where('curriculums.id', 'LIKE', '%' . $curriculum . '%')
            ->select('students.firstname', 'students.lastname', 'classrooms.id as classroom_id', 'classrooms.code as classroom_code',
                'users.id as user_id', 'users.username as user_username', 'students.id')
            ->get();

        return View::make('admin/students/filter')->with('students', $students);
    }


}
