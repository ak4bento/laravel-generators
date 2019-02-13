# Project My Job

This is just my project only but if you want using my package, up to you.
Because this my package project only i'm using indonesian language in the README.

## Getting Started

Seperti pada umumnya untuk package laravel silahkan ikuti petunjuk di bawah ini.

### Prerequisites

Tentu anda harus mengistall laravel terlebih dahulu.

### Install the package via composer.

Download package dengan composer
```bash
composer require akill/generators dev-master
```
or
```
{
	"require": {
		"akill/generators" : "dev-master"
	}
}
```
### Register the service provider.

Tambahkan 
```
Akill\Generators\GeneratorsServiceProvider::class, 
```
di dalam `providers` yang ada pada `config/app.php`.

Contoh

```php
'providers' => [
	....	
	Akill\Generators\GeneratorsServiceProvider::class,
]
```

# Usage

## Basic

Buka terminal anda kemudian masuk di path lokasi project anda.

selanjutnya ketikkan di terminal anda
```
php artisan akill:generate NamaModuleAnda
```

`Hasilnya`

perintah tersebut membuat folder di dalam `app/Htpp/`.
File yang di buat berupa controller, resource, service, model, helper, dan repository
serta menambahkan baris perintah baru di akhir `routes/api.php`

untuk penamaan file yang anda buat akan mengikuti sesuai Nama Module Anda.

`Contoh`

````
Http
....Controller
........NamaModuleAndaController.php
....Helpers
........NamaModuleAndaHelper.php
....Models
........NamaModuleAnda.php
....Repositories
........NamaModuleAndaRepository.php
....Resource
........NamaModuleAndaResource.php
....Service
........NamaModuleAndaService.php
````

Selanjutnya setelah anda melakukan generate file tersebut, silahkan atur data yang anda inginkan pada bagian `NamaModuleAndaHelper.php`.

Saya sengaja untuk tidak menarik data field yang ada demi memudahkan anda dalam mengatur logika sendiri.

Tambahan

Untuk menambahkan relasi table silahkan gunakan perintah berikut ini 
```
php artisan akill:relation relasi field module
```

`Contoh`

```
php artisan akill:relation Product product_id Result
```

`Product` => Nama Module yang akan direlasikan
`product_id` => Field yang digunakan di Module yang akan direlasikan
`Result` => Nama Module yang akan ditambahkan relasi

`Note`
Penggunaan relasi ini tidak menggunakan Eloquent.


## Package Description

Dalam package ini saya tidak memasukkan beberapa class yang telah di gunakan pada pada class yang telah di generate.

Untuk generator secara umum saya akan buatkan nanti setalah kerjaan ku selesai yah. :)

Semoga ini membantu anda dalam membuat API dan membantu bagi anda yang ingin membuat generator sendiri.

## Promotion
Silahkan kunjungi dan subscribe web saya yah.

## Authors

***Muhammad Akil** - *Initial work* - [Akill](http://akil.co.id/)

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details

## Acknowledgments

* Hat tip to anyone whose code was used
* Inspiration
* etc
