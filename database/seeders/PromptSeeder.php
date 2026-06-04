<?php

namespace Database\Seeders;

use App\Models\Prompt;
use App\Models\Category;
use Illuminate\Database\Seeder;

class PromptSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::pluck('id', 'slug');

        $prompts = [
            // ====== PORTRAIT ======
            [
                'title' => 'Golden Hour Cinematic Portrait',
                'category_id' => $categories['portrait'],
                'prompt_text' => 'A stunning cinematic portrait of a young woman with flowing auburn hair, golden hour lighting casting warm orange and amber tones across her face, bokeh background of blurred city lights, shot with 85mm lens, shallow depth of field, photorealistic, 8K resolution, professional photography',
                'style_tags' => 'golden hour, bokeh, cinematic, photorealistic',
                'description' => 'Foto potret dramatis dengan pencahayaan golden hour yang hangat',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 234,
            ],
            [
                'title' => 'Dark Moody Male Portrait',
                'category_id' => $categories['portrait'],
                'prompt_text' => 'Dark and moody portrait of a mysterious man in his 30s, dramatic side lighting, deep shadows, sharp facial features, slight stubble, wearing a dark leather jacket, black background, high contrast photography, analog film grain, extremely detailed, hyperrealistic',
                'style_tags' => 'dark, moody, high contrast, dramatic',
                'description' => 'Potret pria dengan gaya gelap dan dramatis',
                'ai_tool' => 'Midjourney',
                'is_featured' => false,
                'copy_count' => 187,
            ],
            [
                'title' => 'Ethereal Fantasy Portrait',
                'category_id' => $categories['portrait'],
                'prompt_text' => 'Ethereal portrait of a woman with translucent glowing skin, surrounded by floating cherry blossom petals, soft diffused lighting, pastel pink and lavender color palette, otherworldly beauty, flowing white silk dress, dreamy atmosphere, ultra sharp, 8K',
                'style_tags' => 'ethereal, dreamy, glowing, blossom',
                'description' => 'Potret wanita dengan nuansa ethereal dan bunga sakura',
                'ai_tool' => 'DALL-E 3',
                'is_featured' => true,
                'copy_count' => 312,
            ],
            [
                'title' => 'Street Style Urban Portrait',
                'category_id' => $categories['portrait'],
                'prompt_text' => 'Candid street photography style portrait of a young Asian woman in urban Tokyo, wearing oversized vintage clothing, neon signs reflected in rain puddles behind her, grain film photography aesthetic, Kodak Portra 400 color palette, natural expressions, life on the street',
                'style_tags' => 'street, urban, Tokyo, film grain, candid',
                'description' => 'Potret street style di jalanan Tokyo yang ramai',
                'ai_tool' => 'Stable Diffusion',
                'is_featured' => false,
                'copy_count' => 156,
            ],

            // ====== LANDSCAPE ======
            [
                'title' => 'Epic Mountain Sunrise',
                'category_id' => $categories['landscape'],
                'prompt_text' => 'Breathtaking panoramic landscape of majestic snow-capped mountains at sunrise, dramatic orange and pink clouds reflecting on a perfectly still alpine lake in the foreground, misty valleys, god rays breaking through clouds, ultra wide angle shot, hyper detailed, award winning photography, National Geographic style',
                'style_tags' => 'mountain, sunrise, panoramic, epic, lake',
                'description' => 'Pemandangan pegunungan epik saat matahari terbit',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 445,
            ],
            [
                'title' => 'Dramatic Ocean Storm',
                'category_id' => $categories['landscape'],
                'prompt_text' => 'Dramatic seascape photograph of massive ocean waves crashing against ancient dark sea cliffs during a powerful storm, lightning striking in the distance, dark moody sky with storm clouds, sea foam and spray, deep blue and grey tones, long exposure photography effect, cinematic and powerful',
                'style_tags' => 'ocean, storm, dramatic, waves, cliffs',
                'description' => 'Lautan liar dengan badai dramatis dan petir',
                'ai_tool' => 'Midjourney',
                'is_featured' => false,
                'copy_count' => 298,
            ],
            [
                'title' => 'Autumn Forest Magical Path',
                'category_id' => $categories['landscape'],
                'prompt_text' => 'Enchanting forest path covered in fallen autumn leaves, ancient tall trees with twisted roots forming natural archways, soft golden light filtering through canopy, morning mist at ground level, warm orange yellow red color palette, magical and peaceful atmosphere, professional landscape photography',
                'style_tags' => 'forest, autumn, magical, golden, path',
                'description' => 'Jalan hutan di musim gugur yang magis dan indah',
                'ai_tool' => 'Leonardo AI',
                'is_featured' => false,
                'copy_count' => 203,
            ],
            [
                'title' => 'Milky Way Desert Skies',
                'category_id' => $categories['landscape'],
                'prompt_text' => 'Stunning astrophotography of the Milky Way galaxy arching over red sandstone desert formations, thousands of stars visible, purple and blue nebula colors, foreground desert rocks illuminated by ambient starlight, long exposure photography, no light pollution, pristine night sky, Sony A7R IV style',
                'style_tags' => 'milky way, astrophotography, desert, night sky',
                'description' => 'Galaksi Bima Sakti di atas gurun yang menakjubkan',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 521,
            ],

            // ====== FANTASY ======
            [
                'title' => 'Ancient Dragon Over Castle',
                'category_id' => $categories['fantasy'],
                'prompt_text' => 'An ancient and magnificent dragon with iridescent scales soaring above a medieval fantasy castle, dramatic lightning storm in the background, glowing orange eyes, wings spanning hundreds of feet, fire breath illuminating dark thunderclouds below, epic fantasy art style, ultra detailed, cinematic composition, 8K',
                'style_tags' => 'dragon, castle, epic, medieval, lightning',
                'description' => 'Naga kuno yang megah terbang di atas kastil medieval',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 678,
            ],
            [
                'title' => 'Underwater Mermaid Kingdom',
                'category_id' => $categories['fantasy'],
                'prompt_text' => 'Breathtaking underwater fantasy kingdom, a beautiful mermaid with glittering silver tail swimming through grand coral palace architecture, bioluminescent sea creatures, rays of sunlight piercing deep blue water, schools of colorful fish, magical and serene, hyperrealistic digital art',
                'style_tags' => 'mermaid, underwater, bioluminescent, fantasy',
                'description' => 'Kerajaan bawah laut putri duyung yang megah',
                'ai_tool' => 'Adobe Firefly',
                'is_featured' => false,
                'copy_count' => 389,
            ],
            [
                'title' => 'Enchanted Mystical Forest Spirit',
                'category_id' => $categories['fantasy'],
                'prompt_text' => 'A glowing forest spirit made of translucent light and ancient bark standing in a mystical dark forest, surrounded by floating magical orbs of soft light, fireflies, bioluminescent mushrooms at its feet, ethereal fog, deep greens and blues with golden accents, Studio Ghibli inspired, ultra detailed',
                'style_tags' => 'forest spirit, ghibli, bioluminescent, mystical',
                'description' => 'Roh hutan yang berpendar dalam hutan mistis',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 502,
            ],
            [
                'title' => 'Ice Queen Dark Fantasy',
                'category_id' => $categories['fantasy'],
                'prompt_text' => 'Dark fantasy portrait of an ice queen with crystalline crown of frozen shards, pale white skin with blue veins visible, glacial white and silver armor, icy breath visible in cold air, frozen tundra throne room behind her, hyper detailed face, dramatic rim lighting, regal and terrifying',
                'style_tags' => 'ice queen, dark fantasy, crystal, regal',
                'description' => 'Ratu es dengan mahkota kristal beku yang megah',
                'ai_tool' => 'Stable Diffusion',
                'is_featured' => false,
                'copy_count' => 267,
            ],

            // ====== CINEMATIC ======
            [
                'title' => 'Blade Runner Neon Alley',
                'category_id' => $categories['cinematic'],
                'prompt_text' => 'Cinematic shot of a rain-soaked futuristic city alley at night, Blade Runner 2049 aesthetic, neon holographic advertisements reflected on wet pavement, lone figure walking with umbrella, steam rising from grates, orange and blue color grading, anamorphic lens flares, moody atmosphere, 21:9 cinematic ratio',
                'style_tags' => 'blade runner, neon, rain, cinematic, cyberpunk',
                'description' => 'Lorong hujan futuristik ala Blade Runner 2049',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 734,
            ],
            [
                'title' => 'Post-Apocalyptic Survivor',
                'category_id' => $categories['cinematic'],
                'prompt_text' => 'Epic cinematic wide shot of a lone survivor standing on top of crumbled skyscraper ruins overgrown with jungle vegetation, post-apocalyptic world, dramatic sunset breaking through ash clouds, warm golden-orange backlight, cinematic scope, inspired by The Last of Us, ultra detailed environment',
                'style_tags' => 'post-apocalyptic, survivor, cinematic, jungle',
                'description' => 'Penyintas sendirian di reruntuhan gedung pasca kiamat',
                'ai_tool' => 'Midjourney',
                'is_featured' => false,
                'copy_count' => 456,
            ],
            [
                'title' => 'Mafia Boss Noir Scene',
                'category_id' => $categories['cinematic'],
                'prompt_text' => 'Film noir style cinematic scene of a powerful mafia boss in 1940s suit sitting at dimly lit office desk, cigarette smoke curling in single spotlight beam, shadows and venetian blind patterns across his face, black and white with subtle color accents, high contrast, moody and tense atmosphere',
                'style_tags' => 'film noir, mafia, 1940s, dramatic shadows',
                'description' => 'Adegan film noir bos mafia dengan bayangan dramatis',
                'ai_tool' => 'DALL-E 3',
                'is_featured' => false,
                'copy_count' => 321,
            ],

            // ====== ARCHITECTURE ======
            [
                'title' => 'Futuristic Glass Skyscraper',
                'category_id' => $categories['architecture'],
                'prompt_text' => 'Architectural photography of an impossibly tall futuristic glass and steel skyscraper piercing through clouds, parametric design with organic flowing forms, reflective surface mirroring blue sky, drone perspective from below looking up, ultra sharp details, award winning architectural photography',
                'style_tags' => 'skyscraper, futuristic, glass, parametric',
                'description' => 'Pencakar langit kaca futuristik dengan desain organik',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 287,
            ],
            [
                'title' => 'Japanese Zen Temple Garden',
                'category_id' => $categories['architecture'],
                'prompt_text' => 'Serene Japanese zen temple garden photography, traditional pagoda reflected in perfectly still koi pond, raked gravel patterns, ancient moss-covered stone lanterns, cherry blossom trees framing the scene, soft morning light, misty atmosphere, National Geographic quality photography',
                'style_tags' => 'japanese, zen, temple, garden, serene',
                'description' => 'Taman kuil Zen Jepang yang tenang dan indah',
                'ai_tool' => 'Leonardo AI',
                'is_featured' => false,
                'copy_count' => 198,
            ],
            [
                'title' => 'Luxury Minimalist Interior',
                'category_id' => $categories['architecture'],
                'prompt_text' => 'Stunning luxury minimalist interior photography, vast open living space with floor-to-ceiling windows overlooking ocean view, warm walnut wood and white marble surfaces, designer furniture, golden hour light flooding in, lush indoor plants, award winning interior design photography, ultra sharp',
                'style_tags' => 'interior, minimalist, luxury, ocean view',
                'description' => 'Interior minimalis mewah dengan pemandangan laut',
                'ai_tool' => 'Midjourney',
                'is_featured' => false,
                'copy_count' => 245,
            ],

            // ====== NATURE & MACRO ======
            [
                'title' => 'Crystal Water Droplet Macro',
                'category_id' => $categories['nature-macro'],
                'prompt_text' => 'Extreme macro photography of a single perfect water droplet on a green leaf, miniature world reflected inside the droplet, morning dew, bokeh background of soft greens, ultra sharp focus on droplet surface, studio lighting with catchlights, scientific yet beautiful, 100mm macro lens, 1:1 ratio',
                'style_tags' => 'macro, water droplet, leaf, reflection',
                'description' => 'Foto makro ekstrem tetesan air dengan refleksi dunia',
                'ai_tool' => 'Stable Diffusion',
                'is_featured' => false,
                'copy_count' => 176,
            ],
            [
                'title' => 'Butterfly Wing Kaleidoscope',
                'category_id' => $categories['nature-macro'],
                'prompt_text' => 'Incredible macro photography of a butterfly wing surface revealing microscopic scales arranged in geometric patterns, iridescent colors shifting between blue, purple and gold depending on angle, abstract and beautiful texture, extreme detail, scientific macro photography, shallow depth of field',
                'style_tags' => 'butterfly, macro, iridescent, texture, scales',
                'description' => 'Pola sisik sayap kupu-kupu dalam foto makro ekstrem',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 334,
            ],
            [
                'title' => 'Frozen Snowflake Crystal',
                'category_id' => $categories['nature-macro'],
                'prompt_text' => 'Stunning macro photograph of a single perfect snowflake crystal, intricate geometric symmetrical structure, icy blue and white tones with prismatic rainbow light refractions, dark velvet background, studio macro setup, every hexagonal detail crystal clear, scientifically accurate snowflake structure',
                'style_tags' => 'snowflake, macro, crystal, geometric, ice',
                'description' => 'Kristal salju dengan struktur geometris yang sempurna',
                'ai_tool' => 'DALL-E 3',
                'is_featured' => false,
                'copy_count' => 221,
            ],

            // ====== SCI-FI & CYBER ======
            [
                'title' => 'Cyberpunk Street Fighter',
                'category_id' => $categories['scifi-cyber'],
                'prompt_text' => 'Hyperdetailed cyberpunk character concept art, female street fighter with glowing neon cybernetic implants and prosthetic arm, torn punk clothing, mohawk hair with LED strips, dark rainy megacity Tokyo-3 background, RGB holographic displays, extremely detailed, 4K, trending on ArtStation',
                'style_tags' => 'cyberpunk, neon, character, cybernetic, Tokyo',
                'description' => 'Karakter pejuang jalanan cyberpunk dengan implant neon',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 812,
            ],
            [
                'title' => 'Space Station Interior',
                'category_id' => $categories['scifi-cyber'],
                'prompt_text' => 'Cinematic interior shot of a massive futuristic space station command bridge, panoramic windows showing the Milky Way galaxy and a ringed planet, holographic displays and interfaces, crew members in advanced suits, dramatic blue and white lighting, photorealistic sci-fi, inspired by Interstellar and The Expanse',
                'style_tags' => 'space station, sci-fi, cinematic, galaxy, command bridge',
                'description' => 'Interior stasiun luar angkasa futuristik dengan pemandangan galaksi',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 567,
            ],
            [
                'title' => 'AI Robot Emotional Portrait',
                'category_id' => $categories['scifi-cyber'],
                'prompt_text' => 'Photorealistic portrait of a humanoid robot with incredibly detailed mechanical face expressing genuine sadness and contemplation, glowing blue optical sensors as eyes, exposed metal skeleton with synthetic skin partially peeled away, dramatic side lighting, shallow depth of field, exploring themes of artificial consciousness',
                'style_tags' => 'robot, AI, humanoid, emotional, photorealistic',
                'description' => 'Potret robot humanoid yang mengekspresikan emosi kesedihan',
                'ai_tool' => 'DALL-E 3',
                'is_featured' => false,
                'copy_count' => 423,
            ],
            [
                'title' => 'Quantum Computer Visualization',
                'category_id' => $categories['scifi-cyber'],
                'prompt_text' => 'Abstract visualization of a quantum computer processor, glowing quantum bits floating in geometric lattice structure, deep blue and cyan energy streams connecting nodes, cryogenic cooling effects with frost and ice crystals, extreme precision and detail, scientific yet artistic, dark background, 8K render',
                'style_tags' => 'quantum, abstract, tech visualization, glowing',
                'description' => 'Visualisasi artistik komputer kuantum dengan energi biru',
                'ai_tool' => 'Stable Diffusion',
                'is_featured' => false,
                'copy_count' => 289,
            ],
            [
                'title' => 'Neon Synthwave City',
                'category_id' => $categories['scifi-cyber'],
                'prompt_text' => 'Retrofuturistic synthwave aesthetic aerial view of a glowing grid-lined city at night, massive neon sun setting on the horizon, purple and pink chromatic color palette, flying cars leaving light trails, chrome surfaces and retro-future architecture, 80s nostalgia meets futurism, vaporwave vibes, ultra sharp',
                'style_tags' => 'synthwave, vaporwave, neon, retrofuturistic, 80s',
                'description' => 'Kota retrofuturistik dengan estetika synthwave yang ikonik',
                'ai_tool' => 'Midjourney',
                'is_featured' => true,
                'copy_count' => 945,
            ],
        ];

        foreach ($prompts as $prompt) {
            Prompt::create($prompt);
        }
    }
}
