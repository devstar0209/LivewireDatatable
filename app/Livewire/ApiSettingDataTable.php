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

use App\Models\ApiSetting;

class ApiSettingDataTable extends DataTableComponent
{
    protected $model = ApiSetting::class;

    public $selectedUrl;
    public $editing = [];

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setPerPageAccepted([10, 20, 30, 50, 100]);

        $this->setPerPage(100);

        $this->setDefaultSort('created_at', 'desc');

    }


    public function updateUrl($id)
    {
        $apiSetting = ApiSetting::find($id);
        $apiSetting->url = $this->selectedUrl;
        $apiSetting->save();

        $this->editing[$id] = false;

        session()->flash('success', 'URL updated successfully');
    }

    public function startEditing($rowId)
    {
        $this->editing[$rowId] = true;
    }

    public function cancelEditing($rowId)
    {
        $this->editing[$rowId] = false;
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
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("API URL", "url")
            ->sortable()
            ->searchable()
            ->hideIf(true),
            Column::make("API URL")
                ->label(
                    fn($row, Column $column) => view('components.inline-url-edit')->with(['row' => $row, 'editing' => $this->editing[$row->id] ?? false])
                ),
            Column::make("Country", "country")
                ->sortable()
                ->searchable(),
            Column::make("Country Code", "country_code")
                ->sortable()
                ->searchable(),


        ];
    }

    public function deleteSingleRecord($id){
        ApiSetting::findOrFail($id)->delete();
        session()->flash('success', 'Record deleted successfully');

    }

}
