<?php
// app/Http/Livewire/ProductSearch.php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Product;

class ProductSearch extends Component
{
    public $search = '';

    public function render()
    {
        $products = Product::where('name', 'LIKE', '%'.$this->search.'%')->get();

        return view('livewire.product-search', ['products' => $products]);
    }
}
