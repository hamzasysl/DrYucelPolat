<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        if (Menu::count() > 0) return;

        $items = [
            ['label' => 'Anasayfa',   'route_name' => 'home',            'icon' => null,                'sort_order' => 1],
            ['label' => 'Hakkımda',   'route_name' => 'about',           'icon' => null,                'sort_order' => 2],
            ['label' => 'Hizmetler',  'route_name' => 'services.index',  'icon' => null,                'sort_order' => 3, 'is_dropdown' => true],
            ['label' => 'Blog',       'route_name' => 'blog.index',      'icon' => null,                'sort_order' => 4],
            ['label' => 'İletişim',   'route_name' => 'contact',         'icon' => null,                'sort_order' => 5],
        ];

        $parents = [];
        foreach ($items as $item) {
            $menu = Menu::create(array_merge(['location' => 'header', 'is_active' => true], $item));
            $parents[$item['label']] = $menu;
        }

        // Hizmetler dropdown'una alt menüler — has_page=true olan tek hizmet (varis-tedavisi) gerçek route'a gider
        // Diğerleri url=# (henüz sayfa yok, admin daha sonra has_page true yapınca route'a bağlanabilir).
        $hizmetler = $parents['Hizmetler'] ?? null;
        if ($hizmetler) {
            $i = 0;
            foreach (config('treatments', []) as $t) {
                $hasPage = $t['has_page'] ?? false;
                Menu::create([
                    'location'    => 'header',
                    'parent_id'   => $hizmetler->id,
                    'label'       => $t['title'],
                    'route_name'  => null,
                    'url'         => $hasPage ? '/hizmetler/' . $t['slug'] : '#',
                    'icon'        => $t['icon'],
                    'target'      => '_self',
                    'is_active'   => true,
                    'is_dropdown' => false,
                    'sort_order'  => ++$i,
                ]);
            }
        }
    }
}
