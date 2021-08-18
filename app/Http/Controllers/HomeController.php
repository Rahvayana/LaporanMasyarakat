<?php

namespace App\Http\Controllers;

use App\Models\Inspector;
use App\Models\Message;
use App\Models\Report;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['user']=User::where('role','USER')->count();
        $data['penyidik']=User::where('role','PENYIDIK')->count();
        $data['admin']=User::where('role','ADMIN')->count();
        $data['pengaduan']=Report::get()->count();
        
        
        // dd($data);
        return view('home',$data);
    }
    
    public function graph()
    {
        for ($i=1; $i <13 ; $i++) { 
            $data[]=DB::table('reports')->whereMonth('created_at',$i)->count();
        }

        
        return response(($data));
    }

    public function pengaduan()
    {
        if(Auth::user()->role!='USER'||Auth::user()->role!='ADMIN'){
            $data['reports'] = DB::table('reports')->select('reports.*','users.name')
                ->leftJoin('users', 'users.id', 'reports.user_id')
                ->where(function ($query) {
                    if (Auth::user()->role=='USER') {
                        $query->where('reports.user_id', Auth::id());
                    }
                })->orderBy('created_at','DESC')->get();
        }else{
            $data['reports'] = DB::table('inspectors')->select('reports.*','users.name')
                ->leftJoin('reports', 'reports.id', 'inspectors.report_id')
                ->leftJoin('users', 'users.id', 'reports.user_id')
                ->orderBy('created_at','DESC')
                ->get();
        }
        
        // dd($data);

        return view('pages.pengaduan',$data);
    }

    public function tambahPengaduan()
    {
        return view('pages.add-pengaduan');
    }

    public function simpanPengaduan(Request $request)
    {
        $validated = $request->validate([
            'terlapor' => 'required',
            'proyek' => 'required',
            'anggaran' => 'required',
            'deskripsi' => 'required',
            'file' => 'required|max:2048',
        ]);
        $i=1;
        foreach($request->file as $file){
            $fileName=time().$i.'.'.$file->getClientOriginalExtension();
            if ($request->file) {
                $path = public_path().'/assets/files';
                $file->move($path,$fileName);
            }
            $files[]=$fileName;
            $i++;
        }
        $report=new Report();
        $report->user_id=Auth::id();
        $report->terlapor=$request->terlapor;
        $report->proyek=$request->proyek;
        $report->anggaran=$request->anggaran;
        $report->deskripsi=$request->deskripsi;
        $report->dokumen=json_encode($files);
        $report->status='RECEIVED';
        $report->save();
        return redirect()->back()->with('success', 'Sukses Membuat Laporan!');   

    }

    public function detailPengaduan($id)
    {
        $data['report'] = DB::table('reports')->select('reports.*','users.name')
                ->leftJoin('users', 'users.id', 'reports.user_id')
                ->where('reports.id',$id)
                ->first();
        $data['inspectors']=User::where('role','PENYIDIK')->get();
        // dd($data);
        return view('pages.detail',$data);
    }

    public function pilihPenyidik($id,Request $request)
    {
        $validated = $request->validate([
            'penyidik' => 'required'
        ]);
        $report=new Report();
        $report=Report::find($id);
        $report->status='CHECKED';
        $report->save();

        $inspector=new Inspector();
        $inspector->user_id=$request->penyidik;
        $inspector->report_id=$id;
        $inspector->save();
        return redirect()->back()->with('success', 'Sukses Mengirim Ke Penyidik!');   

    }

    public function chat($id)
    {
        $data['report'] = DB::table('reports')->select('reports.*','users.name')
                ->leftJoin('users', 'users.id', 'reports.user_id')
                ->where('reports.id',$id)
                ->first();
        $inspector=DB::table('inspectors')->select('inspectors.user_id','users.name as pelapor')
        ->leftJoin('reports', 'reports.id', 'inspectors.report_id')
        ->leftJoin('users', 'users.id', 'reports.user_id')
        ->where('reports.id',$id)
        ->first();
        $data['inspector']=User::find($inspector->user_id);
        $data['chats']=Message::where('report_id',$id)->get();
        // dd($data);
        return view('pages.chat',$data);
    }

    public function chatting(Request $request)
    {
        $validated = $request->validate([
            'pesan' => 'required',
        ]);
        $message=new Message();
        $message->sender_id=$request->id_sender;
        $message->receiver_id=$request->id_receiver;
        $message->report_id=$request->id_report;
        $message->body=$request->pesan;
        $message->save();
        return redirect()->back()->with('success', 'Sukses Mengirim Pesan!');   
    }
}
