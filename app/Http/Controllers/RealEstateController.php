<?php

namespace App\Http\Controllers;

use App\Models\RealEstate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RealEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/real-estates');


        $region = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/regions');

        $regions = $region->successful() ? $region->json() : [];

        if ($response->successful()) {
            $realEstates = $response->json();
        } else {
            $realEstates = [];
        }

        return view('pages.home', [
            'realEstates' => $realEstates,
            'regions' => $regions
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get("https://api.real-estate-manager.redberryinternship.ge/api/real-estates/{$id}");

        if ($response->successful()) {
            $realEstate = $response->json();
            $selectedRegionId = $realEstate['city']['region_id'];
        } else {
            abort(404);
        }

        $sliderResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/real-estates');

        if ($sliderResponse->successful()) {
            $SliderRealEstates = $sliderResponse->json();
            $SliderRealEstates = array_filter($SliderRealEstates, function ($estate) use ($selectedRegionId) {
                return $estate['city']['region_id'] === $selectedRegionId;
            });
        } else {
            $SliderRealEstates = [];
        }

        $regionResponse = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->get('https://api.real-estate-manager.redberryinternship.ge/api/regions');

        $regions = $regionResponse->successful() ? $regionResponse->json() : [];

        return view('pages.real-estates', [
            'realEstate' => $realEstate,
            'regions' => $regions,
            'SliderRealEstates' => $SliderRealEstates
        ]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('REAL_ESTATE_API_KEY')
        ])->delete("https://api.real-estate-manager.redberryinternship.ge/api/real-estates/{$id}");

        if ($response->successful()) {
            return redirect()->route('home')->with('success', 'ლისტინგი წარმატებით წაიშალა!');
        } else {
            return redirect()->route('home')->with('error', 'წარუმატებელი მცდელობა!');
        }
    }
}
