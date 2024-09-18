<?php

namespace App\Http\Controllers;

use App\Models\Listings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class ListingsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $region = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/regions');

        $regions = $region->successful() ? $region->json() : [];

        $city = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/cities');

        $agent = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/agents');

        $cities = $city->successful() ? $city->json() : [];
        $regions = $region->successful() ? $region->json() : [];
        $agents = $agent->successful() ? $agent->json() : [];

        return view('pages.add_listings', ['regions' => $regions, 'cities' => $cities, 'agents' => $agents]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'description' => 'required|string',
            'region_id' => 'required|integer',
            'city_id' => 'required|integer',
            'zip_code' => 'required|string|max:10',
            'price' => 'required|numeric',
            'area' => 'required|numeric',
            'bedrooms' => 'required|integer',
            'is_rental' => 'required|boolean',
            'agent_id' => 'required|integer',
            'image' => 'required|file|mimes:jpeg,png,jpg|max:2048',
        ]);

        $image = $request->file('image');
        $imagePath = $image->getPathname();

        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY'),
        ])->attach(
            'image',
            file_get_contents($imagePath),
            $image->getClientOriginalName()
        )->post('https://api.real-estate-manager.redberryinternship.ge/api/real-estates', [
            'address' => $validatedData['address'],
            'description' => $validatedData['description'],
            'region_id' => $validatedData['region_id'],
            'city_id' => $validatedData['city_id'],
            'zip_code' => $validatedData['zip_code'],
            'price' => $validatedData['price'],
            'area' => $validatedData['area'],
            'bedrooms' => $validatedData['bedrooms'],
            'is_rental' => $validatedData['is_rental'],
            'agent_id' => $validatedData['agent_id'],
        ]);

        Log::error('API Response: ' . $response->body());

        if ($response->successful()) {
            return redirect()->route('home')->with('success', 'ლისტინგი წარმატებით დაემატა!');
        } else {
            $errorMessage = $response->body(); 

            return redirect()->route('home')->withErrors($errorMessage);
        }
    }
}
