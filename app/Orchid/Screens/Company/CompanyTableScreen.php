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
                        //$url = asset($company->logo);
                        //dd($url); // Questo mostrerà l'URL nel browser
                        $img="<img src='" .($company->logo) . "' alt='Immagine' width='100'>";
                        //dd(config('app.url'));
                        //dd(asset('storage/2025/01/23/b76cae70267fd58987bec7730ff26b650b32fd38.jpg'));
                        //dd($img);   

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
                            ->confirm('Una volta eliminata, l\'azienda sarà eliminata definitivamente.')
                            ->method('delete', ['company' => $company->id]);
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
