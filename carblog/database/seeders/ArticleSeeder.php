<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Article;
use App\Models\Category;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a test user if it doesn't exist
        $user = User::firstOrCreate([
            'email' => 'test@example.com'
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);

        // Sample articles data with multiple categories
        $articles = [
            [
                'title' => 'The Future of Electric Supercars: McLaren Artura Review',
                'excerpt' => 'McLaren\'s hybrid masterpiece combines cutting-edge technology with raw performance in ways we never thought possible.',
                'content' => 'The McLaren Artura represents a bold step into the future of automotive engineering. This hybrid supercar combines a twin-turbocharged V6 engine with an electric motor to deliver an astonishing 671 horsepower while maintaining the precision and agility that McLaren is famous for.

The exterior design is a masterclass in aerodynamic efficiency, with every curve and vent serving a specific purpose. The dihedral doors not only look spectacular but also improve access to the cabin, which is surprisingly comfortable for a supercar.

Inside, the Artura features McLaren\'s latest infotainment system, which is intuitive and responsive. The driving position is perfect, with excellent visibility and controls that fall naturally to hand.

On the road, the Artura is surprisingly docile in its default mode, making it suitable for daily driving. However, switch to Sport or Track mode, and the car transforms into a track weapon that can embarrass much more expensive machinery.

The hybrid system provides instant torque from the electric motor, eliminating turbo lag and providing seamless acceleration. The eight-speed dual-clutch transmission shifts with lightning speed, and the adaptive suspension provides excellent ride quality without compromising handling.

In conclusion, the McLaren Artura is not just a great hybrid supercar; it\'s a great supercar, period. It proves that electrification can enhance rather than compromise the driving experience.',
                'categories' => ['supercars', 'electric-cars', 'reviews'],
                'hot' => true,
                'published' => true,
                'views' => 2400,
                'likes' => 89,
            ],
            [
                'title' => 'Restoration Story: 1969 Dodge Charger R/T',
                'excerpt' => 'Follow our journey as we bring this classic muscle car back to its former glory with modern touches.',
                'content' => 'When we first laid eyes on this 1969 Dodge Charger R/T, it was a shadow of its former self. Years of neglect had taken their toll, but we could see the potential beneath the rust and faded paint.

The restoration process began with a complete disassembly, allowing us to assess the full extent of the damage. The body was in surprisingly good condition, with only minor rust in the typical areas. The engine, however, was another story entirely.

We decided to keep the original 440 Magnum V8 but gave it a complete rebuild with modern internals. This included forged pistons, a performance camshaft, and upgraded fuel injection. The result is a reliable engine that produces over 500 horsepower while maintaining the classic muscle car sound.

The interior was completely restored using period-correct materials and colors. We also added modern amenities like air conditioning and a premium sound system, carefully integrated to maintain the car\'s original character.

The paint job was perhaps the most challenging part of the restoration. We chose the original F8 Green color, which required extensive research to match perfectly. The result is a finish that looks as good as it did when the car first left the factory.

The suspension and brakes were upgraded to modern standards, making the car much safer and more enjoyable to drive. We maintained the original look while significantly improving the driving dynamics.

This restoration project took over two years to complete, but the result is a stunning example of American muscle that combines classic style with modern reliability.',
                'categories' => ['muscle-cars', 'classic-cars', 'maintenance'],
                'hot' => true,
                'published' => true,
                'views' => 1800,
                'likes' => 156,
            ],
            [
                'title' => 'Track Day Special: Porsche 911 GT3 RS',
                'excerpt' => 'We take the ultimate track weapon to its natural habitat and push it to the absolute limit.',
                'content' => 'The Porsche 911 GT3 RS is often described as a race car for the road, and after spending a day at the track with this incredible machine, I can confirm that this description is entirely accurate.

The GT3 RS is powered by a naturally aspirated 4.0-liter flat-six engine that produces 525 horsepower and revs to an incredible 9,000 rpm. The sound this engine makes at full throttle is nothing short of intoxicating, a mechanical symphony that echoes off the track walls.

The chassis is incredibly stiff, thanks to extensive use of carbon fiber and aluminum. The suspension is race-car firm but surprisingly compliant on the road. The steering is telepathic, providing instant feedback and allowing for precise placement of the car.

On the track, the GT3 RS comes alive. The rear-engine layout, which can be tricky in less capable cars, provides incredible traction and stability. The car rotates beautifully into corners, and the massive carbon-ceramic brakes provide fade-free stopping power.

The aerodynamics are equally impressive, with a massive rear wing and front splitter generating significant downforce. This allows the car to carry incredible speed through corners while maintaining stability.

The seven-speed PDK transmission shifts with lightning speed, and the launch control system allows for perfect starts every time. The car also features a sophisticated traction control system that can be adjusted to suit different driving conditions.

In conclusion, the Porsche 911 GT3 RS is not just the best track car I\'ve ever driven; it\'s one of the best cars period. It represents the pinnacle of automotive engineering and provides an unmatched driving experience.',
                'categories' => ['supercars', 'sports-cars', 'racing', 'reviews'],
                'hot' => true,
                'published' => true,
                'views' => 3200,
                'likes' => 203,
            ],
            [
                'title' => 'Budget Build: Making a Miata Fast',
                'excerpt' => 'Proving you don\'t need deep pockets to have serious fun on the track with smart modifications.',
                'content' => 'The Mazda Miata has long been the go-to choice for budget-conscious enthusiasts who want to experience the thrill of track driving. In this project, we set out to prove that you can build a seriously fast track car without breaking the bank.

We started with a clean 1999 Miata that we picked up for just $3,500. The car was in good condition but completely stock. Our goal was to create a track weapon that could compete with much more expensive machinery.

The first modification was a set of high-performance coilovers that lowered the car and improved handling. We also added a front sway bar to reduce body roll and improve turn-in response.

The stock 1.8-liter engine was in good condition, so we focused on improving airflow. This included a cold air intake, header, and exhaust system. We also added a lightweight flywheel and clutch for better throttle response.

The wheels and tires were perhaps the most important modification. We chose a set of lightweight 15-inch wheels wrapped in sticky track tires. The difference in grip was immediately noticeable.

The interior was stripped of unnecessary weight, including the air conditioning, power steering, and sound system. We also added a roll bar for safety and a racing seat for better support during hard cornering.

The result is a car that weighs just 2,100 pounds and produces around 140 horsepower. While these numbers might not sound impressive, the power-to-weight ratio is excellent, and the car is incredibly fun to drive.

On the track, our budget Miata was able to keep up with much more expensive machinery. The car is incredibly balanced and forgiving, making it perfect for learning advanced driving techniques.

This project proves that you don\'t need a huge budget to have serious fun on the track. With smart modifications and good driving, a budget build can be just as rewarding as a high-end track car.',
                'categories' => ['sports-cars', 'tuning', 'racing', 'guides'],
                'published' => true,
                'views' => 1600,
                'likes' => 94,
            ],
            [
                'title' => 'New vs Used: BMW M3 Buying Guide',
                'excerpt' => 'Everything you need to know before purchasing your dream sports sedan, from financing to maintenance.',
                'content' => 'The BMW M3 has long been considered the benchmark for sports sedans, offering a perfect blend of performance, luxury, and practicality. However, choosing between a new and used M3 can be a difficult decision.

Let\'s start with the new M3. The latest generation features a twin-turbocharged inline-six engine that produces up to 503 horsepower. The car is incredibly fast, with 0-60 mph times in the low 3-second range. The interior is luxurious and well-appointed, with the latest technology and safety features.

However, the new M3 is expensive, with prices starting around $70,000. Depreciation is also a significant factor, with the car losing value quickly in the first few years of ownership.

A used M3, on the other hand, can be much more affordable. A well-maintained example from the previous generation can be found for $30,000 to $50,000, depending on age and condition. This represents excellent value for money, as the performance is still impressive by modern standards.

When buying a used M3, it\'s important to check the service history carefully. These cars require regular maintenance, and neglect can lead to expensive repairs. Common issues include VANOS problems, rod bearing wear, and electrical gremlins.

The E46 M3 (2000-2006) is often considered the sweet spot, offering excellent performance and reliability at a reasonable price. The E92 M3 (2008-2013) is also highly regarded, with its high-revving V8 engine providing a unique driving experience.

Financing options are available for both new and used M3s, but interest rates are typically higher for used cars. It\'s important to shop around and compare offers from multiple lenders.

Insurance costs can also be significant, especially for younger drivers. The M3\'s high performance and repair costs make it an expensive car to insure.

In conclusion, both new and used M3s offer excellent value for money, but the choice depends on your budget and priorities. A new M3 provides the latest technology and warranty coverage, while a used M3 offers better value and the opportunity to own a classic.',
                'categories' => ['sports-cars', 'luxury-cars', 'guides', 'reviews'],
                'published' => true,
                'views' => 2100,
                'likes' => 127,
            ],
            [
                'title' => 'Electric Revolution: Tesla Model S Plaid Review',
                'excerpt' => 'The fastest production car ever made? We put Tesla\'s latest creation through its paces.',
                'content' => 'The Tesla Model S Plaid represents the cutting edge of electric vehicle technology, combining incredible performance with practical daily usability. With a claimed 0-60 mph time of under 2 seconds, it\'s one of the fastest production cars ever made.

The Plaid is powered by three electric motors that produce a combined 1,020 horsepower. The acceleration is simply mind-bending, with instant torque available from any speed. The car feels like it\'s being launched from a catapult, and the sensation is both exhilarating and slightly terrifying.

The interior is minimalist and modern, with a large central touchscreen controlling most functions. The build quality has improved significantly over previous Tesla models, with better materials and fit and finish.

The range is impressive, with EPA estimates of up to 396 miles on a single charge. The Supercharger network makes long-distance travel practical, with fast charging available across the country.

The driving dynamics are surprisingly good for such a heavy car. The low center of gravity provided by the battery pack helps with cornering, and the instant torque makes overtaking effortless.

However, the Plaid is not without its drawbacks. The steering feel is artificial compared to traditional sports cars, and the regenerative braking can take some getting used to. The car is also very heavy, which affects handling and braking performance.

The price tag of over $130,000 puts it out of reach for most buyers, but for those who can afford it, the Plaid offers a unique combination of performance and practicality.

In conclusion, the Tesla Model S Plaid is a technological tour de force that demonstrates the potential of electric vehicles. While it may not provide the same driving experience as a traditional sports car, it offers a glimpse into the future of automotive performance.',
                'categories' => ['electric-cars', 'luxury-cars', 'reviews', 'news'],
                'published' => true,
                'views' => 2800,
                'likes' => 145,
            ],
        ];

        foreach ($articles as $articleData) {
            $categories = $articleData['categories'];
            unset($articleData['categories']);
            
            $article = Article::create(array_merge($articleData, [
                'user_id' => $user->id,
                'image' => Article::getRandomCarImage(),
            ]));

            // Attach categories
            foreach ($categories as $categorySlug) {
                $category = Category::where('slug', $categorySlug)->first();
                if ($category) {
                    $article->categories()->attach($category->id);
                }
            }
        }

        $this->command->info('Sample articles with multiple categories created successfully!');
    }
}
