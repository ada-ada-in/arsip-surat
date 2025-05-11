<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// admin
$routes->group('admin', static function($routes) {
    $routes->get('dashboard', 'PagesController::dashboard', ['as' => 'admin']);
    $routes->get('surat-masuk', 'PagesController::suratMasuk', ['as' => 'suratMasuk']);
    $routes->get('surat-keluar', 'PagesController::suratKeluar', ['as' => 'suratKeluar']);
    $routes->get('disposisi', 'PagesController::disposisi', ['as' => 'disposisi']);
    $routes->get('pengguna', 'PagesController::pengguna', ['as' => 'pengguna']);
    $routes->get('arsip', 'PagesController::arsip', ['as' => 'arsip']);
    $routes->get('profile', 'PagesController::profile', ['as' => 'profile']);

});


//  auth
$routes->group('auth', static function($routes){
    // Views
    $routes->get('login', 'PagesController::login', ['as' => 'login']);
    $routes->get('register', 'PagesController::register', ['as' => 'register']);
});

// users 
$routes->group('users', static function($routes){
    // routes api
    $routes->post('', 'User\UserController::register', ['as' => 'register']);
    $routes->post('login', 'Auth\LoginController::login',['as' => 'login']);
});

$routes->group('api/v1', static function($routes) {
    $routes->group('auth', static function($routes) {
        $routes->post('login', 'Api\V1\AuthController::login', ['as' => 'api.auth.login']);
        $routes->post('register', 'Api\V1\UserController::addUser', ['as' => 'api.auth.addUser']);
    });

    $routes->group('user', static function($routes) {
        $routes->get('', 'Api\V1\UserController::getUserData', ['as' => 'api.user.getUserData']);
        $routes->get('(:num)', 'Api\V1\UserController::getUserById/$1', ['as' => 'api.user.getUserById']);
        $routes->put('(:num)', 'Api\V1\UserController::updateUserById/$1', ['as' => 'api.user.updateUserById']);
    });


    $routes->group('jenis-laporan', static function($routes) {
        $routes->post('', 'api\v1\JenisLaporanController::addJenisLaporan', ['as' => 'api.user.addJenisLaporan']);
        $routes->get('', 'api\v1\JenisLaporanController::getDataJenisLaporan', ['as' => 'api.user.getDataJenisLaporan']);
        $routes->get('(:num)', 'api\v1\JenisLaporanController::getDataJenisLaporanById/$1', ['as' => 'api.user.getDataJenisLaporanById']);
        $routes->put('(:num)', 'api\v1\JenisLaporanController::updateJenisLaporanById/$1', ['as' => 'api.user.updateJenisLaporanById']);
        $routes->delete('(:num)', 'api\v1\JenisLaporanController::deleteJenisLaporan/$1', ['as' => 'api.user.deleteJenisLaporan']);
    });


    $routes->group('disposisi-kepada', static function($routes) {
        $routes->post('', 'api\v1\DisposisiKepadaController::addDisposisiKepada', ['as' => 'api.user.addDisposisiKepada']);
        $routes->get('', 'api\v1\DisposisiKepadaController::getDisposisiKepadaData', ['as' => 'api.user.getDisposisiKepadaData']);
        $routes->get('(:num)', 'api\v1\DisposisiKepadaController::getDisposisiKepadaById/$1', ['as' => 'api.user.getDisposisiKepadaById']);
        $routes->put('(:num)', 'api\v1\DisposisiKepadaController::updateDisposisiKepadaById/$1', ['as' => 'api.user.updateDisposisiKepadaById']);
        $routes->delete('(:num)', 'api\v1\DisposisiKepadaController::deleteDisposisiKepada/$1', ['as' => 'api.user.deleteDisposisiKepada']);
    });

    $routes->group('disposisi-petunjuk', static function($routes) {
        $routes->post('', 'api\v1\DisposisiPetunjukController::addDisposisiPetunjuk', ['as' => 'api.user.addDisposisiPetunjuk']);
        $routes->get('', 'api\v1\DisposisiPetunjukController::getDisposisiPetunjukData', ['as' => 'api.user.getDisposisiPetunjukData']);
        $routes->get('(:num)', 'api\v1\DisposisiPetunjukController::getDisposisiPetunjukById/$1', ['as' => 'api.user.getDisposisiPetunjukById']);
        $routes->put('(:num)', 'api\v1\DisposisiPetunjukController::updateDisposisiPetunjukById/$1', ['as' => 'api.user.updateDisposisiPetunjukById']);
        $routes->delete('(:num)', 'api\v1\DisposisiPetunjukController::deleteDisposisiPetunjuk/$1', ['as' => 'api.user.deleteDisposisiPetunjuk']);
    });

    $routes->group('sifat-laporan', static function($routes) {
        $routes->post('', 'api\v1\SifatLaporanController::addSifatLaporan', ['as' => 'api.user.addSifatLaporan']);
        $routes->get('', 'api\v1\SifatLaporanController::getSifatLaporanData', ['as' => 'api.user.getSifatLaporanData']);
        $routes->get('(:num)', 'api\v1\SifatLaporanController::getSifatLaporanById/$1', ['as' => 'api.user.getSifatLaporanById']);
        $routes->put('(:num)', 'api\v1\SifatLaporanController::updateSifatLaporanById/$1', ['as' => 'api.user.updateSifatLaporanById']);
        $routes->delete('(:num)', 'api\v1\SifatLaporanController::deleteSifatLaporan/$1', ['as' => 'api.user.deleteSifatLaporan']);
    });

    $routes->group('status-laporan', static function($routes) {
        $routes->post('', 'api\v1\StatusLaporanController::addStatusLaporan', ['as' => 'api.user.addStatusLaporan']);
        $routes->get('', 'api\v1\StatusLaporanController::getStatusLaporanData', ['as' => 'api.user.getStatusLaporanData']);
        $routes->get('(:num)', 'api\v1\StatusLaporanController::getStatusLaporanById/$1', ['as' => 'api.user.getStatusLaporanById']);
        $routes->put('(:num)', 'api\v1\StatusLaporanController::updateStatusLaporanById/$1', ['as' => 'api.user.updateStatusLaporanById']);
        $routes->delete('(:num)', 'api\v1\StatusLaporanController::deleteStatusLaporan/$1', ['as' => 'api.user.deleteStatusLaporan']);
    });

    $routes->group('surat-keluar', static function($routes) {
        $routes->post('', 'api\v1\SuratKeluarController::addSuratKeluar', ['as' => 'api.user.addSuratKeluar']);
        $routes->get('', 'api\v1\SuratKeluarController::getSuratKeluarData', ['as' => 'api.user.getSuratKeluarData']);
        $routes->get('(:num)', 'api\v1\SuratKeluarController::getSuratKeluarById/$1', ['as' => 'api.user.getSuratKeluarById']);
        $routes->put('(:num)', 'api\v1\SuratKeluarController::updateSuratKeluarById/$1', ['as' => 'api.user.updateSuratKeluarById']);
        $routes->delete('(:num)', 'api\v1\SuratKeluarController::deleteSuratKeluar/$1', ['as' => 'api.user.deleteSuratKeluar']);
    });

    $routes->group('surat-masuk', static function($routes) {
        $routes->post('', 'api\v1\SuratMasukController::addSuratMasuk', ['as' => 'api.user.addSuratMasuk']);
        $routes->get('', 'api\v1\SuratMasukController::getSuratMasukData', ['as' => 'api.user.getSuratMasukData']);
        $routes->get('(:num)', 'api\v1\SuratMasukController::getSuratMasukById/$1', ['as' => 'api.user.getSuratMasukById']);
        $routes->put('(:num)', 'api\v1\SuratMasukController::updateSuratMasukById/$1', ['as' => 'api.user.updateSuratMasukById']);
        $routes->delete('(:num)', 'api\v1\SuratMasukController::deleteSuratMasuk/$1', ['as' => 'api.user.deleteSuratMasuk']);
    });
    
});
 
