<?php

namespace App\Livewire;

use Illuminate\Database\Eloquent\Builder;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateRangeFilter;

use App\Models\BlacklistDomain;

class BlacklistDomainsDataTable extends DataTableComponent
{
    protected $model = BlacklistDomain::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setPerPageAccepted([10, 20, 30, 50, 100]);

        $this->setPerPage(100);

        $this->setDefaultSort('created_at', 'desc');
    }
    

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable()
                ->searchable(),
            Column::make('X')
                // Note: The view() method is reserved for columns that have a field
                ->label(
                    fn($row, Column $column) => view('components.row-actions')->withRow($row)
            ),
            Column::make("Domain", "domain")
                ->sortable()
                ->searchable(),
   
        ];
    }

    public function deleteSingleRecord($id){
        BlacklistDomain::findOrFail($id)->delete();
        session()->flash('success', 'Record deleted successfully');

    }
    
}
