<?php

namespace App\Http\Middleware\Role;

use Closure;
use Illuminate\Http\Request;

class ProductRole
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

            if(in_array(request()->route()->getName(),["product.update","product.edit","product.destroy","product.show"])){            
                if(!auth()->user()->products()->select("id")->where("id",request()->route("product"))->count()){
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
