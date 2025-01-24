# Laravel: CRM
Questa repo prevede la realizzazione di un CRM(customer relationship manager).
In questo caso avremo un unico utente Admin che potrà Visualizzare,creare, aggiornare o eliminare delle Aziende e/o i relativi dipendenti.
Questo esercizio fa parte della serie di esercizi proposti da Boolean durante il post corso.

## Indice

1. [consegna](#consegna)
2. [considerazioni_pre-progetto](#considerazioni-pre-progetto)
3. [strumenti-aggiuntivi](#strumenti-aggiuntivi )
3. [esecuzione](#esecuzione-milestone)
5. [prossimamente-sul-piccolo-schermo](#roadmap)

## Consegna

 Argomenti da ripassare

- Modellazione DB
- Migrations e Seeders
- Models e Controllers
- Routing web
- Autenticazione
- File storage e upload immagine

<aside>
📚 esercizio di oggi: **Laravel CRM**
nome repo: **laravel-crm

🎯 Obiettivi**
Un **CRM** (Customer Relationship Management) è uno strumento aziendale per la gestione dei rapporti con i clienti potenziali ed esistenti.

L’obiettivo di questo esercizio è costruire un mini CRM utilizzando **Laravel** per gestire aziende e i rispettivi dipendenti.

**Admin**
Sarà presente un unico utente amministratore che potrà eseguire login alla dashboard tramite le proprie credenziali. Non è prevista registrazione. L’admin potrà visualizzare, creare, modificare o eliminare le schede di aziende e impiegati direttamente dal pannello di amministrazione.

**1️⃣ Milestone 1**
Realizza un nuovo progetto Laravel. Completa lo scaffolding e la procedura di inizializzazione di un nuovo progetto.

**2️⃣ Milestone 2**
Realizza le migration per le risorse. Non dimenticare: un dipendente sarà necessariamente associato ad una azienda.

****I campi minimi dell’entità **Azienda** sono:

- Nome
- Logo
- Partita IVA

I campi minimi dell’entità **Impiegato** sono:

- Nome
- Cognome
- Azienda di appartenenza
- Telefono
- Email

**3️⃣ Milestone 3**
Realizza i modelli e poi i seeder per le risorse. 
**I dati** potranno essere generati con **Faker**. 

**3️⃣ Milestone 4**

Sviluppa l’interfaccia della dashboard. Puoi utilizzare un framework css come Bootstrap per velocizzare lo sviluppo.

🚀 **Bonus 1: Validazione dei dati**

Aggiungi la validazione dei dati nei **form di creazione e modifica** per aziende e dipendenti:

- Nome e Cognome devono contenere solo caratteri alfabetici
- La Partita IVA deve essere lunga 11 caratteri e composta solo da numeri
- L’indirizzo email deve essere valido
- Il file per il logo deve essere un’immagine (ad esempio, `.png`, `.jpg`)

📊 **Bonus 2: Statistiche Dashboard**

Aggiungi una sezione con **statistiche** generali:

- Numero totale di aziende
- Numero totale di dipendenti
- Azienda con più dipendenti

</aside>

### Consigli generici

Facciamo attenzione a realizzare correttamente il database: essendo il punto di partenza della nostra applicazione, assicurandoci di aver inserito tutte le caratteristiche richiesta dalla consegna.

## considerazioni pre-progetto
l'esercizio prevede la relizzazione di un crm in Laravel.
Per prima cosa ragiono sulle entità che ci sono in questo progetto. In questo caso abbiamo :
<ul>
  <li style="color: green;">Utente </li>
  <li style="color: green;">Azienda</li>
  <li style="color: green;">Impiegato</li>
</ul>

<span style="color: green;">L'Utente</span> avrà la possibilità di <span style="color: red;">creare, aggiornare, eliminare e vedere</span> le <span style="color: green;">Aziende</span> ed i relativi <span style="color: green;">Impiegati</span>.

Per quanto riguarda le relazioni, considero una relazione one to many tra Azienda e Impiegato, poichè un'azienda può avere più Impiegati ma un Impiegato sarà legato ad una sola Azienda.

Per quanto riguarda la versione, proverò Laravel 11 come prova, come stimolo di miglioramento ed anche per vedere le differenze tra Laravel 11 e 10.

Durante la lezione del coding training è stato suggerito l'utilizzo di Builder come [Orchid](https://orchid.software/) e di [Filament](https://filamentphp.com/) come strumenti per accelerare la creazione della parte grafica del progetto. 
Al momento tengo in considerazione l'idea di usare Orchid anche se ho  bisogno di un investimento di tempo per capirne l'utilizzo.
Valuto anche la possibilità di usare [Heidisql](https://www.heidisql.com/download.php)

## strumenti aggiuntivi

## Esecuzione milestone

sebbene nella consegna sia indicato prima la creazione dell'impalcatura, parto prima con la stesura di un grafico Entità Relazione.
Vado a utilizzare [DrawSql](https://drawsql.app/login?redirectUrl=https%3A%2F%2Fdrawsql.app%2Fdiagrams)per andare a strutturare le entità con le loro relazioni.
Qui di seguito è riportata la struttura del database :![immagine](/drawSQL-image-export-2025-01-24.png)

Dopo aver fatto questo passaggio inizio con l'esecuzione delle milestone:

- milestone 1 : inizializzazione progetto 

creo l'impalcatura del progetto lanciando il seguente comando :
```bash
composer create-project laravel/laravel:^11.0 .
```

configuro il database usando mysql cambiando nel file env i dati del database,
da così:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=
```

a così:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel_crm 
DB_USERNAME=root
DB_PASSWORD=
```

cambio nel file config di [database](/config/database.php)per sincronizzarli con il database(non facendo qeusto passaggio, nel fare le migration incontrerei l'errore 1273, questo perchè Laravel 11 di base ha la collation del database configurata in modo diverso dal predefinito di php my admin):
```php
'mysql' => [
            'driver' => 'mysql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'laravel'),
            'username' => env('DB_USERNAME', 'root'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => env('DB_CHARSET', 'utf8mb4'),
            'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'), #campo modificato per renderlo uguale su phpmyadmin 
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

```
configurato il database, vado a lanciare i seguenti comandi per installare Orchid:
```bash
- composer require orchid/platform

- php artisan orchid:install
```
con il seguente comando vado a configuare un utente di tipo Admin tramite Orchid:
```bash
php artisan orchid:admin 
```
nell'eseguire il comando precedente, Orchid chiederà di impostare la mail, nome utente e password.(per i più pigri nel caso c'è questo comando : php artisan orchid:admin admin admin@admin.com password che salta il passaggio di inserire i dati)


fatti questi passaggi, possiamo lanciare il comando :

```bash
php artisan serve
```

e scrivendo la rotta localhost/admin ( che di default solitamente è 127.0.0.1:8000, ma potrebbe variare se avete fatto modifiche)si potrà aprire la pagina di login 

- milestone 2: creazione Model e migration 

partiamo lanciando i seguenti comandi per la creazione dei Model con migration e [seeder](/database/seeders/) :

```bash
php artisan make:model Company -m
php artisan make:model Employer -m
```

vado poi a compilare i [Model](/app/Models/) inserendo i campi riempibili e le relazioni e compilo [migrazioni](/database/migrations/) e [seeder](/database/seeders/).

- milestone 3 : creazione seeders

vado a lanciare i seguenti comandi per creare i seeder :
```bash
php artisan make:seeder CompanySeeder
php artisan make:seeder EmployerSeeder
```
aggiungo i seeder nel [DatabaseSeeder](/database/seeders/DatabaseSeeder.php) e vado a compilare i seeder per la creazione di aziende ed impiegati.

- milestone 4: creazione interfaccia grafica 
nella milestone 1 sono andato ad installare Orchid, andando così ad avere una interfaccia già pronta per il progetto. Ora vado a togliere i segnaposto nell'interfaccia dal file [PlatformProvider](/app/Orchid/PlatformProvider.php) per andare ad aggiungere le pagine delle mie Entità(Company e Employee).

Per Predisporre i modelli per poterli poi utilizzare tramite gli screen bisogna effettuare i seguenti passaggi:
1. andare nel Model e inserire AsSource all'interno della classe:
```php
	namespace App\Models;

	use Illuminate\Database\Eloquent\Model;
	use Orchid\Screen\AsSource;# se non mette lo use, non si può usare nel Model 

	class Company extends Model
	{
		use AsSource;	#

  //ecc...
	
	}
```

2. creare gli screen (in questo caso creo gli screen della tabella e del form attraverso il comando) :
```bash
php artisan orchid:screen Company/CompanyTableScreen 
php artisan orchid:screen Company/CompanyFormScreen 
#notare la struttura del comando: dopo orchid screen viene creato il percorso degli Screen relativo al Model Company
```
3. inserire le rotte degli Screen nel file [platform](/routes/platform.php):

```php
#importa gli screen da usare nella rotta!
use App\Orchid\Screens\Contact\ContactTableScreen;
use App\Orchid\Screens\Contact\ContactFormScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;

 
  Route::screen('profile', UserProfileScreen::class)->name('platform.profile');
	Route::screen('/companies', CompanyTableScreen::class)->name('platform.company.table');
	Route::screen('/companies/create', CompanyFormScreen::class)->name('platform.company.create');
	Route::screen('/companies/{company}/edit', CompanyFormScreen::class)->name('platform.company.edit');

  //da notare che basta specificare la rotta di tipo screen a differenza di quando si devono inserire le rotte in web.php che bisogna specificare ogni volta la tipologia di rotta da eseguire 
  ```

  con questo esempio, ho così creato le rotte della table, con funzione similare ad una index view e del form, che posso utlizzare sia per la funzione create ed update.
  Per Vedere come usare lo stesso Screen per fare sia la funzione create che update vi rimando al file [CompanyFormScreen](/app/Orchid/Screens/Company/CompanyFormScreen.php)
  Ricordatevi sempre di utilizzare Storage::put per l'inserimento di immagini in fase di create o di update per evitare problemi quando bisogna prendere foto dal database!
  
  

## Roadmap