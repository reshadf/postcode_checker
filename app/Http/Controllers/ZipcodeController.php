<?php

namespace App\Http\Controllers;

use App\Zipcode;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class ZipcodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'numbers' => 'required|max:255',
            'letters' => 'required|max:255',
            'housenr' => 'required|max:255',
        ]);

        $zipcode = Zipcode::where('pnum', $request->input('numbers'))
            ->where('pchar', $request->input('letters'))
            ->firstOrFail();

        switch($zipcode->numbertype) {
            case 'even':
                if($request->input('housenr') % 2 == 0) {
                    if($this->between($request->input('housenr'), $zipcode->minnumber, $zipcode->maxnumber)) {
                        return response()->json($zipcode);
                    } else {
                        return redirect::back()->with('error', 'uw huisnr bestaat niet i.c.m. deze postcode');
                    }
                }
                break;
            case 'odd':
                if($request->input('housenr') % 2 == 1) {
                    if($this->between($request->input('housenr'), $zipcode->minnumber, $zipcode->maxnumber)) {
                        return response()->json($zipcode);
                    } else {
                        return redirect::back()->with('error', 'uw huisnr bestaat niet i.c.m. deze postcode');
                    }
                }
                break;
            case 'mixed':
                if($this->between($request->input('housenr'), $zipcode->minnumber, $zipcode->maxnumber)) {
                    return response()->json($zipcode);
                } else {
                    return redirect::back()->with('error', 'uw huisnr bestaat niet i.c.m. deze postcode');
                }
                break;
            default:
                return redirect::back()->with('error', 'uw huisnr bestaat niet i.c.m. deze postcode');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    private function between($val, $min, $max) {
        return ($val >= $min && $val <= $max);
    }
}
