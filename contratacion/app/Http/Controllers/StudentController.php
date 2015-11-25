<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;
use Mitul\Controller\AppBaseController;
use Response;
use Flash;
use Schema;

class StudentController extends AppBaseController
{

	/**
	 * Display a listing of the Post.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 */
	public function index(Request $request)
	{
		$query = Student::query();
        $columns = Schema::getColumnListing('$TABLE_NAME$');
        $attributes = array();

        foreach($columns as $attribute){
            if($request[$attribute] == true)
            {
                $query->where($attribute, $request[$attribute]);
                $attributes[$attribute] =  $request[$attribute];
            }else{
                $attributes[$attribute] =  null;
            }
        };

        $students = $query->get();

        return view('students.index')
            ->with('students', $students)
            ->with('attributes', $attributes);
	}

	/**
	 * Show the form for creating a new Student.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('students.create');
	}

	/**
	 * Store a newly created Student in storage.
	 *
	 * @param CreateStudentRequest $request
	 *
	 * @return Response
	 */
	public function store(CreateStudentRequest $request)
	{
        $input = $request->all();

		$student = Student::create($input);

		Flash::message('Student saved successfully.');

		return redirect(route('students.index'));
	}

	/**
	 * Display the specified Student.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function show($id)
	{
		$student = Student::find($id);

		if(empty($student))
		{
			Flash::error('Student not found');
			return redirect(route('students.index'));
		}

		return view('students.show')->with('student', $student);
	}

	/**
	 * Show the form for editing the specified Student.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$student = Student::find($id);

		if(empty($student))
		{
			Flash::error('Student not found');
			return redirect(route('students.index'));
		}

		return view('students.edit')->with('student', $student);
	}

	/**
	 * Update the specified Student in storage.
	 *
	 * @param  int    $id
	 * @param CreateStudentRequest $request
	 *
	 * @return Response
	 */
	public function update($id, CreateStudentRequest $request)
	{
		/** @var Student $student */
		$student = Student::find($id);

		if(empty($student))
		{
			Flash::error('Student not found');
			return redirect(route('students.index'));
		}

		$student->fill($request->all());
		$student->save();

		Flash::message('Student updated successfully.');

		return redirect(route('students.index'));
	}

	/**
	 * Remove the specified Student from storage.
	 *
	 * @param  int $id
	 *
	 * @return Response
	 */
	public function destroy($id)
	{
		/** @var Student $student */
		$student = Student::find($id);

		if(empty($student))
		{
			Flash::error('Student not found');
			return redirect(route('students.index'));
		}

		$student->delete();

		Flash::message('Student deleted successfully.');

		return redirect(route('students.index'));
	}
}
