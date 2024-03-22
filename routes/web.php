<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);
Route::get('/', 'HomeController@index')->name('home');
Route::get('/woowa', 'WhatsAppController@index')->name('woowa.index');
// Route::get('/info', 'HomeController@info')->name('phpinfo');
Route::get('/linktree/agenda/{id}', 'LinkTreeController@agenda')->name('linktree.agenda');
Route::get('/linktree/penomoran/{id}', 'LinkTreeController@penomoran')->name('linktree.penomoran');
Route::get('/tamu', 'VisitorController@create')->name('visitor.create');
Route::post('/tamu', 'VisitorController@store')->name('visitor.store');
Route::get('/cek-surat', 'VisitorController@check')->name('visitor.check');
Route::get('/phpinfo', function() {
    return phpinfo();
});
// admin group route
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('admin.index');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::get('users/profile', 'UsersController@profile')->name('users.profile');
    Route::resource('users', 'UsersController');

    Route::get('settings/aplikasi', 'SettingController@index')->name('settings.aplikasi');
    Route::put('settings/aplikasi', 'SettingController@update')->name('settings.aplikasi.update');
    Route::get('settings/banner', 'SettingController@banner')->name('settings.banner');
    Route::put('settings/banner/{id}', 'SettingController@bannerUpdate')->name('settings.banner.update');

    Route::get('reset-password/{id}', 'UsersController@resetPassword')->name('users.reset_password');
    Route::get('reset-password-disposisi/{id}', 'UsersController@resetPasswordDisposisi')->name('users.reset_password_disposisi');
});

