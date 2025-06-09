<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// user
$routes->group('user', static function($routes) {
    $routes->get('dashboard', 'PagesController::userDashboard', ['as' => 'userDashboard']);
    $routes->get('surat-masuk', 'PagesController::userSuratMasuk', ['as' => 'userSuratMasuk']);
    $routes->get('surat-keluar', 'PagesController::userSuratKeluar', ['as' => 'userSuratKeluar']);
    $routes->get('arsip', 'PagesController::userArsip', ['as' => 'userArsip']);
    $routes->get('disposisi/print', 'PagesController::userPrint', ['as' => 'userPrint']); 
    $routes->get('profile', 'PagesController::userProfile', ['as' => 'userProfile']); 
});     


// admin
$routes->group('admin', ['filter' => 'auth'], static function($routes) {
    $routes->get('dashboard', 'PagesController::dashboard', ['as' => 'admin']);
    $routes->get('surat-masuk', 'PagesController::suratMasuk', ['as' => 'suratMasuk']);
    $routes->get('surat-keluar', 'PagesController::suratKeluar', ['as' => 'suratKeluar']);
    $routes->get('disposisi', 'PagesController::disposisi', ['as' => 'disposisi']);
    $routes->get('pengguna', 'PagesController::pengguna', ['as' => 'pengguna']);
    $routes->get('arsip', 'PagesController::arsip', ['as' => 'arsip']);
    $routes->get('profile', 'PagesController::profile', ['as' => 'profile']); 
    $routes->get('disposisikepada', 'PagesController::disposisikepada', ['as' => 'disposisikepada']); 
    $routes->get('disposisipetunjuk', 'PagesController::disposisipetunjuk', ['as' => 'disposisipetunjuk']); 
    $routes->get('jenissurat', 'PagesController::jenissurat', ['as' => 'jenissurat']); 
    $routes->get('sifatsurat', 'PagesController::sifatsurat', ['as' => 'sifatsurat']); 
    $routes->get('disposisi/isidisposisi', 'PagesController::isidisposisi', ['as' => 'isidisposisi']); 
    $routes->get('disposisi/print', 'PagesController::print', ['as' => 'print']); 
    $routes->get('statussurat', 'PagesController::statussurat', ['as' => 'statussurat']); 
    $routes->get('backup', 'PagesController::backup', ['as' => 'backup']); 
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
        $routes->post('logout', 'Api\V1\AuthController::logout', ['as' => 'logout']);
        $routes->post('register', 'Api\V1\UserController::addUser', ['as' => 'api.auth.addUser']);
    });

    $routes->group('user', static function($routes) {
        $routes->get('', 'Api\V1\UserController::getUserData', ['as' => 'api.user.getUserData']);
        $routes->get('count', 'Api\V1\UserController::countUser', ['as' => 'api.user.countUser']);
        $routes->get('(:num)', 'Api\V1\UserController::getUserById/$1', ['as' => 'api.user.getUserById']);
        $routes->put('(:num)', 'Api\V1\UserController::updateUserById/$1', ['as' => 'api.user.updateUserById']);
        $routes->delete('(:num)', 'Api\V1\UserController::deleteUser/$1', ['as' => 'api.user.deleteUser']);
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

    $routes->group('surat', static function($routes) {
        $routes->post('', 'api\v1\SuratController::addSurat', ['as' => 'api.user.addSurat']);
        $routes->get('', 'api\v1\SuratController::getSuratData', ['as' => 'api.user.getSuratData']);
        $routes->get('all', 'api\v1\SuratController::getAllSuratArsipData', ['as' => 'api.user.getAllSuratArsipData']);
        $routes->get('notification', 'api\v1\SuratController::getSuratNotificationData', ['as' => 'api.user.getSuratNotificationData ']);
        $routes->get('count', 'api\v1\SuratController::countSuratData', ['as' => 'api.user.countSuratData ']);
        $routes->get('count/users', 'api\v1\SuratController::countUserSuratData', ['as' => 'api.user.countUserSuratData ']);
        $routes->get('countin', 'api\v1\SuratController::countSuratMasukArsipData', ['as' => 'api.user.countSuratMasukArsipData ']);
        $routes->get('countin/users', 'api\v1\SuratController::countUserSuratMasukArsipData', ['as' => 'api.user.countUserSuratMasukArsipData ']);
        $routes->get('countout', 'api\v1\SuratController::countSuratKeluarArsipData', ['as' => 'api.user.countSuratKeluarArsipData ']);
        $routes->get('countout/users', 'api\v1\SuratController::countUserSuratKeluarArsipData', ['as' => 'api.user.countUserSuratKeluarArsipData ']);
        $routes->get('arsip', 'api\v1\SuratController::getSuratArsipData', ['as' => 'api.user.getSuratArsipData']);
        $routes->get('arsip/user/(:num)', 'api\v1\SuratController::getSuratArsipUserData/$1', ['as' => 'api.user.getSuratArsipUserData']);
        $routes->get('masuk', 'api\v1\SuratController::getSuratMasukData', ['as' => 'api.user.getSuratMasukData']);
        $routes->get('keluar', 'api\v1\SuratController::getSuratKeluarData', ['as' => 'api.user.getSu   ratKeluarData']);
        $routes->get('masuk/user/(:num)', 'api\v1\SuratController::getSuratMasukByUserData/$1', ['as' => 'api.user.getSuratMasukByUserData']);
        $routes->get('keluar/user/(:num)', 'api\v1\SuratController::getSuratKeluarByUserData/$1', ['as' => 'api.user.getSuratKeluarByUserData']);
        $routes->get('(:num)', 'api\v1\SuratController::getSuratById/$1', ['as' => 'api.user.getSuratById']);
        $routes->post('(:num)', 'api\v1\SuratController::updateSuratById/$1', ['as' => 'api.user.updateSuratById']);
        $routes->delete('(:num)', 'api\v1\SuratController::deleteSurat/$1', ['as' => 'api.user.deleteSurat']);
    });


        $routes->group('backup', static function($routes) {
        $routes->post('', 'api\v1\BackUpController::bakcup', ['as' => 'api.user.bakcup']);
        $routes->get('', 'api\v1\BackUpController::listBackups', ['as' => 'api.user.listBackups']);
        $routes->get('download/(:any)', 'api\v1\BackUpController::download/$1', ['as' => 'api.user.download']);
    });


});
 
