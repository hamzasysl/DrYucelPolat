<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuController extends Controller
{
    public function index(Request $request)
    {
        $location = $request->query('location', 'header');
        $items = Menu::query()
            ->where('location', $location)
            ->orderBy('parent_id')
            ->orderBy('sort_order')
            ->get();
        $rootItems = $items->whereNull('parent_id')->values();

        // Inline form: ?edit={id} veya ?create=1[&parent={id}]
        $editingId = $request->query('edit');
        $creating  = $request->query('create');
        $parentId  = $request->query('parent');

        $editingMenu = null;
        $newMenu     = null;

        if ($editingId) {
            $editingMenu = Menu::query()->find($editingId);
        }
        if ($creating) {
            $newMenu = new Menu([
                'location'    => $location,
                'parent_id'   => $parentId && $rootItems->contains('id', $parentId) ? (int) $parentId : null,
                'is_active'   => true,
                'is_dropdown' => false,
                'target'      => '_self',
                'sort_order'  => $items->where('parent_id', $parentId ?: null)->max('sort_order') + 1 ?: 1,
            ]);
        }

        $parents     = $rootItems;
        $pageOptions = $this->pageOptions();

        return view('admin.menus.index', compact(
            'rootItems', 'items', 'location',
            'editingMenu', 'newMenu', 'parents', 'pageOptions', 'parentId'
        ));
    }

    public function create(Request $request)
    {
        $location = $request->query('location', 'header');
        $parentId = $request->query('parent');
        $parents  = Menu::query()->where('location', $location)->whereNull('parent_id')->orderBy('sort_order')->get();

        $menu = new Menu([
            'location'  => $location,
            'parent_id' => $parentId && $parents->contains('id', $parentId) ? (int) $parentId : null,
            'is_active' => true,
        ]);

        return view('admin.menus.form', [
            'menu'        => $menu,
            'parents'     => $parents,
            'pageOptions' => $this->pageOptions(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);
        $menu = Menu::create($data);
        $this->clearCache($data['location']);
        return redirect()->route('admin.menus.index', ['location' => $data['location']])
            ->with('ok', "“{$menu->label}” menü öğesi eklendi.");
    }

    public function edit(Menu $menu)
    {
        $parents = Menu::query()->where('location', $menu->location)->whereNull('parent_id')->where('id', '!=', $menu->id)->orderBy('sort_order')->get();
        return view('admin.menus.form', [
            'menu'        => $menu,
            'parents'     => $parents,
            'pageOptions' => $this->pageOptions(),
        ]);
    }

    public function update(Request $request, Menu $menu)
    {
        $menu->update($this->validated($request));
        $this->clearCache($menu->location);
        return redirect()->route('admin.menus.index', ['location' => $menu->location])->with('ok', 'Menü öğesi güncellendi.');
    }

    public function destroy(Menu $menu)
    {
        $location = $menu->location;
        $menu->delete();
        $this->clearCache($location);
        return redirect()->route('admin.menus.index', ['location' => $location])->with('ok', 'Menü öğesi silindi.');
    }

    private function clearCache(string $location): void
    {
        \Illuminate\Support\Facades\Cache::forget("menu:items:{$location}");
    }

    /**
     * Menü öğesinin yönlendireceği sayfaları "Sayfa seç" select'i için döndürür.
     * - Statik sayfalar (Anasayfa, Hakkımda...) → route_name ile
     * - Hizmet detay sayfaları (has_page=true) → URL ile
     */
    private function pageOptions(): array
    {
        $labels = [
            'home'            => 'Anasayfa',
            'about'           => 'Hakkımda',
            'services.index'  => 'Hizmetler (Tümü)',
            'blog.index'      => 'Blog',
            'contact'         => 'İletişim',
            'sitemap.html'    => 'Site Haritası',
        ];

        $pages = [];
        foreach ($labels as $route => $label) {
            if (\Illuminate\Support\Facades\Route::has($route)) {
                $pages[] = [
                    'label' => $label,
                    'value' => 'route:' . $route,
                    'group' => 'Ana Sayfalar',
                ];
            }
        }

        foreach (config('treatments', []) as $t) {
            if ($t['has_page'] ?? false) {
                $pages[] = [
                    'label' => $t['title'],
                    'value' => 'url:/hizmetler/' . $t['slug'],
                    'group' => 'Hizmet Sayfaları',
                ];
            } else {
                $pages[] = [
                    'label' => $t['title'] . ' (henüz sayfası yok)',
                    'value' => 'url:#',
                    'group' => 'Hizmet Sayfaları (Taslak)',
                ];
            }
        }

        $pages[] = [
            'label' => 'Özel URL (manuel gir)',
            'value' => 'custom',
            'group' => 'Diğer',
        ];

        return $pages;
    }

    public function reorder(Request $request)
    {
        $order = $request->input('order', []);
        foreach ($order as $i => $id) {
            Menu::query()->where('id', $id)->update(['sort_order' => $i]);
        }
        return response()->json(['ok' => true]);
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'location'    => ['required', Rule::in(['header', 'footer', 'mobile'])],
            'parent_id'   => ['nullable', 'exists:menus,id'],
            'label'       => ['required', 'string', 'max:120'],
            'url'         => ['nullable', 'string', 'max:300'],
            'route_name'  => ['nullable', 'string', 'max:100'],
            'icon'        => ['nullable', 'string', 'max:60'],
            'target'      => ['required', Rule::in(['_self', '_blank'])],
            'is_active'   => ['required', 'boolean'],
            'is_dropdown' => ['required', 'boolean'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
        ]);
    }
}
