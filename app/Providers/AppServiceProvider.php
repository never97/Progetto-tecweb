<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
/*
        Validator::extend('unique_custom', function ($attribute, $value, $parameters)
        {
            list($table, $field, $field2, $field2Value) = $parameters;
            return DB::table($table)->where($field2, $field2Value)->sum('ore_unitarie')+$value <= 8;
            //dd("return DB::table($table)->where($field2, $field2Value)->sum('ore_unitarie')+$value <= 8");

        },'Raggiunto numero limite di ore giornaliere: 8');



        Validator::extend('custom_assign', function ($attribute, $value, $parameters)
        {
            // Get the parameters passed to the rule
            list($table, $field, $field2, $field2Value) = $parameters;

            // Check the table and return true only if there are no entries matching
            // both the first field name and the user input value as well as
            // the second field name and the second field value
            return DB::table($table)->where($field, $value)->where($field2, $field2Value)->count() == 0;
            //dd("DB::table($table)->where($field, $value)->where($field2, $field2Value)->count() == 0");
        },'Non è possibile assegnare un progetto più volte allo stesso utente');
*/
    }


}
