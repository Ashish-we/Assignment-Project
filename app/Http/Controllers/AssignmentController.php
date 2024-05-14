<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentFile;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use PhpParser\Node\Expr\AssignRef;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;

class AssignmentController extends BaseController
{

    public function __construct()
    {
        $this->title = 'Assignments';
        $this->route = 'assignments';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = Assignment::latest();

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    return view('templates.action_list', [
                        'id' => $row->id,
                        'route' => $this->route,
                        'item' => $row,
                        'isShow' => True,
                        'isEdit' => True,
                        'isDelete' => True,
                    ]);
                })

                ->rawColumns(['action'])


                ->make(true);
        }
        confirmDelete('Confirm Delete?', 'Do you want to Assignment it?');
        $data = $this->curdInfo();
        return view('assignment.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->curdInfo();
        $data['item'] = new Assignment();
        return view('assignment.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:2000',
        ]);

        Assignment::create($data);
        Alert::success('Assignment Added!', 'Successfully added the assignment');
        return redirect()->route('assignments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Assignment $assignment, Request $request)
    {
        $data = $this->curdInfo();
        $data['item'] = $assignment;
        return view('assignment.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assignment $assignment)
    {
        $data = $this->curdInfo();
        $data['item'] = $assignment;
        return view('assignment.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Assignment $assignment)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'details' => 'required|string|max:2000',
        ]);

        $assignment->update($data);
        Alert::success('Assignment Updated!', 'Successfully updated the assignment');
        return redirect()->route('assignments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assignment $assignment)
    {

        $assignment_files = $assignment->assignmentFiles;
        if ($assignment_files) {
            foreach ($assignment_files as $assignmentFile) {
                $assignmentFile->delete();
            }
        }
        $assignment->delete();
        Alert::success('Assignment Deleted!', 'Successfully deleted the assignment');
        return redirect()->route('assignments.index');
    }
}
