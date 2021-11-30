<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Role
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next,$firstRole)
    {      
        try{
            $role_users = auth()->user()->roles()->pluck("name")->toArray();
            
            if(in_array("admin",$role_users)){
                return $next($request);
            }

            if(!in_array($firstRole,$role_users)){            
                dd("Not Allowed");
                // return back();
            }

            $grant = auth()->user()->roles()->where("name",$firstRole)->first();    

            if($grant->pivot->operators){   
                $operators = json_decode($grant->pivot->operators);              
                $nameRoute = explode(".",request()->route()->getName());
                            
                if(!in_array($nameRoute[count($nameRoute)-1],$operators)){
                    dd("Not Allowed");
                    // return back();
                }
            }    
        
            return $next($request);
        }catch(\Exception $e){        
            dd($e);
            // return back();
        }
    }
}
