<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemController extends Controller
{
    /**
     * The rules for a valid model
     * @var Array
     */
    private $rules = [
        'name' => 'required|string|max:100',
        'box_id' => 'required|exists:boxes,id',
        'description' => 'nullable|string|max:255',
        'barcode' => 'nullable|string|max:255',
        'model' => 'nullable|string|max:255',
        'serial' => 'nullable|string|max:255',
    ];

    /**
     * Display a listing of the resource
     * @param  Request $request
     * @return View
     */
    public function index(Request $request)
    {
        return view('items.index', [
            'items' => Item::all()
                ->sortBy('name'),
            'breadcrumbs' => [
                [
                    'text' => 'Items',
                    'url' => route('items.index'),
                ],
            ],
        ]);
    }

    /**
     * Return the view used for creation
     * @param  Request $request
     * @return View
     */
    public function create(Request $request)
    {
        // @TODO: Make this work
        return redirect()
            ->route('items.index');
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
        $item = new Item([
            'name' => $request->input('name'),
            'description' => $request->input('description', null),
            'barcode' => $request->input('barcode', null),
            'model' => $request->input('model', null),
            'serial' => $request->input('serial', null),
            'box_id' => $request->input('box_id'),
        ]);

        // Save the item
        $item->save();

        // Redirect to the create item page
        return redirect()
            ->route('items.create', [
                'box' => $request->input('box_id'),
            ]);
    }

    /**
     * Display a specific resource
     * @param  Item $item
     * @return View
     */
    public function show(Item $item)
    {
        // Return the view
        return view('items.show', [
            'item' => $item,
            'title' => $item->name,
            'breadcrumbs' => [
                [
                    'text' => $item->box->room->name,
                    'url' => route('rooms.show', [
                        'room' => $item->box->room,
                    ]),
                ],
                [
                    'text' => $item->box->room->name . ' ' . $item->box->room_box_number,
                    'url' => route('boxes.show', [
                        'box' => $item->box,
                    ]),
                ],
                [
                    'text' => $item->name,
                    'url' => route('items.show', [
                        'item' => $item,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Show the form for updating the resource
     * @param  Item $item
     * @return View
     */
    public function edit(Item $item)
    {
        // Return the view
        return view('items.edit', [
            'item' => $item,
            'title' => 'Edit ' . $item->name,
            'breadcrumbs' => [
                [
                    'text' => $item->box->room->name,
                    'url' => route('rooms.show', [
                        'room' => $item->box->room,
                    ]),
                ],
                [
                    'text' => $item->box->room->name . ' ' . $item->box->room_box_number,
                    'url' => route('boxes.show', [
                        'box' => $item->box,
                    ]),
                ],
                [
                    'text' => $item->name,
                    'url' => route('items.show', [
                        'item' => $item,
                    ]),
                ],
                [
                    'text' => 'Edit ' . $item->name,
                    'url' => route('items.edit', [
                        'item' => $item,
                    ]),
                ],
            ],
        ]);
    }

    /**
     * Update the specified resource
     * @param  Request $request
     * @param  Item    $item
     * @return Redirect
     */
    public function update(Request $request, Item $item)
    {
        // Validate the request
        $request->validate($this->rules);

        // Save the item
        $item->name = $request->input('name');
        $item->box_id = $request->input('box_id');
        $item->description = $request->input('description', null);
        $item->barcode = $request->input('barcode', null);
        $item->model = $request->input('model', null);
        $item->serial = $request->input('serial', null);
        $item->save();

        // Return the redirect
        return redirect()
            ->route('items.show', [
                'item' => $item,
            ])
            ->with([
                'message' => 'Item Updated',
            ]);
    }

    /**
     * Remove the specified resource
     * @param  Item $item
     * @return Redirect
     */
    public function destroy(Item $item)
    {
        // Delete the item
        $item->delete();

        // Return to the home screen
        return redirect('items.index')
            ->with([
                'message' => $item->name . ' Deleted',
            ]);
    }
}