// auth route
Route::group(['middleware' => 'auth'], function () {
    Route::resource('user', 'UserController', ['except' => ['show']]);
    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
    Route::put('profile/password-disposisi', ['as' => 'profile.password_disposition', 'uses' => 'ProfileController@passwordDisposition']);

    Route::get('/dashboard', 'HomeController@dashboard')->name('dashboard');

    // ------------------------------------------
    // E-SETDA GROUP
    // ------------------------------------------
    Route::resource('surat-masuk', 'InboxController');
    Route::resource('surat-keluar', 'OutboxController');
    Route::resource('tujuan', 'ReceiverController');
    Route::resource('kategori', 'CategoryController');
    Route::resource('pejabat', 'PejabatController');

    Route::get('pencarian-surat', ['as' => 'search.index', 'uses' => 'SearchController@index']);
    Route::get('pencarian-surat/hasil', ['as' => 'search.result', 'uses' => 'SearchController@result']);
    Route::get('laporan', ['as' => 'report.index', 'uses' => 'PrintController@index']);
    Route::post('laporan/cetak', ['as' => 'print.report', 'uses' => 'PrintController@report']);
    Route::post('disposisi', ['as' => 'print.disposisi', 'uses' => 'PrintController@disposisi']);
    Route::get('surat-agenda/{id}', ['as' => 'surat-masuk.agenda', 'uses' => 'InboxController@agenda']);
    Route::post('surat-arsip', ['as' => 'surat-arsip', 'uses' => 'InboxController@arsip']);
    Route::get('kop', ['as' => 'kop.index', 'uses' => 'KopController@index']);
    Route::get('kop/edit/{id}', ['as' => 'kop.edit', 'uses' => 'KopController@edit']);
    Route::put('kop/{id}', ['as' => 'kop.update', 'uses' => 'KopController@update']);
    Route::get('petugas', 'PetugasTtdController@biro');
    Route::put('petugas/{slug}', 'PetugasTtdController@biroUpdate');
    Route::get('pejabat-status', 'PejabatController@status');
    Route::post('pejabat-disposisi', 'PejabatController@statusDisposisi');
    Route::get('surat-lampiran', 'InboxController@allAttachments');
    Route::get('tanda-terima', 'InboxReceiptController@index')->name('inbox.receipt.index');
    Route::put('tanda-terima', 'InboxReceiptController@update')->name('inbox.receipt.update');
    Route::get('tanda-terima/upload/{type}/{id}', 'ReceiptController@show')->name('receiptable.show');
    Route::post('tanda-terima/upload', 'ReceiptController@store')->name('receiptable.store');
    // disposisi admin
    Route::get('disposisi-admin/set-key', 'DispositionAdminController@setUniqueKey')->name('disposition_admin.set_key');
    Route::get('disposisi-admin/print/{id}', 'PrintController@disposisiAdmin')->name('disposition_admin.print');
    Route::put('disposisi-admin/signature/{id}', 'DispositionAdminController@signature')->name('disposition_admin.signature');
    Route::get('disposisi-admin/{id}', 'DispositionAdminController@edit')->name('disposition_admin.edit');
    Route::put('disposisi-admin/{id}', 'DispositionAdminController@update')->name('disposition_admin.update');
    Route::get('lihat-disposisi/{id}', 'DispositionAdminController@allDisposition')->name('disposition_admin.all_disposition');
    Route::get('surat-diteruskan', 'InboxController@superForward')->name('disposition_admin.forward');
    // visitor
    Route::get('/surat-tamu', 'VisitorController@index')->name('visitor.index');
    Route::post('/surat-tamu/teruskan', 'VisitorController@forward')->name('visitor.forward');
    Route::post('/surat-tamu/tolak', 'VisitorController@invalid')->name('visitor.invalid');
    Route::put('/surat-tamu/{id}', 'VisitorController@update')->name('visitor.update');
    Route::delete('/surat-tamu/{id}', 'VisitorController@destroy')->name('visitor.destroy');

    // FORWARD
    Route::group(['prefix' => 'surat-terusan', 'as' => 'surat_terusan.'], function () {
        Route::resource('/', 'ForwardController');
        Route::get('check/{type}/{id}', ['as' => 'check', 'uses' => 'ForwardController@check']);
        Route::get('terima/{id}', ['as' => 'accept', 'uses' => 'ForwardController@accept']);
        Route::get('lampiran/{id}', ['as' => 'attachment', 'uses' => 'ForwardController@attachment']);
        Route::get('lampiran/check/{id}', ['as' => 'attachment_check', 'uses' => 'ForwardController@attachmentCheck']);
        Route::put('lampiran/check/{id}', ['as' => 'attachment_update', 'uses' => 'ForwardController@attachmentUpdate']);
        Route::put('keterangan/{id}', ['as' => 'keterangan_update', 'uses' => 'ForwardController@noteUpdate']);
        Route::delete('batal/{id}', ['as' => 'cancel', 'uses' => 'ForwardController@destroy']);
        Route::post('duplikasi', ['as' => 'duplicate', 'uses' => 'ForwardController@duplicate']);
    });

    // ------------------------------------------
    // E-AGENDA GROUP
    // ------------------------------------------
    Route::group(['prefix' => 'agenda', 'as' => 'agenda.'], function () {
        Route::resource('jadwal', 'AgendaController');
        Route::get('jadwal-gub', 'AgendaController@filterGubernur')->name('agenda.gubernur');
        Route::get('jadwal-wagub', 'AgendaController@filterWakilGubernur')->name('agenda.wakil_gubernur');
        Route::get('jadwal-sekda', 'AgendaController@filterSekda')->name('agenda.sekda');
        Route::get('jadwal-asis1', 'AgendaController@filterAsistenSatu')->name('agenda.asisten_1');
        Route::get('jadwal-asis2', 'AgendaController@filterAsistenDua')->name('agenda.asisten_2');
        Route::get('jadwal-asis3', 'AgendaController@filterAsistenTiga')->name('agenda.asisten_3');
        Route::get('pencarian', 'AgendaController@search')->name('search');
        Route::post('pencarian', 'AgendaController@result')->name('search.store');
        Route::get('laporan', 'AgendaReportController@index')->name('report.index');
        Route::post('laporan', 'AgendaReportController@report')->name('report.print');
        Route::get('petugas', 'PetugasTtdController@agenda');
        Route::put('petugas', 'PetugasTtdController@agendaUpdate');

        Route::resource('disposisi', 'AgendaDispositionController');
        Route::resource('pendamping', 'AgendaPartnerController');
        Route::resource('tempat', 'AgendaPlaceController');
        Route::resource('pakaian', 'AgendaApparelController');
        Route::resource('tujuan', 'AgendaReceiverController');
    });

    // ------------------------------------------
    // E-ARSIP GROUP
    // ------------------------------------------
    Route::group(['prefix' => 'arsip', 'as' => 'arsip.'], function () {
        Route::get('/pencarian', 'ArchiveController@search')->name('search');
        Route::post('/pencarian', 'ArchiveController@result')->name('search.store');
        Route::put('/validasi', 'ArchiveController@updateValidation')->name('arsip.validation');
        Route::get('/laporan', 'ArchiveReportController@index')->name('report.index');
        Route::post('/laporan', 'ArchiveReportController@report')->name('report.print');
        Route::resource('/klasifikasi', 'ClasificationController');
        Route::get('/petugas', 'PetugasTtdController@archive');
        Route::put('/petugas', 'PetugasTtdController@archiveUpdate');
        Route::put('/confirm', 'ArchiveController@confirm');
        Route::get('/bundle/{type}', 'ArchiveController@bundleList')->name('bundle-list');
        Route::get('/validasi/{type}/{bundle_id}', 'ArchiveController@validationList')->name('validation-list');

        // letter number
        Route::resource('/nomor-surat', 'LetterNumberController');
        Route::get('/penomoran/{id}/restore', 'LetterNumberUsedController@restore')->name('penomoran.restore');
        Route::get('/penomoran/{id}/force-delete', 'LetterNumberUsedController@forceDelete')->name('penomoran.force_delete');
        Route::post('/penomoran/send', 'LetterNumberUsedController@send')->name('penomoran.send');
        Route::resource('/penomoran', 'LetterNumberUsedController');

        Route::get('/{type}', 'ArchiveController@index')->name('index');
        Route::get('/{type}/create', 'ArchiveController@create')->name('create');
        Route::get('/{type}/create', 'ArchiveController@create')->name('create');
        Route::post('/{type}', 'ArchiveController@store')->name('store');
        Route::get('/{type}/{id}', 'ArchiveController@detail')->name('detail');
        Route::put('/{type}/{id}', 'ArchiveController@update')->name('update');
        Route::delete('/{type}/{id}', 'ArchiveController@destroy')->name('destroy');
        Route::get('/{type}/{id}/edit', 'ArchiveController@edit')->name('edit');
        Route::get('/{type}/create-custom/{id}', 'ArchiveController@createCustom')->name('create-custom');
    });

    // ------------------------------------------
    // GUIDE GROUP
    // ------------------------------------------
    Route::group(['prefix' => 'panduan', 'as' => 'guide.'], function () {
        Route::get('esurat', 'GuideController@esurat')->name('guide.esurat');
        Route::get('earsip', 'GuideController@earsip')->name('guide.earsip');
        Route::get('eagenda', 'GuideController@eagenda')->name('guide.eagenda');
        Route::get('disposisi', 'GuideController@disposisi')->name('guide.eagenda');
    });

    // ------------------------------------------
    // WEB API
    // ------------------------------------------
    Route::get('receiver-data', 'ReceiverController@apiData')->name('receiver.api_data');
    Route::get('inbox-detail/{id}', 'InboxController@detail')->name('inbox.api_detail');
    Route::get('outbox-detail/{id}', 'OutboxController@detail')->name('outbox.api_detail');
    Route::get('agenda-detail/{id}', 'AgendaController@detail')->name('agenda.api_detail');
    Route::get('archive-detail/{type}/{id}', 'ArchiveController@detail')->name('archive.api_detail');
    Route::get('disposition/detail/{id}', 'DispositionController@detail')->name('disposition.api_detail');
    Route::get('disposition/store', 'DispositionController@store')->name('disposition.api_store');
    Route::get('disposition/update', 'DispositionController@update')->name('disposition.api_update');
    Route::get('count-forward', 'ForwardController@count')->name('forward.api_count');
    Route::get('count-visitor', 'VisitorController@count')->name('visitor.api_count');
    Route::get('number-order/{date}', 'LetterNumberUsedController@generateNumberOrder')->name('letter_number.number_order');
    Route::post('check-disposition-password', 'DispositionAdminController@checkPassword')->name('disposition_admin.api_password_check');
    Route::get('skpd-pejabat/skpd/{skpd_id}', 'SkpdEmployeeController@apiGetData');

    // NOTIF SPT
    Route::get('notif-spt', 'NotifSptController@index')->name('notif_spt.index');
    Route::post('notif-spt', 'NotifSptController@store')->name('notif_spt.store');
    Route::post('notif-spt/phone', 'NotifSptController@phoneStore')->name('notif_spt.phone.store');
    Route::post('notif-spt/template', 'NotifSptController@templateStore')->name('notif_spt.template.store');
    Route::put('notif-spt/phone/{id}', 'NotifSptController@phoneUpdate')->name('notif_spt.phone.update');
    Route::put('notif-spt/template/{id}', 'NotifSptController@templateUpdate')->name('notif_spt.template.update');
    Route::delete('notif-spt/phone/{id}', 'NotifSptController@phoneDestroy')->name('notif_spt.phone.delete');
    Route::delete('notif-spt/template/{id}', 'NotifSptController@templateDestroy')->name('notif_spt.template.delete');
    Route::get('notif-spt-new', 'NotifSptController@new')->name('notif_spt_new.index');
    Route::put('notif-spt-new', 'NotifSptController@newUpdate')->name('notif_spt_new.update');
    // RECYCLE BIN
    Route::get('recycle', 'RecycleBinController@index')->name('recycle_bin.index');
    Route::put('recycle/restore', 'RecycleBinController@restore')->name('recycle_bin.restore');
    Route::delete('recycle/remove', 'RecycleBinController@remove')->name('recycle_bin.remove');

    // BACKUP DATABASE
    Route::post('backup/upload', ['as' => 'backup.upload', 'uses' => 'BackupController@upload']);
    Route::post('backup/{fileName}/restore', ['as' => 'backup.restore', 'uses' => 'BackupController@restore']);
    Route::get('backup/{fileName}/dl', ['as' => 'backup.download', 'uses' => 'BackupController@download']);
    Route::get('backup/{fileName}/attachment', ['as' => 'backup.download_attachment', 'uses' => 'BackupController@downloadAttachment']);
    Route::resource('backup', 'BackupController');

    // LOG VIEWER
    Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');

    // SPT
    Route::resource('skpd', 'SkpdController');
    Route::resource('skpd-pejabat', 'SkpdEmployeeController');
    Route::resource('spt', 'SptController');
    Route::post('spt-accept', 'SptController@accept');
    Route::resource('spt-laporan', 'SptReportController');
    Route::resource('spt-ttd', 'SptSignerController');
    Route::get('spt-cari', 'SptController@search');
});
