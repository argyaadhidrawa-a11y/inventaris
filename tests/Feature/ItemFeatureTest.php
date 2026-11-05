<?php

namespace Tests\Feature;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemFeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_index_is_accessible(): void
    {
        $response = $this->get(route('items.index'));

        $response->assertOk();
        $response->assertSee('Belum ada barang');
    }

    public function test_item_can_be_created(): void
    {
        $response = $this->post(route('items.store'), [
            'name' => 'Mouse USB',
            'category' => 'Elektronik',
            'stock' => 12,
            'price' => 75000,
        ]);

        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', [
            'name' => 'Mouse USB',
            'category' => 'Elektronik',
            'stock' => 12,
            'price' => 75000,
        ]);
    }

    public function test_item_can_be_updated(): void
    {
        $item = Item::create([
            'name' => 'Mouse Lama',
            'category' => 'Elektronik',
            'stock' => 2,
            'price' => 50000,
        ]);

        $response = $this->put(route('items.update', $item), [
            'name' => 'Mouse Baru',
            'category' => 'Elektronik',
            'stock' => 5,
            'price' => 80000,
        ]);

        $response->assertRedirect(route('items.index'));
        $this->assertDatabaseHas('items', [
            'id' => $item->id,
            'name' => 'Mouse Baru',
            'stock' => 5,
            'price' => 80000,
        ]);
    }

    public function test_item_can_be_deleted(): void
    {
        $item = Item::create([
            'name' => 'Spidol',
            'category' => 'ATK',
            'stock' => 3,
            'price' => 12000,
        ]);

        $response = $this->delete(route('items.destroy', $item));

        $response->assertRedirect(route('items.index'));
        $this->assertModelMissing($item);
    }

    public function test_item_creation_requires_valid_data(): void
    {
        $response = $this->from(route('items.create'))->post(route('items.store'), [
            'name' => '',
            'category' => '',
            'stock' => -1,
            'price' => -1,
        ]);

        $response->assertRedirect(route('items.create'));
        $response->assertSessionHasErrors(['name', 'category', 'stock', 'price']);
        $this->assertDatabaseCount('items', 0);
    }
}
