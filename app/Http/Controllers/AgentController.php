<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class AgentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/agents');
        $agents = $response->json();

        return view('pages.agents', compact('agents'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:2',
            'surname' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'avatar' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('avatar');
        $imagePath = $image->getPathname();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY'),
        ])->attach(
            'avatar',
            file_get_contents($imagePath),
            $image->getClientOriginalName()
        )->post('https://api.real-estate-manager.redberryinternship.ge/api/agents', [
            'name' => $validatedData['name'],
            'surname' => $validatedData['surname'],
            'email' => $validatedData['email'],
            'phone' => $validatedData['phone'],
        ]);

        if ($response->successful()) {
            return redirect()->back()->with('success', 'აგენტი წარმატებით დაემატა!');
        } else {
            return redirect()->back()->withErrors('Failed to add agent');
        }
    }
}
