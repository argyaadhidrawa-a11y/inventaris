<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_categories_index_is_accessible(): void
    {
        $response = $this->get(route('categories.index'));

        $response->assertOk();
        $response->assertSee('Elektronik');
    }

    public function test_category_can_be_created(): void
    {
        $response = $this->post(route('categories.store'), [
            'name' => 'Kantor',
            'description' => 'Peralatan kantor',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', [
            'name' => 'Kantor',
            'description' => 'Peralatan kantor',
        ]);
    }

    public function test_category_can_be_updated_and_updates_items(): void
    {
        $category = Category::create(['name' => 'Lama', 'description' => 'Deskripsi lama']);
        $item = Item::create([
            'name' => 'Barang Test',
            'category' => 'Lama',
            'stock' => 1,
            'price' => 1000,
        ]);

        $response = $this->put(route('categories.update', $category), [
            'name' => 'Baru',
            'description' => 'Deskripsi baru',
        ]);

        $response->assertRedirect(route('categories.index'));
        $this->assertDatabaseHas('categories', ['id' => $category->id, 'name' => 'Baru']);
        $this->assertDatabaseHas('items', ['id' => $item->id, 'category' => 'Baru']);
    }

    public function test_category_can_be_deleted_when_unused(): void
    {
        $category = Category::create(['name' => 'Hapus Saja', 'description' => null]);

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $this->assertModelMissing($category);
    }

    public function test_category_used_by_item_cannot_be_deleted(): void
    {
        $category = Category::create(['name' => 'Dipakai', 'description' => null]);
        Item::create([
            'name' => 'Barang Test',
            'category' => 'Dipakai',
            'stock' => 1,
            'price' => 1000,
        ]);

        $response = $this->delete(route('categories.destroy', $category));

        $response->assertRedirect(route('categories.index'));
        $response->assertSessionHas('error');
        $this->assertModelExists($category);
    }

    public function test_category_creation_requires_unique_name(): void
    {
        $response = $this->from(route('categories.create'))->post(route('categories.store'), [
            'name' => 'Elektronik',
            'description' => '',
        ]);

        $response->assertRedirect(route('categories.create'));
        $response->assertSessionHasErrors('name');
    }
}
