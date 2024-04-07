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

use App\Models\UserData;

class UserDataTable extends DataTableComponent
{
    protected $model = UserData::class;

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
            Column::make("Status", "status")
                ->sortable()
                ->searchable()
                ,
            Column::make("Code", "code")
                ->sortable()
                ->searchable(),
            Column::make("First Name", "first_name")
                ->sortable()
                ->searchable(),
            Column::make("Last Name", "last_name")
                ->sortable()
                ->searchable(),
            Column::make("Email", "email")
                ->sortable()
                ->searchable(),
            Column::make("PRE", "phonecc")
                ->sortable()
                ->searchable(),
            Column::make("Phone", "phone")
                ->sortable()
                ->searchable(),
            Column::make("User IP", "user_ip")
                ->sortable()
                ->searchable(),
            Column::make("User Agent", "user_agent")
                ->sortable()
                ->searchable(),
            Column::make("Country", "country")
                ->sortable()
                ->searchable(),
            Column::make("log", "log")
                ->sortable()
                ->searchable(),
            Column::make("aff_sub", "aff_sub")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make("aff_sub2", "aff_sub2")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make("aff_sub3", "aff_sub3")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make("aff_sub4", "aff_sub4")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make("aff_id", "aff_id")
                ->sortable()
                ->searchable()
                ->deselected(),
            Column::make("offer_id", "offer_id")
                ->sortable()
                ->searchable()
                ->deselected(),


            Column::make("orig_offer", "orig_offer")
                ->sortable()
                ->searchable()
                ->deselected(),

            /*Column::make("Updated at", "updated_at")
                ->sortable(),*/

            /*Column::make("Action", "updated_at")
                ->sortable(),*/

            /*LinkColumn::make('Action')
                ->title(fn($row) => 'Delete')
                ->location(fn($row) => route('admin.users_data.delete', ['id' => $row]))
                ->attributes(function($row) {
                    return [
                        'target' => '_blank',
                        'class' => 'underline text-red-500 hover:no-underline',
                    ];
                }),*/

                /*ButtonGroupColumn::make('Actions')
    ->attributes(function($row) {
        return [
            'class' => 'space-x-2',
        ];
    })
    ->buttons([
        LinkColumn::make('View') // make() has no effect in this case but needs to be set anyway
            ->title(fn($row) => 'View ' . $row->name)
            ->location(fn($row) => route('admin.users_data.delete', ['id' => $row]))
            ->attributes(function($row) {
                return [
                    'class' => 'underline text-blue-500 hover:no-underline',
                ];
            }),
        LinkColumn::make('Delete')
            ->title(fn($row) => 'Delete ' . $row->name)
            ->location(fn($row) => route('admin.users_data.delete', ['id' => $row]))
            ->attributes(function($row) {
                return [
                    'target' => '_blank',
                    'class' => 'underline text-red-500 hover:no-underline',
                ];
            }),
    ]),*/



        ];
    }

    public function filters(): array
{

   /* return [
        SelectFilter::make('Filter by Month')
            ->options([
                '01' => 'January',
                '02' => 'February',
                '03' => 'March',
                '04' => 'April',
                '05' => 'May',
                '06' => 'June',
                '07' => 'July',
                '08' => 'August',
                '09' => 'September',
                '10' => 'October',
                '11' => 'November',
                '12' => 'December',
            ]),
        SelectFilter::make('Filter by Year')
            ->options([
                    2024 => 2024,
                    2023 => 2023,

            ]),
    ];*/

    /*return [
        SelectFilter::make('Filter by')
            ->options([
                '' => 'All',
                'daily' => 'Daily',
                'weekly' => 'Weekly',
                'monthly' => 'Monthly',
                //'yearly' => 'Yearly',
                'yearly' => [
                    2024 => 2024,
                    2023 => 2023,
                ],
            ]),
    ];*/

    /*return [
        DateFilter::make('Verified From'),
    ];*/

    return [
        DateRangeFilter::make('Date Range')
        ->config([
            'allowInput' => true,   // Allow manual input of dates
            'altFormat' => 'F j, Y', // Date format that will be displayed once selected
            'ariaDateFormat' => 'F j, Y', // An aria-friendly date format
            'dateFormat' => 'Y-m-d', // Date format that will be received by the filter
            //'earliestDate' => '2020-01-01', // The earliest acceptable date
            //'latestDate' => '2023-08-01', // The latest acceptable date
            'placeholder' => 'Enter Date Range', // A placeholder value
        ])
        ->setFilterPillValues([0 => 'minDate', 1 => 'maxDate']) // The values that will be displayed for the Min/Max Date Values
        ->filter(function (Builder $builder, array $dateRange) { // Expects an array.
            $builder
                ->whereDate('created_at', '>=', $dateRange['minDate']) // minDate is the start date selected
                ->whereDate('created_at', '<=', $dateRange['maxDate']); // maxDate is the end date selected
        }),
    ];
}


    public function deleteSingleRecord($id){
        UserData::findOrFail($id)->delete();
        session()->flash('success', 'Record deleted successfully');
        //dd($id);
    }

}
