<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateChirpRequest;
use App\Models\chirp;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
// use Illuminate\Http\Response;
use Inertia\Inertia;
use Inertia\Response;

class ChirpController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        //
    return Inertia::render('Chirps/Index', [
            // 
            'chirps' => Chirp::with('user:id,name')->latest()->get(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateChirpRequest $request): RedirectResponse
    {
        //
        // $validate = $request->validate([
        // ]);

        $request->user()->chirps()->create($request->validated());

        return redirect(route('chirps.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(chirp $chirp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(chirp $chirp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateChirpRequest $request, chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('update', $chirp);
        // $validate = $request->validate([
        //     'message' => ['required', 'string', 'max:255'],
        // ]);

        $chirp->update($request->validated());

        return redirect(route('chirps.index'));

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chirp $chirp): RedirectResponse
    {
        //
        Gate::authorize('delete', $chirp);
 
        $chirp->delete();
 
        return redirect(route('chirps.index'));
    }
}
