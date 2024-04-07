<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\ApiSetting;

class ApiSettingCreate extends Component
{
    public $name;
    public $url;
    public $country;
    public $country_code;
 
    public function save() 
    {
        $api = ApiSetting::create([
            'name' => $this->name,
            'url' => $this->url,
            'country' => $this->country,
            'country_code' => $this->country_code,
        ]);
 
        return redirect()->to('/api/setting')
             ->with('status', 'api setting saved!');
    }

    public function render()
    {
        return view('api-setting-create')
               ->layout('layouts.app');
    }
}
