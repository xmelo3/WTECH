<?php
 
namespace App\Helpers;
 
class ColourMap
{
    private static array $map = [
        'Natural' => '#e8d5b0',
        'White'   => '#f5f5f5',
        'Black'   => '#222222',
        'Grey'    => '#888888',
        'Red'     => '#cc3333',
        'Orange'  => '#e87722',
        'Yellow'  => '#f0c830',
        'Green'   => '#3a7d44',
        'Brown'   => '#7b4f2e',
    ];
 
    public static function hex(string $colour): string
    {
        return self::$map[$colour] ?? '#cccccc';
    }
}