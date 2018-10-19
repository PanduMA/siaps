<?php

namespace App\Http\Controllers;

use App\aspirasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Response;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    //SISWA

    public function siswa($username)
    {
        $valid = Session::get('nis');
        if (!empty($valid)) {
            if ($username == $valid[0]) {
                $jml = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlah'))
                    ->where('nis', '=', $username)
                    ->get();
                $bk = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlahbk'))
                    ->where([
                        ['nis', '=', $username],
                        ['kategori', '=', 'BK'],
                    ])
                    ->get();
                $ks = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlahks'))
                    ->where([
                        ['nis', '=', $username],
                        ['kategori', '=', 'Kesiswaan'],
                    ])
                    ->get();
                $siswa = DB::table('siswa')->where('nis', $username)->get();
                $users = DB::table('users')->where('username', $username)->first();
                $ca = $users->created_at;
                $bergabung = date('j M Y ', strtotime($ca));
                return view('siswa', ['username' => $username, 'siswa' => $siswa, 'jml' => $jml, 'bk' => $bk, 'ks' => $ks, 'bergabung' => $bergabung]);
            } else {
                $jml = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlah'))
                    ->where('nis', '=', $valid[0])
                    ->get();
                $bk = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlahbk'))
                    ->where([
                        ['nis', '=', $valid[0]],
                        ['kategori', '=', 'BK'],
                    ])
                    ->get();
                $ks = DB::table('aspirasi')
                    ->select(DB::raw('COUNT(*) as jumlahks'))
                    ->where([
                        ['nis', '=', $valid[0]],
                        ['kategori', '=', 'Kesiswaan'],
                    ])
                    ->get();
                $siswa = DB::table('siswa')->where('nis', $valid[0])->get();
                $users = DB::table('users')->where('username', $valid[0])->first();
                $ca = $users->created_at;
                $bergabung = date('j M Y ', strtotime($ca));
                return view('siswa', ['username' => $valid[0], 'siswa' => $siswa, 'jml' => $jml, 'bk' => $bk, 'ks' => $ks, 'bergabung' => $bergabung]);
            }
        } else {
            return redirect()->action('HomeController@aspirasiguru', ['username' => $username]);
        }

    }
    public function aspirasisiswa($username)
    {
        $valid = Session::get('nis');
        if (!empty($valid)) {
            $valid = Session::get('nis');
            if ($username == $valid[0]) {
                $siswa = DB::table('siswa')->where('nis', $valid[0])->get();
                $aspirasi = DB::table('aspirasi')->where('nis', $valid[0])->paginate(5);
                return view('aspirasi-siswa', ['username' => $valid[0], 'siswa' => $siswa, 'aspirasi' => $aspirasi]);
            } else {
                $siswa = DB::table('siswa')->where('nis', $valid[0])->get();
                $aspirasi = DB::table('aspirasi')->where('nis', $valid[0])->paginate(5);
                return view('aspirasi-siswa', ['username' => $valid[0], 'siswa' => $siswa, 'aspirasi' => $aspirasi]);
            }
        } else {
            return redirect()->action('HomeController@aspirasiguru', ['username' => $username]);
        }
    }
    public function siswaupdate(Request $req, $username)
    {
        $pp = Input::file('ppUpload');
        if (Input::hasFile('ppUpload')) {
            $pp->move('uploads', $pp->getClientOriginalName());
            $gambar = $pp->getClientOriginalName();
            DB::table('siswa')->where('nis', $username)->update(['nama' => $req->nm,'jenis_kelamin' => $req->jk, 'tingkat' => $req->tk, 'jurusan' => $req->jr, 'kelas' => $req->kls,'gambar'=>$gambar]);
        }else{
            DB::table('siswa')->where('nis', $username)->update(['nama' => $req->nm, 'jenis_kelamin' => $req->jk, 'tingkat' => $req->tk, 'jurusan' => $req->jr, 'kelas' => $req->kls]);
        }
        $jml = DB::table('aspirasi')
            ->select(DB::raw('COUNT(*) as jumlah'))
            ->where('nis', '=', $username)
            ->get();
        $bk = DB::table('aspirasi')
            ->select(DB::raw('COUNT(*) as jumlahbk'))
            ->where([
                ['nis', '=', $username],
                ['kategori', '=', 'BK'],
            ])
            ->get();
        $ks = DB::table('aspirasi')
            ->select(DB::raw('COUNT(*) as jumlahks'))
            ->where([
                ['nis', '=', $username],
                ['kategori', '=', 'Kesiswaan'],
            ])
            ->get();
       
        $siswa = DB::table('siswa')->where('nis', $username)->get();
        $users = DB::table('users')->where('username', $username)->first();
        $ca = $users->created_at;
        $bergabung = date('j M Y ', strtotime($ca));
        return view('siswa', ['username' => $username, 'nama' => $req->nama, 'siswa' => $siswa, 'jml' => $jml, 'bk' => $bk, 'ks' => $ks,'bergabung'=>$bergabung])->with('msg', 'Update Succesfull');
    }
    public function aspirasiinsert(Request $req, $username)
    {
        $x = Input::file('file');
        date_default_timezone_set("Asia/Jakarta");
        $date = date("Y-m-d h:i:s");
        $siswa = DB::table('siswa')->where('nis', $username)->get();
        $data = DB::table('siswa')->where('nis', $username)->first();
        $nama = $data->nama;
        if (Input::hasFile('file')) {
            $x->move('uploads', $x->getClientOriginalName());
            $gambar = $x->getClientOriginalName();
            DB::table('aspirasi')->insert(['nis' => $username, 'nama_siswa' => $nama, 'subjek' => $req->subjek, 'pesan' => $req->pesan, 'waktu' => $date, 'kategori' => $req->kategori, 'gambar' => $gambar]);
        } else {
            DB::table('aspirasi')->insert(['nis' => $username, 'nama_siswa' => $nama, 'subjek' => $req->subjek, 'pesan' => $req->pesan, 'waktu' => $date, 'kategori' => $req->kategori]);
        }
        $aspirasi = DB::table('aspirasi')->where('nis', $username)->paginate(5);
        return view('aspirasi-siswa', ['username' => $username, 'siswa' => $siswa, 'aspirasi' => $aspirasi])->with('pesan', 'Aspirasi berhasil ditambahkan');
    }
    public function aspirasidelete($username, $id)
    {
        $siswa = DB::table('siswa')->where('nis', $username)->get();
        $aspirasi = DB::table('aspirasi')->where('nis', $username)->get();
        DB::table('aspirasi')->where('id', '=', $id)->delete();
        return view('aspirasi-siswa', ['username' => $username, 'siswa' => $siswa, 'aspirasi' => $aspirasi])->with('mg', 'Succesfull');
    }

    public function deletedata(Request $req)
    {
        aspirasi::find($req->id)->delete();
        return response()->json();
    }

    // GURU
    public function aspirasiguru($username)
    {
        $valid2 = Session::get('nip');
        if (!empty($valid2)) {
            if ($username == $valid2[0]) {
                $guru = DB::table('guru')->where('nip', $valid2[0])->get();
                $kategori = DB::table('guru')->where('nip', $valid2[0])->first();
                $kg = $kategori->kategori;
                $aspirasi = DB::table('aspirasi')->where('kategori', $kg)->paginate(5);
                return view('aspirasi-guru', ['username' => $valid2[0], 'guru' => $guru, 'aspirasi' => $aspirasi]);
            } else {
                $guru = DB::table('guru')->where('nip', $valid2[0])->get();
                $kategori = DB::table('guru')->where('nip', $valid2[0])->first();
                $kg = $kategori->kategori;
                $aspirasi = DB::table('aspirasi')->where('kategori', $kg)->paginate(5);
                return view('aspirasi-guru', ['username' => $valid2[0], 'guru' => $guru, 'aspirasi' => $aspirasi]);
            }
        } else {
            return redirect()->action('HomeController@aspirasisiswa', ['username' => $username]);
        }

    }
    public function guru($username)
    {
        $valid2 = Session::get('nip');
        if (!empty($valid2)) {
            if ($username == $valid2[0]) {
                $guru = DB::table('guru')->where('nip', $valid2[0])->get();
                $users = DB::table('users')->where('username', $valid2[0])->first();
                $crat = $users->created_at;
                $bergabung = date('j M Y ', strtotime($crat));
                return view('guru', ['username' => $valid2[0], 'guru' => $guru, 'bergabung' => $bergabung]);
            } else {
                $guru = DB::table('guru')->where('nip', $valid2[0])->get();
                $users = DB::table('users')->where('username', $valid2[0])->first();
                $crat = $users->created_at;
                $bergabung = date('j M Y ', strtotime($crat));
                return view('guru', ['username' => $valid2[0], 'guru' => $guru, 'bergabung' => $bergabung]);
            }
        } else {
            return redirect()->action('HomeController@aspirasisiswa', ['username' => $username]);
        }
    }
    public function guruupdate(Request $req, $username)
    {   
        $pp = Input::file('imageUpload');        
        if (Input::hasFile('imageUpload')) {
            $pp->move('uploads', $pp->getClientOriginalName());
            $gambar = $pp->getClientOriginalName();
            DB::table('guru')->where('nip', $username)->update(['nama' => $req->nm, 'jenis_kelamin' => $req->jk, 'gambar' => $gambar]);
        }else{
            DB::table('guru')->where('nip', $username)->update(['nama' => $req->nm, 'jenis_kelamin' => $req->jk]);
        }
        $users = DB::table('users')->where('username', $username)->first();
        $crat = $users->created_at;
        $bergabung = date('j M Y ', strtotime($crat));
        $guru = DB::table('guru')->where('nip', $username)->get();
        return view('guru', ['username' => $username, 'guru' => $guru,'bergabung'=>$bergabung,'gambar'=>$gambar])->with('msg', 'Update Succesfull');
    }
    public function aspirasiguruid($username, $id)
    {
        $guru = DB::table('guru')->where('nip', $username)->get();
        $kategori = DB::table('guru')->where('nip', $username)->first();
        $aspirasi = DB::table('aspirasi')->where('id', $id)->first();
        $gambar = $aspirasi->gambar;
        return view('aspirasi', ['aspirasi' => $aspirasi, 'username' => $username, 'guru' => $guru, 'gambar' => $gambar]);
    }
    public function statistik($username)
    {
        $guru = DB::table('guru')->where('nip', $username)->get();
        $kategori = DB::table('guru')->where('nip', $username)->first();
        $kg = $kategori->kategori;
        $jur = DB::table('aspirasi')
        ->join('siswa', 'siswa.nis', '=', 'aspirasi.nis')
        ->select(DB::raw('COUNT(*) AS jml'), 'siswa.jurusan')
        ->where('aspirasi.kategori', $kg)
        ->groupBy('siswa.jurusan')
        ->orderByRaw('COUNT(*) DESC')
        ->first();
        if ($jur->jurusan == 'Rekayasa Perangkat Lunak') {
            $nmjur = 'RPL';
        } elseif ($jur->jurusan == 'Teknik Elektronika Industri') {
            $nmjur = 'TEI';
        } elseif ($jur->jurusan == 'Teknik Pendingin') {
            $nmjur = 'TP';
        } elseif ($jur->jurusan == 'Teknik Otomasi Industri') {
            $nmjur = 'TOI';
        } elseif ($jur->jurusan == 'Teknik Elektronika Komunikasi') {
            $nmjur = 'TEK';
        } elseif ($jur->jurusan == 'Sistem Informasi dan Jaringan dan Aplikasi') {
            $nmjur = 'SIJA';
        } elseif ($jur->jurusan == 'Instrumentasi Otamatisasi Proses') {
            $nmjur = 'IOP';
        } elseif ($jur->jurusan == 'Produksi Film dan Pertelevisian') {
            $nmjur = 'PFPT';
        } else {
            $nmjur = 'NULL';
        }
        $jmlas = DB::table('aspirasi')
        ->select(DB::raw('COUNT(*) AS Jumlah'))
        ->where('kategori', $kg)
        ->groupBy('kategori')
        ->get();
        $day = DB::table('aspirasi')
            ->whereRaw('DATE(waktu) = CURDATE()')
            ->where('kategori',$kg)
            ->get();
        $today = count($day);
        if (!count($jmlas)) {
            $jml= "0";
        }else {
            $jml = $jmlas;
        }
        $bulanan = DB::table('aspirasi')
        ->select(DB::raw('COUNT(*) AS data,MONTHNAME(waktu) as waktu'))
        ->where('kategori',$kg)
        ->groupBy(DB::raw('MONTH(waktu)'))
        ->get();

        $harian = DB::table('aspirasi')
        ->select(DB::raw('COUNT(*) AS data,DATE(waktu) AS tgl'))
        ->where('kategori',$kg)
        ->groupBy(DB::raw('DATE(waktu)'))
        ->get();
        
        return view('statistik', ['username' => $username, 'guru' => $guru, 'jml' => $jml, 'nmjur' => $nmjur, 'today' => $today,'bulanan'=>$bulanan,'harian'=>$harian]);
    }
}
