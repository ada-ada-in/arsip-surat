<?php

namespace App\Controllers;

class PagesController extends BaseController
{
    public function admin(): string
    {
        return view('layouth/main_layout');
    }
    public function dashboard(): string
    {
        return view('pages/dashboard');
    }
    public function suratKeluar(): string
    {
        return view('pages/surat-keluar');
    }
    public function suratMasuk(): string
    {
        return view('pages/surat-masuk');
    }
    public function pengguna(): string
    {
        return view('pages/pengguna');
    }
    public function disposisi(): string
    {
        return view('pages/disposisi');
    }
    public function arsip(): string
    {
        return view('pages/arsip');
    }
    public function profile(): string 
    {
        return view('pages/profile');
    }
    public function disposisikepada(): string 
    {
        return view('pages/disposisikepada');
    }
    public function disposisipetunjuk(): string 
    {
        return view('pages/disposisipetunjuk');
    }
    public function jenissurat(): string 
    {
        return view('pages/jenissurat');
    }
    public function sifatsurat(): string 
    {
        return view('pages/sifatsurat');
    }
    public function statussurat(): string 
    {
        return view('pages/statussurat');
    }


    // auth
    public function login(): string
    {
        return view('auth/login');
    }
    public function register(): string {
        return view('auth/register');
    }
}
