# Laravel: CRM
Questa repo prevede la realizzazione di un CRM(customer relationship manager).
In questo caso avremo un unico utente Admin che potrà Visualizzare,creare, aggiornare o eliminare delle Aziende e/o i relativi dipendenti.
Questo esercizio fa parte della serie di esercizi proposti da Boolean durante il post corso.

## Indice

1. [consegna](#consegna)
2. [considerazioni_pre-progetto](#considerazioni-pre-progetto)
3. [milestone](#milestone)
4. [esecuzione](#esecuzione)
5. [prossimamente-sul-piccolo-schermo](#to-do)

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

## Esecuzione milestone

sebbene nella consegna sia indicato prima la creazione dell'impalcatura, parto prima con la stesura di un grafico Entità Relazione.
Vado a utilizzare [DrawSql](https://drawsql.app/login?redirectUrl=https%3A%2F%2Fdrawsql.app%2Fdiagrams)per andare a strutturare le entità con le loro relazioni.
Qui di seguito è riportata la struttura del database :![immagine](/drawSQL-image-export-2025-01-22.png)

Dopo aver fatto questo passaggio inizio con l'esecuzione delle milestone:

- milestone 1 : inizializzazione progetto 

creo l'impalcatura del progetto lanciando il seguente comando :
```bash
composer create-project laravel/laravel:^11.0 .
```

configuro il database usando mysql cambiando nel file ![env](/.env) i dati del database,
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
            'collation' => env('DB_COLLATION', 'utf8mb4_general_ci'), #campo modificato 
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

```