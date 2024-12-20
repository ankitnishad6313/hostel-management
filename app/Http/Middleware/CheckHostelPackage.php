<?php

namespace App\Http\Middleware;

use App\Models\Assignment;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHostelPackage
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get Hostel Owner Id form Session
        $id = auth()->user()->id;
        // Get Hostel Id from route
        $hostel_id = request()->route('id');
        // Checking if any package to the requestes hostel except FREE Package
        $assign = Assignment::where('user_id', $id)->where('hostel_id', $hostel_id)
        ->where('package_id', '!=', 6)->where('end_date', ">=", now())->get();
        // If Package Assigned then proceed next 
        if($assign->isNotEmpty()){
            return $next($request);
        }
        // else redirect back.
        return redirect()->back()->with('error', 'Please purchase our package to access this Service.');
    }
}
