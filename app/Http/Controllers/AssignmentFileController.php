<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use App\Models\AssignmentFile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\DataTables;
use ZipArchive;

class AssignmentFileController extends BaseController
{

    public function __construct()
    {
        $this->title = 'Assignment Files';
        $this->route = 'assignmentFiles';
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {


        if ($request->ajax()) {
            if ($assignment_id = $request->assignment_id) {
                $data = AssignmentFile::where('assignment_id', $assignment_id)->latest();
            } else {
                $data = AssignmentFile::latest();
            }

            return DataTables::of($data)

                ->addIndexColumn()

                ->addColumn('action', function ($row) {

                    return view('templates.action_list', [
                        'id' => $row->id,
                        'route' => $this->route,
                        'item' => $row,
                        'isShow' => True,
                        'isEdit' => False,
                        'isDelete' => True,
                    ]);
                })

                ->editColumn('created_at', function ($row) {

                    return $row->created_at->format('Y-m-d H:i');
                })

                ->addColumn('assignment_id', function ($row) {
                    // dd($row->patient->name);
                    return $row->assignment_id ? $row?->assignment?->title : "--";
                })

                ->rawColumns(['action'])


                ->make(true);
        }
        confirmDelete('Confirm Delete?', 'Do you want to Assignment File it?');
        $data = $this->curdInfo();
        return view('assignmentFile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = $this->curdInfo();
        $data['item'] = new AssignmentFile();
        return view('assignmentFile.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'assignment_id' => 'required|numeric',
            'user_name' => 'required|string|max:255',
            'zipFile' => 'required|file|max:2048',
        ]);
        $doc = $request->zipFile;
        $doc_name = $doc->getClientOriginalName();
        $doc_name = $request->user_name . '_' . $doc_name;
        $doc->move(public_path('storage/docs'), $doc_name);
        AssignmentFile::create([
            'assignment_id' => $request->assignment_id,
            'user_name' => $request->user_name,
            'file_name' => $doc_name,
        ]);
        Alert::success('Assignment Submitted!', 'Successfully submitted the  assignment');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(AssignmentFile $assignmentFile)
    {

        $data = $this->curdInfo();
        $data['item'] = $assignmentFile;
        return view('assignmentFile.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AssignmentFile $assignmentFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AssignmentFile $assignmentFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AssignmentFile $assignmentFile)
    {
        $doc_names = $assignmentFile->file_name;
        $doc_path = public_path() . '/storage/docs/';
        $file = $doc_path . $doc_names;
        if (file_exists($file)) {
            unlink($file);
        }
        $assignmentFile->delete();
        Alert::success('Assignment File Deleted!', 'Successfully deleted the  assignment file');
        return redirect()->route('assignmentFiles.index');
    }
}
