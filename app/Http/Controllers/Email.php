<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Redirect;
use DB;

use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\uom;
use App\pkp\data_ses;
use App\pkp\ses;
use App\notification;
use App\User;
use App\pkp\promo_idea;
use App\pkp\promo;
use App\pkp\product_allocation;
use App\pkp\data_promo;
use App\pkp\coba;
use App\pkp\klaim;
use App\pkp\detail_klaim;
use App\pkp\komponen;
use App\pkp\data_klaim;
use App\pkp\data_detail_klaim;
use App\pkp\tipp;
use App\pkp\picture;
use App\pkp\data_forecast;

class Email extends Controller
{
    public function sendEmail(Request $request,$id)
    {
        $active = user::where('id',$id)->first();
        $active->status=$request->status;
        $active->save();
        
        try{
            Mail::send('email', ['nama'=>$request->nama,'role'=>$request->role,'pesan'=>$request->pesan,'email'=>$request->email,'username'=>$request->username,'dept'=>$request->dept,],function($message)use($request)
            {
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $message->to($request->email);
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function sendEmailreject(Request $request,$id)
    {
        $active = user::where('id',$id)->first();
        $active->delete();
        try{
            Mail::send('email', ['nama'=>$request->nama,'role'=>$request->role,'pesan'=>$request->pesan,'email'=>$request->email,'username'=>$request->username,'dept'=>$request->dept,],function($message)use($request)
            {
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $message->to($request->email);
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpdf(Request $request,$id_project_pdf,$revisi, $turunan){
        $datapdf = coba::where('pdf_id',$id_project_pdf)->count();
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pdf = project_pdf::join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        try{
            Mail::send('pv.emailpdf', [
                'pdf' => $pdf,
                'pdf1' => $pdf1,
                'datases' => $ses,
                'for' => $for,
                'datapdf' => $datapdf,
                'picture' => $picture,], function ($message) use ($request)
                {
                    $data = [$request->pengirim,$request->pengirim1,$request->pengirim2,'asrimarifah0402@gmail.com'];
                    $message->subject($request->judul);
                    $message->from('app.prodev@nutrifood.co.id', 'User PV');
                    $message->to($request->email);
                    $message->cc($data);

                    if($request->pic!=null){
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                    $picture = implode(',', $request->input('pic'));
                    $data = explode(',', $picture);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->attach(public_path() . '/' .$data[$i]);
                    }
                }}
                });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpromo(Request $request,$id_pkp_promo,$revisi, $turunan){
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $picture = picture::where('promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        try{
            Mail::send('pv.promoemail', [
                'promo' => $promo,
                'promo1' => $promo1,
                'promoo' => $promoo,
                'app' => $app,
                'idea' => $idea,
                'picture' => $picture,
                'allocation' => $allocation,
                'jumlahpromo' => $jumlahpromo,], function ($message) use ($request)
            {
                $data = [$request->pengirim,$request->pengirim1,$request->pengirim2];
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'User PV');
                $message->to($request->email);
                $message->cc($data);

                if($request->pic!=null){
                $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                    $picture = implode(',', $request->input('pic'));
                    $data = explode(',', $picture);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->attach(public_path() . '/' .$data[$i]);
                    }
                 } }
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpkp(Request $request,$id_project,$revisi, $turunan){
        $datapkp = tipp::where('id_pkp',$id_project)->count();
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi','<=',$revisi], ['turunan','<=',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        try{
            Mail::send('pv.emailpkp', [
            'pkpp' => $pkpp,
            'pkp' => $pkp,
            'datases' => $ses,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp1' => $pkp1,
            'datapkp' => $datapkp,
            'picture' => $picture,], function ($message) use ($request)
            {
                $data = [$request->pengirim,$request->pengirim1,$request->pengirim2];
                $message->subject($request->judul);
                $message->from('app.prodev@nutrifood.co.id', 'User PV');
                $message->to($request->email);
                $message->cc($data);

                if($request->pic!=null){
                $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                    $picture = implode(',', $request->input('pic'));
                    $data = explode(',', $picture);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->attach(public_path() . '/' .$data[$i]);
                    }
                }}
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function approveemailpkp(Request $request,$id_project){
        $app1 = pkp_project::where('id_project',$id_project)->first();
        $app1->approval='approve';
        $app1->save();

        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'info'=>'selamat project anda telah disetujui :)',
                'app'=>$isipkp,
            ],function($message)use($request,$id_project)
            {
                $message->subject('INFO');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $pkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
                foreach($pkp as $pkp){
                    $user = DB::table('users')->where('id',$pkp->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpkp(Request $request,$id_project){
        $app = pkp_project::where('id_project',$id_project)->first();
        $app->approval='reject';
        $app->save();

        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'info'=>'Project anda di tolak, silahkan hubungi pihak yang bersangkutan :)',
                'app'=>$isipkp,
            ],function($message)use($request,$id_project)
            {
                $message->subject('INFO');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $pkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
                foreach($pkp as $pkp){
                    $user = DB::table('users')->where('id',$pkp->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

    }

    public function approveemailpdf(Request $request,$id_project_pdf){
        $app = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $app->approval='approve';
        $app->save();

        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info'=>'selamat project anda telah disetujui :)',
                'app'=>$isipdf,
            ],function($message)use($request,$id_project_pdf)
            {
                $message->subject('INFO');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $pdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
                foreach($pdf as $pdf){
                    $user = DB::table('users')->where('id',$pdf->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpdf($id_project_pdf){
        $app = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $app->approval='reject';
        $app->save();

        $notif = notification::where('id_pdf',$id_project_pdf)->first();
        $notif->id_pdf=$id_project_pdf;
        $notif->title="The PDF Project is rejected";
        $notif->status='active';
        $notif->save();

        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info'=>'selamat project anda telah disetujui :)',
                'app'=>$isipdf,
            ],function($message)use($request,$id_project_pdf)
            {
                $message->subject('INFO');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $pdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
                foreach($pdf as $pdf){
                    $user = DB::table('users')->where('id',$pdf->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function approveemailpromo(Request $request,$id_pkp_promo){
        $app = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $app->approval='approve';
        $app->save();

        $isipromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'info'=>'selamat project anda telah disetujui :)',
                'app'=>$isipromo,
            ],function($message)use($request,$id_pkp_promo)
            {
                $message->subject('INFO');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
                foreach($promo as $promo){
                    $user = DB::table('users')->where('id',$promo->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpromo($id_pkp_promo){
        $app = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $app->approval='reject';
        $app->save();

        $notif = notification::where('id_promo',$id_pkp_promo)->first();
        $notif->id_PROMO=$id_pkp_promo;
        $notif->title="The PROMO Project is rejected";
        $notif->status='active';
        $notif->save();
    }

    public function REmail(){
        return view('pkp.REmail');
    }
}