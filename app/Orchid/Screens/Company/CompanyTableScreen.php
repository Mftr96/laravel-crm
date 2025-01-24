<?php

namespace App\Orchid\Screens\Company;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Models\Company;
use Illuminate\Support\Facades\Request;

class CompanyTableScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'companies' => Company::all(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        return 'Aziende';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('Crea Azienda')
                ->route('platform.company.create')
                ->icon('plus')
                ->class('btn btn-success')
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::table('companies', [
                TD::make('id', 'ID'),
                TD::make('name', 'Nome'),
                TD::make('logo', 'Logo')
                    ->render(function (Company $company) {
                        if ($company->logo) {
                            $img = "<img src='" . ($company->logo) . "' alt='Immagine' width='100'>";
                            return $img;
                        }
                        return 'Logo dell\'azienda non presente';
                    }),
                TD::make('VAT_number', 'P.iva'),
                TD::make('Azioni')
                    ->alignRight()

                    ->render(function (Company $company) {
                        return Button::make('Cancella Azienda')
                            ->icon('trash')
                            ->confirm("Una volta eliminata, $company->name ed i dati relativi ai suoi impiegati saranno  eliminati definitivamente.")
                            ->method('delete', ['company' => $company->id])
                            .  Link::make('modifica')
                            ->route('platform.company.edit', $company->id)
                            ->icon('pencil');
                    }),
            ])

        ];
    }

    public function delete(Company $company)
    {
        $company->delete();
        Toast::info('Azienda eliminata con successo!');
    }
}
