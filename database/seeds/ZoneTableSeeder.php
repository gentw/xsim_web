<?php

use Illuminate\Database\Seeder;

class ZoneTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $thumbs = array (
            [
                'countries'=>'Armenia, Australia, Austria, Azerbijan, Belgium, Bulgaria, Chile, China, Colombia, Costa Rica, Croatia, Cyprus, Czech.Rep., Denmark, Estonia, Faeroe Islands, Finland, France, Georgia, Germany, Gibraltar, Greece, Greenland, Guadeloupe, Guatemala, Honduras, HongKong, Hungary, Iceland, Ireland, Israel, Italy, Kazakhstan, Korea (South), Latvia, Liechtenstein, Lithuania, Luxembourg, Malaysia, Malta, Mexico, Montenegro, Netherlands, Nicaragua, Norway, Paraguay, Poland, Portugal, Puerto Rico, Romania, Russia, San Marino, Singapore, Slovakia, Slovenia, Spain, Sweden, Switzerland, Thailand, Turkey, United Kingdom, USA, Uruguay, Vatican',
                "created_at" => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now(),
            ],
        	[
        		'countries'=>'Argentina, Belarus, Canada, El Salvador, Indonesia, Panama, Peru, Philippines, Saudi Arabia, South Africa, Tajikistan',
        		"created_at" => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now(),
        	],
        	[
        		'countries'=>'Anguilla, Antigua-and-Barbuda, Aruba, Barbados, Bermuda, Brazil, British Virgin Islands, Cayman Islands, Dominica, Ecuador, Egypt, Grenada, Haiti, India, Jamaica, Japan, Kuwait, Macau, Macedonia, Moldova, Nepal, Netherlands Antilles, New Zealand, Nigeria, Qatar, Serbia, Sri Lanka, St.Kitts, St Lucia, St.Vincent / Grenada, Suriname, Taiwan, Turk & Caicos Isl., Ukraine, United Arab Emirate, Vietnam',
        		"created_at" => \Carbon\Carbon::now(),
				"updated_at" => \Carbon\Carbon::now(),
        	],
        );

		$db = DB::table('zones')->insert($thumbs);
    }
}
