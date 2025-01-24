<?php

namespace App\Orchid\Screens\Company;
use Illuminate\Support\Facades\Storage;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Fields\TextArea;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\RedirectResponse;
use App\Models\Company;


use Orchid\Screen\Screen;

class CompanyFormScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [
            'company' => Company::find(request()->route('company')),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {
        if (request()->routeIs('platform.company.edit')) {
            return 'Modifica azienda';
        }
        return 'Aggiungi una nuova azienda';
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): iterable
    {
        return [
            Layout::rows([
                Input::make('company.name')
                    ->title('Nome')
                    ->placeholder(isset($company->id) ? 'ciao' : 'Inserisci il nome dell\'azienda')
                    ->required(),

                Input::make('company.VAT_number')
                    ->title('Partita IVA')
                    ->placeholder('Inserisci la partita IVA')
                    ->required(),

                Picture::make('company.logo')
                    ->placeholder('Carica il logo dal tuo PC')
                    ->title('Logo'),

                button::make('Salva')
                    ->method('saveCompany')
                    ->class('btn btn-primary'),
            ])->title('Form Azienda'),


        ];
    }
    public function saveCompany(): RedirectResponse
    {

        $data = request()->get('company');
        if (request()->routeIs('platform.company.edit')) {
            $company = Company::find(request()->route('company'));
            if (request()->hasFile('company.logo')) {
                // Rimuovi il vecchio logo se esiste
                if ($company->logo) {
                    Storage::delete($company->logo);
                }
                $data['logo'] = request()->file('company.logo')->store('company_logos');
            }
            $company->update($data);
            Toast::info('Azienda modificata con successo!');
            return redirect()->route('platform.company.table');
        }
        //salvare logo in storage
        if (request()->file('company.logo')) {
            $data['logo'] = request()->file('company.logo')->store('company_logos');
        }
        Company::create($data);
        Toast::info('Azienda salvata  con successo!');
        return redirect()->route('platform.company.table');
    }
}
