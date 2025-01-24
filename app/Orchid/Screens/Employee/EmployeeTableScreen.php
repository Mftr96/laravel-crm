<?php

namespace App\Orchid\Screens\Employee;

use Orchid\Screen\Screen;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Facades\Request;
class EmployeeTableScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {   
        $companyId= request()->route('company');
        $company= Company::find($companyId);
        $employees= Employee::where('company_id', $companyId)->get();
        return [
            'employees'=>$employees,
            'company'=>$company,
            'nome'=>$company->name,
        ];
    }

    /**
     * The name of the screen displayed in the header.
     *
     * @return string|null
     */
    public function name(): ?string
    {   
        //dd($this->query()['nome']);
        return "Ecco gli impiegati che lavorano in {$this->query()['nome']}  "; 
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
            Layout::table('employees',[
                TD::make('id', 'ID'),
                TD::make('first_name', 'Name'),
                TD::make('last_name', 'Surname'),
                TD::make('email', 'Email'),
                TD::make('phone', 'Phone'),
                TD::make('company_id', 'Company ID'),
            ])

        
        ];
            
    }
}
