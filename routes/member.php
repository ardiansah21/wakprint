<?php
    //route khusu member

    
    Route::get('member/login','AuthMember\LoginMemberController@showMemberLogin')->name('member.login.show');
    Route::get('member/login','AuthMember\LoginMemberController@login')->name('member.login');


    Route::group(['middleware' => 'auth:member'], function () {
        Route::get('profil','MemberController@profil')->name('profil');
        Route::get('member/logout','MemberController@logout')->name('member.logout');
    });