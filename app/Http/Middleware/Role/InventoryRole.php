<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;
use App\Models\Inventroy;

class InventoryRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {                
        try{
            $role_users = auth()->user()->roles()->pluck("name")->toArray();
            
            if(in_array("admin",$role_users)){
                return $next($request);
            }

            if(in_array(request()->route()->getName(),["inventory.update","inventory.edit","inventory.destroy","inventory.show"])){            
                if(!auth()->user()->inventorys()->select("id")->where("id",request()->route("inventory"))->count()){
                    dd("Not Allowed");
                    // return redirect()->back();
                }            
            }        
        
            return $next($request);
        }catch(\Exception $e){
            dd($e);
            // return back();
        }
    }
}
