<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomController extends Controller
{
    /**
     * The rules for a valid model
     * @var Array
     */
    private $rules = [
        'name' => 'required|string|max:255',
    ];

    /**
     * Display a listing of the resource
     * @param  Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('rooms.index', [
            'rooms' => Room::all(),
            'breadcrumbs' => [
                [
                    'text' => 'Rooms',
                    'url' => route('rooms.index'),
                ],
            ],
        ]);
    }

    /**
     * Redirect to the index page for creation
     * @return Redirect
     */
    public function create()
    {
        return redirect()
            ->route('rooms.index');
    }

    /**
     * Store a newly created resource
     * @param  Request $request
     * @return Redirect
     */
    public function store(Request $request)
    {
        // Validate the request
        $request->validate($this->rules);

        // Create the new item
        $room = new Room([
            'name' => $request->input('name'),
        ]);

        // Save the room
        $room->save();

        // Redirect to the room page
        return redirect()
            ->route('rooms.show', [
                'room' => $room,
            ]);
    }

    /**
     * Display a specific resource
     * @param  Room $room
     * @return View
     */
    public function show(Room $room)
    {
        // Return the view
        return view('rooms.show', [
            'room' => $room,
            'title' => $room->name,
            'breadcrumbs' => [
                [
                    'text' => 'Rooms',
                    'url' => route('rooms.index'),
                ],
                [
                    'text' => $room->name,
                    'url' => route('rooms.show', [
                        'room' => $room,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Show the form for updating the resource
     * @param  Room $room
     * @return View
     */
    public function edit(Room $room)
    {
        // Return the view
        return view('rooms.edit', [
            'room' => $room,
            'title' => 'Edit ' . $room->name,
            'breadcrumbs' => [
                [
                    'text' => 'Rooms',
                    'url' => route('rooms.index'),
                ],
                [
                    'text' => $room->name,
                    'url' => route('rooms.show', [
                        'room' => $room,
                    ]),
                ],
                [
                    'text' => 'Edit ' . $room->name,
                    'url' => route('rooms.edit', [
                        'room' => $room,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource
     * @param  Request $request
     * @param  Room    $room
     * @return Redirect
     */
    public function update(Request $request, Room $room)
    {
        // Validate the request
        $request->validate($this->rules);

        // Save the room
        $room->name = $request->input('name');
        $room->save();

        // Return the redirect
        return redirect()
            ->route('rooms.show', [
                'room' => $room,
            ])
            ->with([
                'message' => 'Room Updated',
            ]);
    }

    /**
     * Remove the specified resource
     * @param  Room $room
     * @return Redirect
     */
    public function destroy(Room $room)
    {
        // Verify there are no boxes assigned
        if ($room->boxes->count() > 0) {
            return redirect()
                ->route('rooms.show', [
                    'room' => $room,
                ])
                ->with([
                    'error' => 'This room still has boxes. Delete boxes before deleting the rooms.',
                ]);
        }

        // Delete the room
        $room->delete();

        // Return to the home screen
        return redirect('rooms.index')
            ->with([
                'message' => $room->name . ' Deleted',
            ]);
    }
}
