<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $routeController = explode("\\", $request->route()->getAction()['controller'])[3];
        $controllerData = explode("@", $routeController);

        $guestDoesNotAccess = ['create', 'store', 'edit', 'update', 'destroy', 'payment', 'verify', 'report'];
        $editorDoesNotAccess = ['destroy', 'report'];
        foreach (Auth::user()->role->permissions as $value) {
            $userPermission[$value->module] = $value->type;
        }

        $userAccessToThisController = $userPermission[strtolower($controllerData[0][0])];

        switch ($userAccessToThisController) {
            case "n":
                return redirect()->route('panel.dashboard')->with('no-access', 'You have not access to this module');
                break;
            case "g":
                if (in_array($controllerData[1], $guestDoesNotAccess) ||  $routeController == 'FinancialController@index') {
                    return redirect()->route('panel.dashboard')->with('no-access', 'You have not access to this module');
                }
                break;
            case "e":
                if($request->get('is_active') != null){
                    $request->offsetSet('is_active',0);
                }
                if (in_array($controllerData[1], $editorDoesNotAccess)) {
                    if($controllerData[1] == 'destroy') return redirect()->route('panel.dashboard')->with('no-access', 'You could not access to remove anything');
                    return redirect()->route('panel.dashboard')->with('no-access', 'You have not access to this module');
                }
                break;
            default:
            return $next($request);
        }
        return $next($request);
    }
}
