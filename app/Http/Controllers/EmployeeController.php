<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $employees = Employee::orderBy('id','desc')->paginate(2);
        return view('index',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email|email',
            'joining_date' => 'required',
            'salary' => 'required'
        ],[
            'email.unique' => 'email already exists'
        ]);
        $data = $request->except('_token');
        Employee::create($data);
        
        return redirect()->route('employee.index')
        ->withMessage('Employee has been created successfully');
    }

    /**
     * Display the specified resource.
     */
    // public function show(string $id)
    // {
    //     //
    // }

    public function show(Employee $employee)
    {
        return view('show',compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        // $employee = Employee::find($id);
        return view('edit',compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     */
    // public function update(Request $request, string $id)
    // {
    //     $data = $request->all();
    //     $employee = Employee::find($id);
    //     $employee->update($data);
    // }

    public function update(Request $request, Employee $employee)
    {
        // dd($employee);
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:employees,email,'.$employee->id.'|email',
            'joining_date' => 'required',
            'salary' => 'required'
        ],[
            'email.unique' => 'email already exists'
        ]);
        $data = $request->all();
        // $employee = Employee::find($id);
        $employee->update($data);
        // dd('successfully updated');
        return redirect()->route('employee.edit',$employee->id)
        ->withSuccess('Employee details updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employee.index')
        ->withMessage('Employee deleted successfully');
    }
}
