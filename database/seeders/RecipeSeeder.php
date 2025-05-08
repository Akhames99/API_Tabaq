<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipeSeeder extends Seeder
{

    public function run()
    {
        $recipes = [
            [
                'name' => 'سباغيتي مع قطع اللحم المفروم',
                'description' => '',
                'price' => 90,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\beef-spaghetti-there-are-plenty-tomatoes-chopped-beef.png',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'لحم بقري مشوي مع البطاطس والفلفل',
                'description' => '',
                'price' => 170,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\beef-meat-roast-with-potato-pepper.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'لحم بقري مع فلفل رومي ملون',
                'description' => '',
                'price' => 190,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\beef-with-colorful-bell-peppers-wooden-table.png',
                'cuisine_type_id' => 1, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'لحم مشوي مع الفلفل (مطبخ آسيوي)',
                'description' => '',
                'price' => 120,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\asian-cuisine-roasted-meat-with-peppers.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'مكرونة بيني مع الدجاج وصلصة الطماطم',
                'description' => '',
                'price' => 65,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\penne-pasta-tomato-sauce-with-chicken-tomatoes.png',
                'cuisine_type_id' => 2, // Western
                'categories'=>[2,3]
            ],
            [
                'name' => 'سمك دورادو مخبوز مع الليمون وسلطة جاهزة',
                'description' => '',
                'price' => 95,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\baked-fish-dorado-with-lemon-fresh-salad.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2,3]
            ],
            [
                'name' => 'بطاطس مخبوزة مع البصل والثوم والأعشاب',
                'description' => '',
                'price' => 50,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\baked-potatoes-cast-iron-pan-with-onion-garlic.png',
                'cuisine_type_id' => 1, // Western
                'categories'=>[1,2,3]
            ],
            [
                'name' => 'كبد دجاج مقلي مع صلصة التوت البري',
                'description' => '',
                'price' => 70,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\fried-chicken-liver-with-cranberry-sauce-cranberries.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'أسياخ دجاج مع الفلفل الحلو والشبت',
                'description' => '',
                'price' => 105,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\chicken-skewers-with-slices-sweet-peppers.png',
                'cuisine_type_id' => 1, // Western
                'categories'=>[2]
            ],
            [
                'name' => 'مكرونة بيني مع الدجاج وصلصة الطماطم',
                'description' => '',
                'price' => 60,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\chicken-liver-offal-with-onions-tomatoes.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'كباب نباتي بالخضروات مع صلصة الكاجو والبابريكا',
                'description' => '',
                'price' => 120,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\ready-vegan-kebabs-vegetables-smoked-tofu-with-cashew-sauce.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'تورتيلا ملفوفة بالفلافل والسلطة',
                'description' => '',
                'price' => 80,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\tortilla-wrap-with-falafel-fresh-salad.png',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[2]
            ],
            [
                'name' => 'عش العصافير (كفافة بالكريمة)',
                'description' => '1. افرمي الكنافة بأطراف أصابعك وقلّبيها مع الزبدة المذابة حتى تتشبع.
2. شكّلي أكواماً صغيرة (≈20 غ) كعشّات في قوالب المافن أو مباشرة على صينية، واخبزيها في فرن محمّى على 180°م (350°ف) لمدة 15–20 دقيقة حتى تكتسب لوناً ذهبياً.
3. اخفقي الكريمة مع السكر وماء الورد حتى تتماسك خفيفاً.
4. بردّي الأعشاش ثم احشّيها بالكريمة.
5. زيّني كل قطعة بالفستق المجروش وبتلة الورد، وقدّميها فوراً.',
                'price' => 60,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Kunafa_3esh.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'بلح الشام',
                'description' => '1. اغلي الماء مع الزبدة والسكر والملح، ثم ارفعيه عن النار وأضيفي الدقيق دفعة واحدة حتى يتشكل لديكِ «عجينة خبز».
2. اتركي العجينة تبرد 5 دقائق، ثم أضيفي البيض واحدة تلو الأخرى وحركي حتى يتجانس.
3. سخني الزيت (180°م) واضغطي العجينة في كيس حلواني مع رأس نجمي، شكّلي شرائط حوالي 8–10 سم، واقليها حتى تنتفخ وتتحمر.
4. لتحضير السيرب، اغلي مكوناته معاً 5–7 دقائق حتى يثخن قليلاً، ثم صفيه من الليمون.
5. انقعي القطع المقلية في السيرب الدافئ لبضع ثوانٍ ثم صفيها وقدّميها دافئة أو بدرجة حرارة الغرفة.',
                'price' => 45,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Bala7_Elsham.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'قطايف بالفسدق',
                'description' => '1. اخلطي مكونات العجين مع الماء، واتركيها 30 دقيقة حتى تتخمّر وتظهر فقاعات.
2. اسكبي دوائر (Ø≈8 سم) على مقلاة مسبّتة ومشحمة خفيفاً، واطهيها من جهة واحدة فقط حتى تتثبت السطح ولا تقلبّيها.
3. أثناء الدفء، شكّلي كل دائرة ك مخروط وأغلقي حافتين ببقعة صغيرة من العجين أو السيرب.
4. اخلطي الجبنة مع السكر البودرة، واملأي المخاريط ثم غمّسي أطرافها بالفستق.
5. قدّميها طازجة مع رشة عسل أو سيرب حسب الرغبة.',
                'price' => 50,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\2atayef.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'رمووش الست',
                'description' => '1. اخلطي المكونات الجافة، ثم أضيفي الزيت والحليب حتى تحصلي على عجينة طرية. اتركيها 15 دقيقة مغطاة.
2. شكّليها على شكل أصابع بحجم 5 سم، وارشي سطحها بنعومة.
3. اخبزيها على 180°م لمدة 15–18 دقيقة حتى تكتسب لوناً ذهبياً.
4. اسقيها بالسيرب الدافئ مباشرة بعد الخروج من الفرن، ثم صفيها.
5. قدّميها في قوالب ورقية ورشي فوقها الفستق والورد.',
                'price' => 35,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Romoush_Elset.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'زلابيه',
                'description' => '1. أخلطي المكونات مع الماء، وغطيها واتركيها ساعة حتى تختمر ويتضاعف حجمها.
2. سخني الزيت (170°م)، واستعملي ملعقة أو اثنتين للإسقاط في الزيت لتتشكل كرات. اقليها حتى تتحمر من كل الجهات.
3. انقليها مباشرة إلى السيرب الدافئ أو اسقيها بالعسل.
4. رتبيها في طبق ورشي فوقها الفستق المطحون وقدّميها.',
                'price' => 55,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\zalabia.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'بسبوسة',
                'description' => '1. اخلطي السميد وجوز الهند والسكر والبيكنج باودر، ثم أضيفي الزبادي والزبدة والفانيليا حتى يتجانس.
2. اسكبي الخليط في قالب مدهون بالزبدة، وزيّنيه بالمكسرات.
3. اخبزيه على 180°م لمدة 25–30 دقيقة حتى يحمر القعر.
4. اسقيه فوراً بالسيرب الدافئ واتركيه يمتصه قبل التقطيع.',
                'price' => 65,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Basbosa.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'أم علي',
                'description' => '1. وزّعي قطع العجين في صينية فرن.
2. سخني الحليب مع الكريمة والسكر والفانيليا حتى يذوب السكر (دون الغليان).
3. اسكبي المزيج برفق فوق العجين، ونثري المكسرات والزبيب.
4. اخبزي على 180°م لمدة 20–25 دقيقة حتى ينتفخ السطح ويحمر قليلاً.
5. قدّميها دافئة مع رشة مكسرات إضافية.',
                'price' => 70,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Um_Ali.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'كنافة بالجبنة',
                'description' => '1. افركي الكنافة مع الزبدة جيداً.
2. ضعي نصف الكنافة في القالب واضغطيها جيداً، أعيدي توزيع الجبنة ثم غطّيها بباقي الكنافة واضغطي.
3. اخبزي على 180°م لمدة 25–30 دقيقة حتى يتحمر الوجه.
4. أخرجيها وصبي فوقها السيرب الدافئ مباشرة.
5. زينيها بالفستق المطحون، وقطّعيها وتناوليها دافئة.',
                'price' => 60,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Kunafa_with_Mozzarella.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'أرز بلبن',
                'description' => '1. اسلقي الأرز بكمية قليلة من الماء حتى يشربه تقريباً.
2. أضيفي الحليب والفانيليا (أو القشر) والملح، واطهي على نار هادئة مع التحريك المستمر حتى يثخن (20–30 دقيقة).
3. أضيفي السكر واطهي 5 دقائق إضافية.
4. قدميه ساخناً أو بارداً مع ما ترغبين من التزيين.',
                'price' => 50,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Roz_Blbn.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'بقلاوة',
                'description' => '1. ادهني كل ورقة بالزبدة، واثنِها نصفين ثم ادهنيها مجدداً.
2. ضعي ملعقة صغيرة من خليط المكسرات عند الحافة واطويها شكل مثلث (كما تطوَى الراية) حتى ينتهي الحشو.
3. رصي المثلثات في صينية، ادهنّي السطح بالزبدة، واخبزيها على 180°م لمدة 20 دقيقة حتى تكتسب لوناً ذهبياً.
4. اسقيها بالسيرب الدافئ فور خروجها من الفرن، ورشي فوقها فستقاً مطحوناً.',
                'price' => 70,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Ba2lawa.jpg',
                'cuisine_type_id' => 1, // Eastern
                'categories'=>[4]
            ],
            [
                'name' => 'مهلابيه',
                'description' => '1. انقعي ورقات الجلاتين في ماء بارد 5 دقائق.
2. سخني الكريمة والحليب مع السكر وقشر البرتقال (إن وُجد) على نار هادئة حتى يذوب السكر (دون الغليان).
3. اعصري الجلاتين من الماء وأضيفيه إلى المزيج مع التحريك حتى يذوب تمامًا.
4. ارفعي المزيج من الحرارة، دعكه يبرد قليلًا ثم أضيفي عصير البرتقال وحرّكي.
5. صبي الخليط في أكواب وقدّميها باردة بعد التبريد في الثلاجة 4 ساعات. زيني بشرائح البرتقال.',
                'price' => 65,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Mahalabia.jpg',
                'cuisine_type_id' => 2,
                'categories'=>[4]
            ],
            [
                'name' => 'معمول بالتمر',
                'description' => '1. اخلطي الدقيق والسميد والسكر ثم أضيفي الزبدة وافركيها بأطراف الأصابع حتى يشبه الخليط فتات الخبز.
2. أضيفي ماء الورد تدريجيًا واخلطي حتى تتشكل عجينة طرية. غطيها واتركيها 30 دقيقة.
3. حضري الحشوة: حمّي السمن في مقلاة، أضيفي التمر والقرفة واطهي مع التحريك 5 دقائق، بردّي الحشوة.
4. شكلي العجينة كرات صغيرة، افرغي وسطها للحشوة، وأغلقيها جيدًا ثم اضغطيها في قوالب المعمول لعزل النقوش.
5. رصي القطع في صينية بدون دهن، واخبزيها على 170°م لمدة 15–18 دقيقة حتى تثبت دون تحمير زائد.
6. بردّيها ورشي فوقها سكر بودرة قبل التقديم.',
                'price' => 50,
                'image_url' => 'http://127.0.0.1\8000\storage\app\public\images\Ma3moul_Tamr.jpg',
                'cuisine_type_id' => 2,
                'categories'=>[4]
            ],
        ];

        foreach ($recipes as $recipeData) {
            $categories = $recipeData['categories'] ?? [];
            
            // Remove 'categories' before calling create()
            unset($recipeData['categories']);
        
            $recipe = Recipe::create($recipeData);
        
            if (!empty($categories)) {
                $recipe->categories()->attach($categories);
            }
        }                
    }
}