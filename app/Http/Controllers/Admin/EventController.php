<?php

namespace App\Http\Controllers\Admin;


use App\Helpers\AdminDataTableBadgeHelper;
use App\Helpers\AdminDataTableButtonHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\EventStoreRequest;
use App\Imports\ExcelImport;
use App\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\Facades\DataTables;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event.index');
    }

    public function getDatatable(Request $request)
    {
        if ($request->ajax()) {
            $event = Event::select('events.*');
            return Datatables::of($event)
                ->addColumn('action', function ($event) {
                    $array = [
                        'id' => $event->id,
                        'actions' => [
                            'edit' => route('admin.event.edit', [$event->id]),
                            'delete' => '',
                        ]
                    ];
                    return AdminDataTableButtonHelper::actionButtonDropdown2($array);
                })
                ->addColumn('status', function ($event) {
                    return AdminDataTableBadgeHelper::statusBadge($event);
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }

    }

    public function create()
    {
        return view('admin.event.create');
    }

    public function store(Request $request): JsonResponse
    {
//        $file = $request->file('excle');
//
//        Excel::import(new ExcelImport, $file);
//        dd('Wait');
//        print 'he;llo';

        if ((int)$request['edit_value'] === 0) {
            $event = new Event();
            $event->title = $request['name'];
            $event->save();

            return response()->json(['message' => trans('messages.event_added_successfully')]);
        }

        $event = Event::find($request['edit_value']);
        $event->title = $request['name'];
        $event->save();

        return response()->json(['message' => trans('messages.event_updated_successfully')]);
    }

    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        return view('admin.event.edit', [
            'event' => $event
        ]);
    }

    public function destroy($id): JsonResponse
    {
        Event::where('id', $id)->delete();
        return response()->json(['message' => trans('messages.event_delete_successfully')]);
    }

    public function changeStatus($id, $status): JsonResponse
    {
        Event::where('id', $id)->update(['status' => $status]);
        return response()->json(['message' => trans('messages.status_change_success')]);
    }
}
