<?php

namespace App\Services;

class DataParser
{
    // Method used to format the return body of the request
    // Embeds the commits list passed in parameter and uses
    // the second parameter (timestamp) to register wanted
    // information to the data
    public function formatBody($body, $timestamp){
        if(null === $timestamp){
            $timestamp = time();
        }
        $data = array(
            "year" => date("Y", $timestamp),
            "week" => date("W", $timestamp),
            "count" => count($body),
            "commits" => $body
        );

        return $data;
    }
}