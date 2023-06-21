<?php
namespace Themes\BC;

use Database\Seeders\DatabaseSeeder;

class ThemeProvider extends \Themes\Base\ThemeProvider
{

    public static $version = '3.0.1';
    public static $name = 'India Graphics';
    public static $seeder = DatabaseSeeder::class;
}
