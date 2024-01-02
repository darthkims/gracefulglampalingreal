<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product; // Import the Product model

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product_seed = [
            [
                'name' => 'Nike Blazer Mid 77 Jumbo',
                'description' => 'Praised by many for its enduring look and feel, the wardrobe staple hits refresh with the Nike Blazer Mid 77 Jumbo. Harnessing the old-school look you love, it now has an elastic heel with corduroy-like texture and large pull tabs for easy on and off.',
                'price' => '479.00',
            ],
            [
                'name' => 'NIKE TECH HIP PACK LIGHT BONE/BLACK',
                'description' => 'This white Tech Hip Pack has room for all your essentials. This Pack features several zippered pockets, which provides safe storage and an overall overview. A Nike logo is featured on the front pocket. Sporty and handy.',
                'price' => '165.00',
            ],
            [
                'name' => 'NEW ERA 9FORTY A-FRAME NEW YORK YANKEES LEAGUE ESSENTIAL',
                'description' => 'New Era 9FORTY A-Frame New York Yankees League Essential Wet Bark Snapback Cap',
                'price' => '189.00',
            ],
            [
                'name' => '4DFWD 3 RUNNING SHOES',
                'description' => 'Whether you\'re focused on your next stride or the finish line, running is all about moving forward. That\'s why the 4DFWD 3 running shoes are coded for forward motion.',
                'price' => '899.00',
            ],
            [
                'name' => 'BLEACH: Thousand-Year Blood War UT',
                'description' => 'To celebrate the final chapter of the TV animation, "Thousand-Year Blood War," the Soul Reapers and Quincies are now available as a UT graphic Tee.',
                'price' => '29.90',
            ],
            [
                'name' => 'H&M Oversized Fit Printed Hoodie',
                'description' => 'Oversized hoodie in sweatshirt fabric made from a cotton blend with a soft brushed inside and a print motif. Double-layered wrapover hood, low dropped shoulders, long sleeves, a kangaroo pocket, and ribbing at the cuffs and hem.',
                'price' => '129.95',
            ],
            [
                'name' => 'Versace CHAIN COUTURE PLEATED MIDI SKIRT',
                'description' => 'A fluid pleated midi skirt featuring an all-over Chain Couture print with a contrasting jacquard logo waistband.',
                'price' => '2150.00',
            ],
            [
                'name' => 'LV Medallion Socks',
                'description' => 'The LV Medallion socks combine cozy comfort with unmistakable signature style. Crafted in a blend of cashmere for ultimate warmth, they feature a pattern inspired by historic House icons, with the LV Initials on one foot.',
                'price' => '2150.00',
            ],
            [
                'name' => 'ESTÉE LAUDER Stellar Lipstick Collection Set (Holiday Limited Edition)',
                'description' => 'A stellar lipstick collection with 5 full-size lip shades from celestial nude to garnet desire, the perfect gift for you or someone else.',
                'price' => '350.00',
            ],
            [
                'name' => 'ARMANI Acqua Di Giò Parfum',
                'description' => 'Acqua di Giò parfum is a new deep and intense freshness by Giorgio Armani, refillable on all formats.',
                'price' => '325.00',
            ],
            [
                'name' => 'BONIA Zaira Womens Blouse',
                'description' => 'The Zaira Womens Blouse features a curve hem to hip regular fit for all kinds of occasions. This piece comes in a series of trendy colour options and is made from easy-to-iron fabric.',
                'price' => '399.00',
            ],
            [
                'name' => 'LEVIS® WOMENS RIBCAGE WIDE-LEG JEANS',
                'description' => 'As if our Ribcage jeans couldn\'t get any better—meet our Ribcage Wide-Leg. The tailored, leggy look of the 70s and a 90s-inspired super-high rise come together to create the perfect proportion.',
                'price' => '319.00',
            ],
            [
                'name' => 'CHRISTY NG X DHL 22 BACKPACK',
                'description' => 'Inspired by the courier service that delivers every day, this collection is our homage to all DHL employees who are always there for us, rain or shine! This season, we are proud to announce our partnership.',
                'price' => '129.00',
            ],
            [
                'name' => 'Charles&Keith Koa Leather Push-Lock Top Handle Bag',
                'description' => 'Add a Barbiecore touch to your outfits with the pink Koa push-lock bag. Sculptural details, such as the elongated curved top handles that are doll-like and playful, liven up the rectangular silhouette.',
                'price' => '589.90',
            ],
            [
                'name' => 'Funko Pop! Deluxe: Star Wars: Red Saber Series - Darth Vader (Glow In The Dark)',
                'description' => 'Featuring an awesome Star Wars magma-themed display base, Darth Vader looks highly menacing while he grips his signature red lightsaber. The Deluxe Pop! even glows in the dark, adding to its ominous aesthetic.',
                'price' => '159.90',
            ],
        ];
        
        // You can repeat the same structure for each product
        

        // Insert data into the 'products' table using Eloquent
        foreach ($product_seed as $product_data) {
            Product::create($product_data);
        }
    }
}
