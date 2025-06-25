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

    public function search()
    {
        if (strlen($this->search) > 0) {
            return redirect()->route('rent', ['q' => $this->search]);
        }
    }
}
