<?php

namespace Database\Seeders;

use App\Models\AdminUser;
use App\Models\Appointment;
use App\Models\AvailabilityRule;
use App\Models\BookingRequest;
use App\Models\Client;
use App\Models\PortfolioItem;
use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\SiteSetting;
use App\Models\TattooStyle;
use App\Models\TimeBlock;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin User for Fredosis
        AdminUser::updateOrCreate(
            ['email' => 'admin@fredosis.art'],
            [
                'name' => 'Fredosis',
                'password' => Hash::make('fredosis2026'),
            ]
        );

        // 2. Site Settings
        $settings = [
            'site_name' => 'FREDOSIS',
            'artist_name' => 'Fredosis',
            'artist_bio_es' => 'Dibujante, grabador y artista del tatuaje radicado en Santiago Centro, Chile. Mi trabajo explora la anatomía humana, el surrealismo psicológico, la introspección y la transformación de la piel mediante técnicas de grafito puro, plumilla fina y micro-texturas.',
            'artist_bio_en' => 'Draftsman, printmaker and tattoo artist based in Santiago Centro, Chile. My practice delves into human anatomy, psychological surrealism, introspection and skin transformation through delicate graphite, fine ink hatching and micro-textures.',
            'studio_location' => 'Metro Santa Ana, Santiago Centro, Chile',
            'studio_address' => 'Estudio privado a pasos de Metro Santa Ana (Línea 2 y 5), Santiago Centro',
            'whatsapp_phone' => '+56972004512',
            'contact_email' => 'contacto@fredosis.art',
            'currency_default' => 'USD',
            'currency_rates' => json_encode([
                'USD' => 1.0,
                'CLP' => 950.0,
                'EUR' => 0.92,
                'MXN' => 19.8,
            ]),
            'paypal_client_id' => 'sb',
            'paypal_mode' => 'sandbox',
            'deposit_amount_clp' => '35000',
            'deposit_amount_usd' => '35',
            'notify_new_booking' => '1',
            'notify_new_sale' => '1',
            'notify_email' => 'fredosis@art.cl',
        ];

        foreach ($settings as $key => $val) {
            SiteSetting::set($key, $val);
        }

        // 3. Tattoo Styles (incorporating keywords from Google Ads analysis)
        $styles = [
            ['name' => 'Línea Fina (Fine Line)', 'slug' => 'fine-line'],
            ['name' => 'Blackwork & Grabado', 'slug' => 'blackwork'],
            ['name' => 'Surrealismo & Anatomía', 'slug' => 'surrealism'],
            ['name' => 'Black & Grey', 'slug' => 'black-grey'],
            ['name' => 'Micro-Realismo', 'slug' => 'micro-realism'],
            ['name' => 'Cover Up Artístico', 'slug' => 'cover-up'],
            ['name' => 'Botánico & Ornamental', 'slug' => 'botanical'],
        ];

        foreach ($styles as $style) {
            TattooStyle::firstOrCreate(['name' => $style['name']], $style);
        }

        // 4. Default Availability Rules (Tuesday - Saturday: 11:00 to 20:00)
        foreach ([2, 3, 4, 5, 6] as $day) {
            AvailabilityRule::firstOrCreate(
                ['day_of_week' => $day],
                ['start_time' => '11:00', 'end_time' => '20:00']
            );
        }

        // 5. Portfolio Items (Fine Art Drawings & Tattoos inspired by Miles Johnston aesthetic)
        $portfolioData = [
            [
                'title' => 'Ecos de la Percepción',
                'category' => 'drawings',
                'medium' => 'Grafito y carboncillo sobre papel Fabriano 300g',
                'dimensions' => '42 x 59.4 cm (A2)',
                'year' => '2026',
                'image_url' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1000',
                'description' => 'Estudio profundo sobre las capas del pensamiento y la disolución de la forma física mediante tramas microscópicas de grafito.',
                'style_name' => 'Surrealismo & Anatomía',
                'is_featured' => true,
                'sort_order' => 1,
            ],
            [
                'title' => 'Metamorfosis Craneal',
                'category' => 'drawings',
                'medium' => 'Tinta china y plumilla sobre papel Arches',
                'dimensions' => '30 x 42 cm (A3)',
                'year' => '2025',
                'image_url' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1000',
                'description' => 'Líneas superpuestas que exploran la memoria y las transformaciones biológicas del rostro en el silencio.',
                'style_name' => 'Línea Fina (Fine Line)',
                'is_featured' => true,
                'sort_order' => 2,
            ],
            [
                'title' => 'Vértigo Interior',
                'category' => 'drawings',
                'medium' => 'Grafito 2H - 8B y difuminado óptico',
                'dimensions' => '35 x 50 cm',
                'year' => '2026',
                'image_url' => 'https://images.unsplash.com/photo-1582561424760-0321d75e81fa?q=80&w=1000',
                'description' => 'Un rostro dividido que revela estructuras internas en espiral, evocando introspección y vulnerabilidad.',
                'style_name' => 'Surrealismo & Anatomía',
                'is_featured' => true,
                'sort_order' => 3,
            ],
            [
                'title' => 'Fragmentos del Alma',
                'category' => 'paintings',
                'medium' => 'Óleo sobre lino montado en madera',
                'dimensions' => '40 x 50 cm',
                'year' => '2025',
                'image_url' => 'https://images.unsplash.com/photo-1578301978693-85fa9c0320b9?q=80&w=1000',
                'description' => 'Tonalidades monocromáticas cálidas y veladuras sucesivas para capturar la quietud de la figura suspendida.',
                'style_name' => 'Black & Grey',
                'is_featured' => true,
                'sort_order' => 4,
            ],
            [
                'title' => 'Anatomía Flotante - Tatuaje Espalda',
                'category' => 'tattoos',
                'medium' => 'Tinta dynamic black, técnica de punto y línea fina en piel',
                'dimensions' => '32 cm - 2 Sesiones',
                'year' => '2026',
                'image_url' => 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?q=80&w=1000',
                'description' => 'Pieza exclusiva realizada en el estudio cercano a Metro Santa Ana, adaptando el concepto gráfico a la anatomía de la columna.',
                'style_name' => 'Blackwork & Grabado',
                'is_featured' => true,
                'sort_order' => 5,
            ],
            [
                'title' => 'Silencio de Cristal',
                'category' => 'drawings',
                'medium' => 'Grafito sobre papel de algodón 310g',
                'dimensions' => '29.7 x 42 cm (A3)',
                'year' => '2025',
                'image_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1000',
                'description' => 'Exploración de la transparencia y la distorsión del rostro humano mediante reflejos geométricos.',
                'style_name' => 'Micro-Realismo',
                'is_featured' => false,
                'sort_order' => 6,
            ],
            [
                'title' => 'La Serpiente del Pensamiento',
                'category' => 'tattoos',
                'medium' => 'Fine Line & Whip shading en antebrazo',
                'dimensions' => '18 cm',
                'year' => '2026',
                'image_url' => 'https://images.unsplash.com/photo-1590201774843-021110a2663c?q=80&w=1000',
                'description' => 'Movimiento orgánico envolvente con contrastes de negros profundos y punteado sutil.',
                'style_name' => 'Fine Line (Línea Fina)',
                'is_featured' => false,
                'sort_order' => 7,
            ],
            [
                'title' => 'Cicatriz y Renacimiento (Cover Up)',
                'category' => 'tattoos',
                'medium' => 'Blackwork sólido y degradados en escala de grises',
                'dimensions' => 'Cover up completo - 3 sesiones',
                'year' => '2026',
                'image_url' => 'https://images.unsplash.com/photo-1560707854-fb9a10eb18ef?q=80&w=1000',
                'description' => 'Cobertura completa de diseño previo mediante una composición botánica sombría de alta densidad.',
                'style_name' => 'Cover Up Artístico',
                'is_featured' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($portfolioData as $item) {
            $style = TattooStyle::where('name', $item['style_name'])->first();
            PortfolioItem::updateOrCreate(
                ['title' => $item['title']],
                [
                    'slug' => Str::slug($item['title']),
                    'image_url' => $item['image_url'],
                    'description' => $item['description'],
                    'category' => $item['category'],
                    'medium' => $item['medium'],
                    'dimensions' => $item['dimensions'],
                    'year' => $item['year'],
                    'style_id' => $style ? $style->id : null,
                    'is_featured' => $item['is_featured'],
                    'sort_order' => $item['sort_order'],
                ]
            );
        }

        // 6. Products for Sale (Dibujos & Obras E-Commerce)
        $productsData = [
            [
                'title' => 'Ecos de la Percepción (Obra Original & Prints)',
                'slug' => 'ecos-de-la-percepcion',
                'description' => 'Dibujo original a grafito y carbón sobre papel Fabriano de 300g libre de ácido. Cada lámina giclée de edición limitada está impresa con tintas de pigmento mineral de conservación sobre papel de algodón Hannemühle Photo Rag 308g, numerada y firmada a mano por Fredosis.',
                'short_description' => 'Dibujo a grafito surrealista de alta precisión anatómica. Disponible en pieza única original y láminas fine art.',
                'technique' => 'Grafito y carboncillo sobre papel Fabriano 300g',
                'dimensions' => '42 x 59.4 cm (A2)',
                'category' => 'dibujos',
                'main_image' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1000',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=1000',
                    'https://images.unsplash.com/photo-1582561424760-0321d75e81fa?q=80&w=1000',
                ],
                'base_price_clp' => 380000,
                'base_price_usd' => 400,
                'has_original' => true,
                'original_sold' => false,
                'is_featured' => true,
                'variants' => [
                    [
                        'format_name' => 'Pieza Original (Única - Certificado de Autenticidad)',
                        'format_type' => 'ORIGINAL',
                        'price_usd' => 400.00,
                        'price_clp' => 380000.00,
                        'price_eur' => 368.00,
                        'price_mxn' => 7920.00,
                        'stock' => 1,
                        'is_available' => true,
                    ],
                    [
                        'format_name' => 'Lámina Fine Art A2 (Hahnemühle 308g - Edición de 30)',
                        'format_type' => 'PRINT',
                        'price_usd' => 75.00,
                        'price_clp' => 71000.00,
                        'price_eur' => 69.00,
                        'price_mxn' => 1480.00,
                        'stock' => 15,
                        'is_available' => true,
                    ],
                    [
                        'format_name' => 'Lámina Fine Art A3 (Algodón 100% - Firmada)',
                        'format_type' => 'PRINT',
                        'price_usd' => 48.00,
                        'price_clp' => 45000.00,
                        'price_eur' => 44.00,
                        'price_mxn' => 950.00,
                        'stock' => 25,
                        'is_available' => true,
                    ],
                ],
            ],
            [
                'title' => 'Metamorfosis Craneal (Serie Línea Pura)',
                'slug' => 'metamorfosis-craneal',
                'description' => 'Composición en tinta china y plumilla japonesa sobre papel Arches de grano fino. Una oda a la geometría orgánica oculta bajo la piel humana.',
                'short_description' => 'Plumilla y tinta china con tramas milimétricas.',
                'technique' => 'Tinta china y plumilla sobre papel Arches',
                'dimensions' => '30 x 42 cm (A3)',
                'category' => 'dibujos',
                'main_image' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1000',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=1000',
                ],
                'base_price_clp' => 290000,
                'base_price_usd' => 310,
                'has_original' => true,
                'original_sold' => true,
                'is_featured' => true,
                'variants' => [
                    [
                        'format_name' => 'Pieza Original (Vendido / Sold)',
                        'format_type' => 'ORIGINAL',
                        'price_usd' => 310.00,
                        'price_clp' => 290000.00,
                        'price_eur' => 285.00,
                        'price_mxn' => 6100.00,
                        'stock' => 0,
                        'is_available' => false,
                    ],
                    [
                        'format_name' => 'Lámina Fine Art A3 (Edición de 50)',
                        'format_type' => 'PRINT',
                        'price_usd' => 45.00,
                        'price_clp' => 42000.00,
                        'price_eur' => 41.00,
                        'price_mxn' => 890.00,
                        'stock' => 18,
                        'is_available' => true,
                    ],
                    [
                        'format_name' => 'Lámina Fine Art A4 (Compacta)',
                        'format_type' => 'PRINT',
                        'price_usd' => 30.00,
                        'price_clp' => 28000.00,
                        'price_eur' => 27.50,
                        'price_mxn' => 590.00,
                        'stock' => 30,
                        'is_available' => true,
                    ],
                ],
            ],
            [
                'title' => 'Vértigo Interior (Grafito Original)',
                'slug' => 'vertigo-interior',
                'description' => 'Estudio tonal de contrastes profundos. Rostro fragmentado en espirales continuas que desafían la percepción tridimensional del plano.',
                'short_description' => 'Grafito 2H a 8B con sombras sutiles y atmósfera psicológica.',
                'technique' => 'Grafito y esfumino sobre papel Bristol 250g',
                'dimensions' => '35 x 50 cm',
                'category' => 'originales',
                'main_image' => 'https://images.unsplash.com/photo-1582561424760-0321d75e81fa?q=80&w=1000',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1582561424760-0321d75e81fa?q=80&w=1000',
                ],
                'base_price_clp' => 420000,
                'base_price_usd' => 440,
                'has_original' => true,
                'original_sold' => false,
                'is_featured' => true,
                'variants' => [
                    [
                        'format_name' => 'Pieza Original (Enmarcado en madera noble de cedro)',
                        'format_type' => 'ORIGINAL',
                        'price_usd' => 440.00,
                        'price_clp' => 420000.00,
                        'price_eur' => 405.00,
                        'price_mxn' => 8700.00,
                        'stock' => 1,
                        'is_available' => true,
                    ],
                    [
                        'format_name' => 'Fine Art Print A3 (Algodón)',
                        'format_type' => 'PRINT',
                        'price_usd' => 48.00,
                        'price_clp' => 45000.00,
                        'price_eur' => 44.00,
                        'price_mxn' => 950.00,
                        'stock' => 20,
                        'is_available' => true,
                    ],
                ],
            ],
            [
                'title' => 'Serie Flash de Tatuajes - Edición Impresa',
                'slug' => 'serie-flash-tatuajes-edicion-impresa',
                'description' => 'Colección de 12 diseños exclusivos de autor para tatuaje seleccionados por Fredosis. Incluye motivos de botánica oscura, anatomía y figuras mitológicas.',
                'short_description' => 'Carpeta de láminas de coleccionista con 12 diseños exclusivos.',
                'technique' => 'Grabado digital y tinta sobre papel verjurado',
                'dimensions' => 'Carpeta A4 (12 láminas)',
                'category' => 'prints',
                'main_image' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1000',
                'gallery_images' => [
                    'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=1000',
                ],
                'base_price_clp' => 55000,
                'base_price_usd' => 60,
                'has_original' => false,
                'original_sold' => false,
                'is_featured' => false,
                'variants' => [
                    [
                        'format_name' => 'Carpeta Completa de 12 Láminas A4',
                        'format_type' => 'PRINT',
                        'price_usd' => 60.00,
                        'price_clp' => 55000.00,
                        'price_eur' => 55.00,
                        'price_mxn' => 1190.00,
                        'stock' => 25,
                        'is_available' => true,
                    ],
                ],
            ],
        ];

        foreach ($productsData as $prod) {
            $variants = $prod['variants'];
            unset($prod['variants']);

            $product = Product::updateOrCreate(
                ['slug' => $prod['slug']],
                $prod
            );

            foreach ($variants as $variant) {
                ProductVariant::updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'format_name' => $variant['format_name'],
                    ],
                    $variant
                );
            }
        }

        // 7. Sample Clients & Requests & Appointments for Fredosis Tattoo Agenda
        $client1 = Client::firstOrCreate(
            ['email' => 'camila.navarro@gmail.com'],
            ['name' => 'Camila Navarro', 'phone' => '+56 9 7890 1234']
        );

        $client2 = Client::firstOrCreate(
            ['email' => 'rodrigo.soto@gmail.com'],
            ['name' => 'Rodrigo Soto', 'phone' => '+56 9 9123 4567']
        );

        $req1 = BookingRequest::firstOrCreate(
            ['client_id' => $client1->id],
            [
                'description' => 'Diseño personalizado de línea fina con motivos botánicos y una polilla surrealista en el antebrazo. Quiero el estilo delicado y sombreado de Fredosis.',
                'size' => 'M (12-16 cm)',
                'body_zone' => 'Antebrazo exterior',
                'preferred_date' => Carbon::tomorrow()->setHour(12)->setMinute(0),
                'preferred_time_slot' => 'Morning',
                'budget' => '$140.000 - $180.000 CLP',
                'location' => 'Metro Santa Ana - Santiago Centro',
                'status' => 'APPROVED',
            ]
        );

        $req2 = BookingRequest::firstOrCreate(
            ['client_id' => $client2->id],
            [
                'description' => 'Blackwork surrealista con composición geométrica en la pantorrilla. Basado en la obra Ecos de la Percepción.',
                'size' => 'L (>18 cm)',
                'body_zone' => 'Pantorrilla / Pierna',
                'preferred_date' => Carbon::tomorrow()->addDays(2)->setHour(16)->setMinute(0),
                'preferred_time_slot' => 'Afternoon',
                'budget' => '$220.000 CLP',
                'location' => 'Metro Santa Ana - Santiago Centro',
                'status' => 'PENDING',
            ]
        );

        // Appointment for approved request
        Appointment::updateOrCreate(
            ['booking_request_id' => $req1->id],
            [
                'client_id' => $client1->id,
                'title' => 'Cita: Camila Navarro (Línea Fina Botánica)',
                'description' => 'Sesión de tatuaje de autor - Antebrazo exterior',
                'start_time' => Carbon::tomorrow()->setHour(12)->setMinute(0),
                'end_time' => Carbon::tomorrow()->setHour(16)->setMinute(0),
                'status' => 'CONFIRMED',
                'payment_status' => 'PAID',
                'deposit_amount' => 35000.00,
                'paid_at' => Carbon::yesterday(),
                'location' => 'Estudio Metro Santa Ana - Santiago',
                'price' => 160000.00,
            ]
        );

        // Flash Tattoos (Diseños Disponibles)
        $flashes = [
            [
                'title' => 'El Abrazo de la Sombra',
                'slug' => 'el-abrazo-de-la-sombra',
                'image_url' => 'https://images.unsplash.com/photo-1590201774843-021110a2663c?q=80&w=800',
                'description' => 'Composición anatómica surrealista en grafito y tinta china. Rostros entrelazados con gradaciones de whip shading y textura de claroscuro.',
                'price_clp' => 85000.00,
                'price_usd' => 90.00,
                'size_cm' => '14 x 9 cm',
                'recommended_zone' => 'Antebrazo, gemelo o tríceps',
                'is_claimed' => false,
                'sort_order' => 1,
            ],
            [
                'title' => 'Mirada Fragmentada',
                'slug' => 'mirada-fragmentada',
                'image_url' => 'https://images.unsplash.com/photo-1579783902614-a3fb3927b675?q=80&w=800',
                'description' => 'Retrato surrealista en línea fina y micro-puntillismo. Inspirado en el estilo introspectivo de Miles Johnston.',
                'price_clp' => 95000.00,
                'price_usd' => 100.00,
                'size_cm' => '16 x 11 cm',
                'recommended_zone' => 'Brazo, muslo o costado',
                'is_claimed' => false,
                'sort_order' => 2,
            ],
            [
                'title' => 'Corazón de Raíces',
                'slug' => 'corazon-de-raices',
                'image_url' => 'https://images.unsplash.com/photo-1544717305-2782549b5136?q=80&w=800',
                'description' => 'Fusión botánica y cardiovascular con finas ramas de brezo y hojas de helecho. Técnica pura de línea fina 3RL.',
                'price_clp' => 70000.00,
                'price_usd' => 75.00,
                'size_cm' => '10 x 8 cm',
                'recommended_zone' => 'Costillas, muñeca o clavícula',
                'is_claimed' => false,
                'sort_order' => 3,
            ],
            [
                'title' => 'Polilla de la Muerte & Esqueleto',
                'slug' => 'polilla-de-la-muerte-esqueleto',
                'image_url' => 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=800',
                'description' => 'Acherontia Atropos con cráneo anatómico detallado. Alto contraste en blackwork profundo y tramas de grabado antiguo.',
                'price_clp' => 110000.00,
                'price_usd' => 115.00,
                'size_cm' => '18 x 12 cm',
                'recommended_zone' => 'Pecho, esternón o espalda alta',
                'is_claimed' => false,
                'sort_order' => 4,
            ],
            [
                'title' => 'Mano Botánica & Cosmos',
                'slug' => 'mano-botanica-cosmos',
                'image_url' => 'https://images.unsplash.com/photo-1544717302-de2939b7ef71?q=80&w=800',
                'description' => 'Gesto anatómico sosteniendo ramas de olivo y constelaciones punteadas. Ya reservado para sesión privada.',
                'price_clp' => 80000.00,
                'price_usd' => 85.00,
                'size_cm' => '12 x 8 cm',
                'recommended_zone' => 'Antebrazo exterior',
                'is_claimed' => true,
                'claimed_by_name' => 'Matías R.',
                'sort_order' => 5,
            ],
            [
                'title' => 'Vórtice Óptico & Ojo',
                'slug' => 'vortice-optico-ojo',
                'image_url' => 'https://images.unsplash.com/photo-1598371839696-5c5bb00bdc28?q=80&w=800',
                'description' => 'Geometría no euclidiana y textura de grafito envolviendo la mirada. Adaptable a torsiones corporales.',
                'price_clp' => 90000.00,
                'price_usd' => 95.00,
                'size_cm' => '15 x 10 cm',
                'recommended_zone' => 'Gemelo o tríceps',
                'is_claimed' => false,
                'sort_order' => 6,
            ],
        ];

        foreach ($flashes as $f) {
            \App\Models\FlashTattoo::updateOrCreate(
                ['slug' => $f['slug']],
                $f
            );
        }
    }
}
