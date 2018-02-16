<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Box;

class BoxController extends Controller
{
    /**
     * The rules for a valid model
     * @var Array
     */
    private $rules = [
        'description' => 'required|string|max:255',
        'room_id' => 'required|exists:rooms,id',
    ];

    /**
     * Display a listing of the resource
     * @param  Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('boxes.index', [
            'boxes' => Box::all()
                ->sortBy(function ($box) {
                    return $box->room->name . ' ' . str_pad($box->room_box_number, 3, '0', STR_PAD_LEFT);
                }),
            'breadcrumbs' => [
                [
                    'text' => 'Boxes',
                    'url' => route('boxes.index'),
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
            ->route('boxes.index');
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

        // Get the room
        $room = \App\Room::find($request->input('room_id'));

        // Create the new item
        $box = new Box([
            'description' => $request->input('description'),
            'room_id' => $request->input('room_id'),
            'room_box_number' => $room->boxes->max('room_box_number') + 1,
        ]);

        // Save the box
        $box->save();

        // Redirect to the box page
        return redirect()
            ->route('boxes.show', [
                'box' => $box,
            ]);
    }

    /**
     * Display a specific resource
     * @param  Box $box
     * @return View
     */
    public function show(Box $box)
    {
        // Return the view
        return view('boxes.show', [
            'box' => $box,
            'title' => $box->description,
            'breadcrumbs' => [
                [
                    'text' => $box->room->name,
                    'url' => route('rooms.show', [
                        'room' => $box->room,
                    ]),
                ],
                [
                    'text' => $box->room->name . ' ' . $box->room_box_number,
                    'url' => route('boxes.show', [
                        'box' => $box,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Show the form for updating the resource
     * @param  Box $box
     * @return View
     */
    public function edit(Box $box)
    {
        // Return the view
        return view('boxes.edit', [
            'box' => $box,
            'title' => 'Edit ' . $box->name,
            'breadcrumbs' => [
                [
                    'text' => 'Boxes',
                    'url' => route('boxes.index'),
                ],
                [
                    'text' => $box->name,
                    'url' => route('boxes.show', [
                        'box' => $box,
                    ]),
                ],
                [
                    'text' => 'Edit ' . $box->name,
                    'url' => route('boxes.edit', [
                        'box' => $box,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource
     * @param  Request $request
     * @param  Box    $box
     * @return Redirect
     */
    public function update(Request $request, Box $box)
    {
        // Validate the request
        $request->validate($this->rules);

        // Save the box
        $box->name = $request->input('name');
        $box->save();

        // Return the redirect
        return redirect()
            ->route('boxes.show', [
                'box' => $box,
            ])
            ->with([
                'message' => 'Box Updated',
            ]);
    }

    /**
     * Remove the specified resource
     * @param  Box $box
     * @return Redirect
     */
    public function destroy(Box $box)
    {
        // Verify there are no boxes assigned
        if ($box->boxes->count() > 0) {
            return redirect()
                ->route('boxes.show', [
                    'box' => $box,
                ])
                ->with([
                    'error' => 'This box still has boxes. Delete boxes before deleting the boxes.',
                ]);
        }

        // Delete the box
        $box->delete();

        // Return to the home screen
        return redirect('boxes.index')
            ->with([
                'message' => $box->name . ' Deleted',
            ]);
    }
}
