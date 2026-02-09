<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kejuruan;
use App\Models\Profile;
use App\Models\Achievement;

class HomeController extends Controller
{
    // Method untuk halaman Beranda
    public function index()
    {
        $sambutan = Profile::where('type', 'sambutan')->first();
        $kejuruans = Kejuruan::all();

        $sliders = \App\Models\Slider::where('is_active', true)->with('image')->get();
        $news = \App\Models\News::where('status', 'published')->with('image')->latest()->take(3)->get();
        $latestGalleries = \App\Models\Gallery::with('media')->latest()->take(6)->get();

        $visimisi = Profile::where('type', 'visi_misi')->with('image')->first();
        $achievements = Achievement::with('image')->latest()->take(3)->get();
        $ekstrakurikulers = Profile::where('type', 'ekstrakurikuler')->with('image')->get();
        $mitras = Profile::where('type', 'mitra')->with('image')->get();
        $schoolProfile = Profile::where('type', 'profil')->first();

        return view('views.beranda', compact('sambutan', 'kejuruans', 'sliders', 'news', 'latestGalleries', 'visimisi', 'achievements', 'ekstrakurikulers', 'mitras', 'schoolProfile'));
    }

    // Method untuk halaman Profil Sekolah
    public function profilSekolah()
    {
        $profil = Profile::where('type', 'profil')->first();
        return view('views.profil.profilsekolah', compact('profil'));
    }

    public function sambutan()
    {
        $sambutan = Profile::where('type', 'sambutan')->with('media')->first();
        return view('views.profil.sambutan', compact('sambutan'));
    }

    public function visimisi()
    {
        $profil = Profile::where('type', 'visi_misi')->with('media')->first();
        return view('views.profil.visimisi', compact('profil'));
    }

    public function struktur()
    {
        $struktur = Profile::where('type', 'struktur')->with('media')->first();
        return view('views.profil.struktur', compact('struktur'));
    }

    public function sarana()
    {
        $saranas = Profile::where('type', 'sarana')->with('media')->get();
        return view('views.profil.sarana', compact('saranas'));
    }

    public function fasilitas()
    {
        $saranas = Profile::where('type', 'sarana')->with('media')->get();
        return view('views.profil.fasilitas', compact('saranas'));
    }

    public function ekstrakurikuler()
    {
        $ekstrakurikulers = Profile::where('type', 'ekstrakurikuler')->with('media')->get();
        return view('views.profil.ekstrakurikuler', compact('ekstrakurikulers'));
    }

    public function mesin()
    {
        $kejuruan = Kejuruan::where('slug', 'teknik-pemesinan')->first();
        return view('views.kejuruan.teknikpemesinan', compact('kejuruan'));
    }

    public function pplg()
    {
        $kejuruan = Kejuruan::where('slug', 'pplg')->first();
        return view('views.kejuruan.pplg', compact('kejuruan'));
    }

    public function galeri()
    {
        return view('views.galeri.index');
    }

    public function registrasiAlumni()
    {
        return view('views.bkk.registrasialumni');
    }

    public function infoLowongan()
    {
        return view('views.bkk.infolowongan');
    }

    public function kontak()
    {
        $profil = Profile::where('type', 'profil')->first();
        return view('views.kontak', compact('profil'));
    }

    public function berita()
    {
        return view('views.berita.index');
    }

    public function kurikulum()
    {
        return view('views.akademik.kurikulum');
    }

    public function kalender()
    {
        return view('views.akademik.kalender');
    }

    public function prestasi()
    {
        return view('views.akademik.prestasi');
    }
}