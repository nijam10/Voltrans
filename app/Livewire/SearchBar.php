<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class SearchBar extends Component
{

    public $search = '';

    public function render()
    {

        $results = [];

        if (strlen($this->search) >= 1 ) {
            $results = Product::where('name', 'like', '%' . $this->search . '%')->limit(7)->get();
        };
        return view('livewire.search-bar', [
            'products' => $results
        ]);
    }

    public function getProduct()
    {
        if (strlen($this->search) >= 1 ) {
            return redirect()->to(route('rent', ['q' => $this->search]) . '#product-list');
        };
        
    }
}
