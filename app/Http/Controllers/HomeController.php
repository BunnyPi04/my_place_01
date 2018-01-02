<?php

namespace App\Http\Controllers;

use App\Models\Place;
use Illuminate\Http\Request;
use App\Repositories\Contracts\PlaceRepositoryInterface;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $placeRepository;
    
    public function __construct(PlaceRepositoryInterface $placeRepository)
    {
        $this->middleware('auth');
        $this->placeRepository = $placeRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function getPlaces(Request $request)
    {
        $key = $request->key;
        $places = $this->placeRepository->search($key);

        return response($places)
            ->header('Content-type', 'application/json');
    }
}
