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
            ['product_name' => 'Nike Blazer Mid 77 Jumbo', 'product_desc' => 'Praised by many for its enduring look and feel, the wardrobe staple hits refresh with the Nike Blazer Mid 77 Jumbo.Harnessing the old-school look you love, it now has an elastic heel with corduroy-like texture and large pull tabs for easy on and off.The oversized Swoosh design and jumbo laces add a fun twist.', 'price' => '479.00'],
            ['product_name' => 'NIKE TECH HIP PACK LIGHT BONE/BLACK', 'product_desc' => 'This white Tech Hip Pack has room for all your essentials. This Pack features several zippered pockets, which provides safe storage and an overall overview. A Nike logo is featured on the front pocket. Sporty and handy.', 'price' => '165.00'],
            ['product_name' => 'NEW ERA 9FORTY A-FRAME NEW YORK YANKEES LEAGUE ESSENTIAL', 'product_desc' => 'New Era 9FORTY A-Frame New York Yankees League Essential Wet Bark Snapback Cap', 'price' => '189.00'],
            ['product_name' => '4DFWD 3 RUNNING SHOES', 'product_desc' => 'Whether youre focused on your next stride or the finish line, running is all about moving forward. Thats why the 4DFWD 3 running shoes are coded for forward motion. We updated the innovative 3D-printed adidas 4D midsole with a new lattice structure that transforms impact forces into forward motion and combined it with the extraordinary traction of a Continental™ Rubber outsole.', 'price' => '899.00'],
            ['product_name' => 'BLEACH: Thousand-Year Blood War UT', 'product_desc' => 'To celebrate the final chapter of the TV animation, "Thousand-Year Blood War," the Soul Reapers and Quincies are now available as a UT graphic Tee.', 'price' => '29.90'],
            ['product_name' => 'H&M Oversized Fit Printed hoodie', 'product_desc' => 'Oversized hoodie in sweatshirt fabric made from a cotton blend with a soft brushed inside and a print motif. Double-layered wrapover hood, low dropped shoulders, long sleeves, a kangaroo pocket and ribbing at the cuffs and hem.', 'price' => '129.95'],
            ['product_name' => 'Versace CHAIN COUTURE PLEATED MIDI SKIRT', 'product_desc' => 'A fluid pleated midi skirt featuring an all-over Chain Couture print with a contrasting jacquard logo waistband.', 'price' => '2150.00'],
            ['product_name' => 'LV Medallion Socks', 'product_desc' => 'The LV Medallion socks combine cozy comfort with unmistakable signature style. Crafted in a blend of cashmere for ultimate warmth, they feature a pattern inspired by historic House icons, with the LV Initials on one foot and a pointed Monogram Flower on the other. Perfect for adding a touch of contemporary flair to a winter outfit.', 'price' => '2150.00'],
            ['product_name' => 'ESTÉE LAUDER Stellar Lipstick Collection Set (Holiday Limited Edition)', 'product_desc' => 'A stellar lipstick collection with 5 full-size lip shades from celestial nude to garnet desire, the perfect gift for you or someone else.', 'price' => '350.00'],
            ['product_name' => 'ARMANI Acqua Di Giò Parfum', 'product_desc' => 'Acqua di Giò parfum is a new deep and intense freshness by Giorgio Armani, refillable on all formats.', 'price' => '325.00'],
            ['product_name' => 'BONIA Zaira Womens Blouse', 'product_desc' => 'The Zaira Womens Blouse features a curve hem to hip regular fit for all kinds of occasions. This piece comes in a series of trendy colour options and is made from easy-to-iron fabric — the understated wardrobe staple thatll never run out of style.', 'price' => '399.00'],
            ['product_name' => 'LEVIS® WOMENS RIBCAGE WIDE-LEG JEANS', 'product_desc' => 'As if our Ribcage jeans couldnt get any better—meet our Ribcage Wide-Leg. The tailored, leggy look of the 70s and a 90s-inspired super-high rise come together to create the perfect proportion to show off the rise and define your waistline. With a soaring 12-inch rise, theyre about to become your hip-slimming, waist-defining, leg-lengthening obsession.', 'price' => '14.11'],
            ['product_name' => 'CHRISTY NG X DHL 22 BACKPACK', 'product_desc' => 'Inspired by the courier service that delivers everyday, this collection is our homage to all DHL employees who are always there for us, rain or shine! This season, we are proud to announce our partnership with the worlds leading international express services provider. This capsule collection consists of 11 exclusive designs in the signature colours of the worlds coolest delivery', 'price' => '129.00'],
            ['product_name' => 'Charles&Keith Koa Leather Push-Lock Top Handle Bag', 'product_desc' => 'Add a Barbiecore touch to your outfits with the pink Koa push-lock bag. Sculptural details, such as the elongated curved top handles that are doll-like and playful, liven up the rectangular silhouette. Gold-toned hardware complements the candy pink finish to create a polished look, while the calf leather and micro-suede interior feel soft and luxurious.', 'price' => '589.90'],
            ['product_name' => 'Funko Pop! Deluxe: Star Wars: Red Saber Series - Darth Vader (Glow In The Dark)', 'product_desc' => 'Featuring an awesome Star Wars magma-themed display base, Darth Vader looks highly menacing while he grips his signature red lightsaber. The Deluxe Pop! even glows in the dark, adding to its ominous aesthetic. Join the Dark Side and order the Darth Vader Red Saber Series Volume 1 Glow in the Dark Deluxe Pop! Vinyl Figure for your Star Wars collection! AVAILABLE NOW!', 'price' => '159.90'],
        ];

        // Insert data into the 'products' table using Eloquent
        foreach ($product_seed as $product_data) {
            Product::create($product_data);
        }
    }
}
