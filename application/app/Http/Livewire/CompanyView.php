<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Company;

class CompanyView extends Component
{

    public $company;

    public $isOpen = false;

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        return view('livewire.company-view');
    }

    public function addProject()
    {
        $this->isOpen = true;
    }

    public function create()
    {
    }
}
