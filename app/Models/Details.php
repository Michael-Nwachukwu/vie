<?php

namespace App\Models;

class Details{
    public static function all(){
        return [

            [
                'id' => 1, 

                'title' => 'We want a Unity Game Developer', 
                
                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptatem quidem ab corrupti minima debitis, voluptate quam repellat explicabo accusamus officia, praesentium optio dolorum dolorem tempore quia similique aperiam recusandae.'
            ],

            [
                'id' => 2,

                'title' => 'We want a Unity React Developer', 

                'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Eum voluptatem quidem ab corrupti minima debitis, voluptate quam repellat explicabo accusamus officia, praesentium optio dolorum dolorem tempore quia similique aperiam recusandae.'
            ]

        ];
    }

    public static function find($id){

        $list_of_jobs = self::all();

        foreach( $list_of_jobs as $one_job ){

            if( $one_job['id'] == $id ){
                return $one_job;
            }
            
        }

    }
}

?>