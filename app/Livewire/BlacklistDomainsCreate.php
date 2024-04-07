<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\BlacklistDomain;

class BlacklistDomainsCreate extends Component
{

    public $domain;
 
    public function save() 
    {
        $domain = BlacklistDomain::create([
            'domain' => $this->domain
        ]);
 
        return redirect()->to('/blacklist/domains')
             ->with('status', 'domain blacklisted!');
    }

    public function render()
    {
        return view('blacklist-domains-create')
                ->layout('layouts.app');
    }
}
