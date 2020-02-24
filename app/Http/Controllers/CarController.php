<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // uzklausa dabartiniam valdytojui su info apie masinas
        $currentHolders = DB::select(
            'SELECT 
            users.name as dabartinisValdytojas,
            segments.name as segmentoPav,
            cars.number as masinosNr,
            cars.year_made as metai,
            cars.model as modelis,
            car_management.cars_id as dbrCarId 
            FROM 
            car_management
            LEFT JOIN users ON car_management.user_id = users.id
            LEFT JOIN segments ON car_management.segments_id = segments.id
            LEFT JOIN cars ON car_management.cars_id = cars.id
            WHERE car_management.date_from <= current_date() AND car_management.date_to >= current_date()'
        );
        
        //uzklausa dabartiniam statusui
        $statuses = DB::select(
            'SELECT 
            statuses.name as bukle,
            cars_id           
            FROM 
            car_status
            LEFT JOIN statuses ON car_status.status_id = statuses.id
            WHERE cars_id in
            (SELECT cars_id FROM car_management
             WHERE car_management.cars_id = car_status.cars_id 
             AND car_management.date_from <= current_date() AND car_management.date_to >= current_date()
             AND car_status.date_from <= current_date() AND car_status.date_to >= current_date())'
        );

        //uzklausa ankstesniam valdytojui
        $lastHolders = DB::select(
            'SELECT 
            users.name as ankstesnisValdytojas,
            segments.name as sensegmentoPav,
            cars_id as senoCarId
            FROM car_management
            LEFT JOIN users ON car_management.user_id = users.id
            LEFT JOIN segments ON car_management.segments_id = segments.id
            WHERE 
            car_management.date_from < current_date() AND car_management.date_to < current_date()'
        );

        return view('carList')
        ->with('currentHolders', $currentHolders)
        ->with('lastHolders', $lastHolders)
        ->with('statuses', $statuses);        
    }  
}
