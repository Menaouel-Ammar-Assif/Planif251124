<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Direction;
use App\Models\UsersBlocked;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Vda;

use App\Models\Action;
use App\Models\prioritaires;


use App\Models\Objectif;
use App\Models\ActionsCop;
use App\Models\SousObjectif;
use App\Models\Indicateur;
use App\Models\ActionsPro;
use App\Models\ActionsProDr;

use App\Models\Description;
use App\Models\ActCopDrInd;
use App\Models\ActionsCopDr;
use App\Models\CobCible;
use App\Models\CobValeur;
use App\Models\NumDenom;
use App\Models\NumDenomVals;


/////////////////////////// Report ////////////////////////////////}}}}))
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActionsExport;
////////////////////////////////////////////////////////////////////

use Carbon\Carbon;


////////////////////////// pdf Download ////////////////////////////
use Dompdf\Dompdf;
////////////////////////////////////////////////////////////////////
use App\Models\Notification;

class AdminController extends Controller
{
    //////////////////////////////////////////////////Admin Dashboard////////////////////////////////////////////////////////////
    public function AdminDashboard(Request $request)
    {
        $DateY = date('Y');
        $DateM = date('m');
        $currentDate = date('Y-m');
        $curDate = date('Y-m-d');

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
        $request->validate([
            'direction' => 'nullable|exists:directions,id_dir',
        ]);
        
        $id_dirDc = $directionsDc->pluck('id_dir');
        $id_dirDr = $directionsDr->pluck('id_dir');

        $id_actDc= Vda::whereIn('id_dc', $id_dirDc)->pluck('id_act');
        $id_actDr= Vda::whereIn('id_dr', $id_dirDr)->pluck('id_act');

        $actionsDc = Action::whereIn('id_act', $id_actDc)->orderBy('id_act')->get();
        $actionsDr = Action::whereIn('id_act', $id_actDr)->orderBy('id_act')->get();

        $numActDc = $actionsDc->count();

        $numActDr = $actionsDr->count();

        $etatDc = $actionsDc->pluck('etat');
        $etatDr = $actionsDr->pluck('etat');

        $etatDcSum = $actionsDc->sum('etat');
        $etatDrSum = $actionsDr->sum('etat');

$AvancementDc = 0; // Initialize $AvancementDc
$AvancementDr = 0; // Initialize $AvancementDr
$AvancementD = 0; // Initialize $AvancementD
if ($numActDc > 0 || $numActDr > 0) {
$AvancementDc = ($etatDcSum / $numActDc) ;
if ($numActDr > 0) {
    $AvancementDr = ($etatDrSum / $numActDr);
} else {
    $AvancementDr = 0;
}
                $AvancementD = ($AvancementDc + $AvancementDr)/2 ;
                $AvancementDc = number_format($AvancementDc, 2, '.', '');
                $AvancementDr = number_format($AvancementDr, 2, '.', '');
                $AvancementD = number_format($AvancementD, 2, '.', '');
        }else{
        }
        $actIdDc = $actionsDc->pluck('id_act')->toArray();
        $actIdDr = $actionsDr->pluck('id_act')->toArray();

        $descDc = Description::whereIn('id_act', $actIdDc)->get();
        $descDr = Description::whereIn('id_act', $actIdDr)->get();

        $actions = Action::orderBy('id_act')->get();

        $numActions = $actions->count();
        // actions terminnes
        $etatTerm = $actions->where('etat', '100')->count();
        $etatTermDC = $actionsDc->where('etat', '100')->count();
        $etatTermDR = $actionsDr->where('etat', '100')->count();
        // actions retardées
        $etatRet = $actions->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
            })->count();

        $etatRetDC = $actionsDc->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();

        $etatRetDR = $actionsDr->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();

        // actions en cours
        $etatEnc = $numActions - ($etatTerm + $etatRet);
        $etatEncDC = $numActDc - ($etatTermDC + $etatRetDC);
        $etatEncDR = $numActDr - ($etatTermDR + $etatRetDR);

        $totalEtatDc = $actions->sum('etat');


        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();
        $id_p = $prioritaires->pluck('id_p');


        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $id_act_p = $act_p->pluck('id_act');

        $descriptions = Description::whereIn('id_act', $id_act_p)->orderBy('id_act')->get();

        $nmbr_act_p_ = $act_p->count();
        $etat_act_p_sum = $act_p->sum('etat');

if ($nmbr_act_p_ > 0) {
// Check if $etat_act_p_sum is zero
if ($etat_act_p_sum > 0) {
$avncmt_act_p = ($etat_act_p_sum / $nmbr_act_p_);
$avncmt_act_p = number_format($avncmt_act_p, 2, '.', '');
} else {
    // Handle the case where $etat_act_p_sum is zero
    $avncmt_act_p = 0;
}
} else {
    $avncmt_act_p = 0;
}

        $act_p_term = $act_p->where('etat', '100')->count();
        $act_p_ret = $act_p->filter(function($action) use ($curDate) {
            $actionDate = date('Y-m-d', strtotime($action->df));
            return $action->etat !== 100 && $actionDate < $curDate;
        })->count();
        $act_p_enc = $nmbr_act_p_ - ($act_p_term + $act_p_ret);

        // Temps écoulé année
        $currentDate = Carbon::now();
        $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
        $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
        $daysElapsed = $startOfYear->diffInDays($currentDate);
        $percentageElapsed = ($daysElapsed / $totalDaysInYear) * 100;
        $percentageElapsed = number_format($percentageElapsed, 2, '.', '');


        $data = [];
        foreach ($id_p as $prioritairesId) {
            $actions = prioritaires::find($prioritairesId)->Action()->get();
            $etat = $actions->sum('etat');
            $act = $actions->count();
            $m = $act > 0 ? $etat / $act : 0;
            $data[] = [
                'y' => $prioritairesId,
                'a' => $m,
                'b' => $percentageElapsed,
            ];
        }

        $dataJson = json_encode($data);

        //**************************************** COP *******************************************/
        $datacop = Objectif::with('SousObjectif.ActionsCop.ActCopInd.Indicateur')->get();
        $NbActCop = ActionsCop::select('id_act_cop')->count();
        $objectifs= Objectif::orderBy('id_obj')->get();
        $object= $objectifs->pluck('id_obj');

        //**************************************** ACTIONS PROPOSEES *******************************************/

        $actpro = [];

        $actionsPro = ActionsPro::get();
        $actionsProDr = ActionsProDr::get();

        if ($actionsPro->count() > 0 && $actionsProDr->count() > 0) 
        {
            foreach ($actionsPro as $actproItem) 
            {
                foreach ($actionsProDr as $actprolib) 
                {
                    if ($actproItem->id_act_pro == $actprolib->id_act_pro) 
                    {
                        $actpro[] = 
                        [
                            'structure' => $actprolib->lib_created_by,
                            'action' => $actproItem->lib_act_pro,
                            'dd' => $actproItem->dd,
                            'df' => $actproItem->df,
                            'dr' => $actprolib->lib_dir,
                        ];
                    }
                }
            }
        }
        $notifications = Notification::with('userBlocked.user')->get();

        $JSdate = now();
        return view("admin.admin_dashboard")->with([
            'directionsDc' => $directionsDc,
                'directionsDr' => $directionsDr,
                'AvancementDc' => $AvancementDc,
                'AvancementDr' => $AvancementDr,
                'AvancementD' => $AvancementD,
                'numActDc' => $numActDc,

                'descriptions' => $descriptions,
                'prioritaires' => $prioritaires,
                'nmbr_act_p' => $nmbr_act_p,
                'nmbr_act_p_' => $nmbr_act_p_,
                'id_p' => $id_p,
                'act_p' => $act_p,
                'datePercentage' => $percentageElapsed,
                'avncmt_act_p' => $avncmt_act_p,

                'act_p_term' => $act_p_term,
                'act_p_ret' => $act_p_ret,
                'act_p_enc' => $act_p_enc,

                'numActDr' => $numActDr,
                'numActions' => $numActions,
                'etatTerm' => $etatTerm,
                'etatTermDC' => $etatTermDC,
                'etatTermDR' => $etatTermDR,
                'etatRet' => $etatRet,
                'etatRetDC' => $etatRetDC,
                'etatRetDR' => $etatRetDR,
                'etatEnc' => $etatEnc,
                'etatEncDC' => $etatEncDC,
                'etatEncDR' => $etatEncDR,
                'dataJson' => $dataJson,

                'currentDate' =>$currentDate,
                'descDc' =>$descDc,
                'descDr' =>$descDr,
                'actionsDc' => $actionsDc,
                'actionsDr' => $actionsDr,

                'datacop' => $datacop,
                'NbActCop' => $NbActCop,
                'objectifs'=> $objectifs,
                'object'=> $object,
                'actions'=> $actions,
                'actpro'=> $actpro,
                'notifications'=> $notifications,
                'JSdate'=> $JSdate,
        ]);
    }


    public function AdminPageAddValue(){
        $month = date('m');
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();
        $Direction = Direction::orderBy('id_dir')->where('type_dir', 'dc')->select('id_dir', 'lib_dir' )->get();


        return view('admin.admin_addValue', compact('month','NumDenom', 'Direction'));

    }





    public function AdminAddValue(Request $request){

        $NumDenom = NumDenom::get();

        $name = $request->input('name');

        
            return redirect()->route('admin.pageAddValue')->with('success', 'Les calculs ajoutés');

    }






    public function addMonthTwo($month){

        $year = date('Y');

        // $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->select('id_num_denom', 'val')->get();

        $months = [
            1 => 'janvier',
            2 => 'février',
            3 => 'mars',
            4 => 'avril',
            5 => 'mai',
            6 => 'juin',
            7 => 'juillet',
            8 => 'août',
            9 => 'septembre',
            10 => 'octobre',
            11 => 'novembre',
            12 => 'décembre'
        ];
        $month = (int)$month;
        $m = $months[$month] ;

        $response = [
                'month' => $m,
                'year' => $year,
                // 'NumDenom' => $NumDenom,
                'NumDenomVals' => $NumDenomVals,
            ];
        return response()->json($response);

    }

    /////////////////////////////////////DC part///////////////////////////////////////
   public function ajaxDc($directionId)
   {
       
       $prioritaires = prioritaires::get();
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');}
       else { $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');}

       $actionsDc = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();



       $numActionsDc = $actionsDc->count();

       // actions terminnes ///////////////////////////////////////////////
       $etatTermDc = $actionsDc->where('etat', '100')->count();

       // actions retardées ///////////////////////////////////////////////
       $etatRetDc = $actionsDc->filter(function($action) use ($curDate) {
           $actionDate = date('Y-m-d', strtotime($action->df));
           return $action->etat !== 100 && $actionDate < $curDate;
       })->count();

       // actions en cours ///////////////////////////////////////////////
       $etatEncDc = $numActionsDc - ($etatTermDc + $etatRetDc);

       //totale des avancement des direction Centrale ////////////////////
       $totalEtatDc = $actionsDc->sum('etat');
       $AvncmDc = $totalEtatDc / $numActionsDc;

       ///////////////////////// START TEMP ECOLE ////////////////////////////////

       $currentDate = Carbon::now();
       $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
       $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
       $daysElapsed = $startOfYear->diffInDays($currentDate);
       $datePercentageDc = ($daysElapsed / $totalDaysInYear) * 100;
       $datePercentageDc = number_format($datePercentageDc, 2, '.', '');

       
       ///////////////////////// END TEMP ECOLE //////////////////////////////////

       // directions dc for lib
       $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();

       return response()->json([
                   'actionsDc' => $actionsDc,
                   'etatTermDc' => $etatTermDc,
                   'etatRetDc' => $etatRetDc,
                   'etatEncDc' => $etatEncDc,
                   'numActionsDc'=> $numActionsDc,
                   'AvncmDc' =>  $AvncmDc,
                   'datePercentageDc'=>$datePercentageDc,
                   'directionsDc'=>$directionsDc,
                   'prioritaires'=> $prioritaires,
                   
               ]);
   }

   public function btnDC($directionId,$idbtn)
   {
       $curDate = date('Y-m-d');
       $DateY = date('Y');
       $DateM = date('m');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');}
       else { $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');}

       $actions = Action::whereIn('id_act', $id_act);

       if($idbtn=='E')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '>', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
           })->orderBy('id_act')->get();
       }
       elseif($idbtn=='T')
       {
           $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();
       }
       elseif($idbtn=='R')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '<', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
           })->orderBy('id_act')->get();

       }
       else
       {
           $actionsFiltre = $actions->orderBy('id_act')->get();
       }

       $directionsDc = Direction::where('type_dir', 'dc')->orderBy('id_dir')->get();


       return response()->json([
           'actionsFiltre' => $actionsFiltre,
           'directionsDc'=>$directionsDc,

       ]);
   }

   public function DownDC($IdSelect, $Name)
    {

        $curDate = date('Y-m-d');
        $directionId = $IdSelect;
        $idbtn = $Name;


        if ($directionId == 'all')
        {
            $id_act = Vda::whereNotNull('id_dc')->pluck('id_act');
            $directionName = Direction::where('type_dir', 'dc')->get();
            $array = true;
        }
        else
        {
            $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');
            $directionName = Direction::where('id_dir', $directionId)->get();
            $array = false;
        }

        $actions = Action::whereIn('id_act', $id_act);

        if($idbtn=='DE')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '>', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_En_cours';
        }
        elseif($idbtn=='DT')
        {
            $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();

            $etat = 'Actions_Finalisée';
        }
        elseif($idbtn=='DR')
        {
            $actionsFiltre = $actions->where(function ($query) use ($curDate){
                $query->whereNull('etat')->where('df', '<', $curDate)
                    ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
            })->orderBy('id_act')->get();

            $etat = 'Actions_Echues';

        }
        else
        {
            $actionsFiltre = $actions->orderBy('id_act')->get();
            $etat = 'Toutes_Les_Actions';
        }


        if ($array)
        {
            $fileName = $etat.'_Structure_Centrales.xlsx';
        }
        else
        {
            $fileName = $etat.'_'.$directionName->pluck('lib_dir')->first().'.xlsx';
        }

        Excel::store(new ActionsExport($actionsFiltre, $directionName), $fileName, 'public');

        return response()->download(Storage::disk('public')->path($fileName), $fileName,
        [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function collection()
    {
        return Action::get();
    }
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////DR part///////////////////////////////////////
   public function ajaxDr($directionId)
   {
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');}
       else { $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');}

       $actionsDr = Action::whereIn('id_act', $id_act)->orderBy('id_act')->get();

       $numActionsDr = $actionsDr->count();

       // actions terminnes ///////////////////////////////////////////////
       $etatTermDr = $actionsDr->where('etat', '100')->count();

       // actions retardées ///////////////////////////////////////////////
       $etatRetDr = $actionsDr->filter(function($action) use ($curDate) {
           $actionDate = date('Y-m-d', strtotime($action->df));
           return $action->etat !== 100 && $actionDate < $curDate;
       })->count();

       // actions en cours ///////////////////////////////////////////////
       $etatEncDr = $numActionsDr - ($etatTermDr + $etatRetDr);

       //totale des avancement des direction Centrale ////////////////////
       $totalEtatDr = $actionsDr->sum('etat');
       $AvncmDr = $totalEtatDr / $numActionsDr;
       $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();



       return response()->json([
                   'actionsDr' => $actionsDr,
                   'etatTermDr' => $etatTermDr,
                   'etatRetDr' => $etatRetDr,
                   'etatEncDr' => $etatEncDr,
                   'numActionsDr'=> $numActionsDr,
                   'AvncmDr' =>  $AvncmDr,
                   'directionsDr'=>$directionsDr,
               ]);
   }

   public function btnDR($directionId,$idbtn)
   {
       $curDate = date('Y-m-d');

       if ($directionId == 'all'){ $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');}
       else { $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');}

       $actions = Action::whereIn('id_act', $id_act);

       if($idbtn=='E')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '>', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '>=', $curDate);
           })->orderBy('id_act')->get();
       }
       elseif($idbtn=='T')
       {
           $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();
       }
       elseif($idbtn=='R')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '<', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
           })->orderBy('id_act')->get();
       }
       else
       {
           $actionsFiltre = $actions->orderBy('id_act')->get();
       }

       $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();



           return response()->json([
               'actionsFiltre' => $actionsFiltre,
               'directionsDr'=>$directionsDr,

           ]);
   }

   public function DownDR($IdSelect, $Name)
   {

       $curDate = date('Y-m-d');
       $directionId = $IdSelect;
       $idbtn = $Name;


       if ($directionId == 'all')
       {
           $id_act = Vda::whereNotNull('id_dr')->pluck('id_act');
           $directionName = Direction::where('type_dir', 'dr')->get();
           $array = true;
       }
       else
       {
           $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');
           $directionName = Direction::where('id_dir', $directionId)->get();
           $array = false;
       }

       $actions = Action::whereIn('id_act', $id_act);

       if($idbtn=='DE')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '>', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '>', $curDate);
           })->orderBy('id_act')->get();

           $etat = 'Actions_Encours';
       }
       elseif($idbtn=='DT')
       {
           $actionsFiltre = $actions->where('etat', '100')->orderBy('id_act')->get();

           $etat = 'Actions_Terminées';
       }
       elseif($idbtn=='DR')
       {
           $actionsFiltre = $actions->where(function ($query) use ($curDate){
               $query->whereNull('etat')->where('df', '<', $curDate)
                   ->orWhere('etat', '!=', '100')->where('df', '<', $curDate);
           })->orderBy('id_act')->get();

           $etat = 'Actions_Retardées';

       }
       else
       {
           $actionsFiltre = $actions->orderBy('id_act')->get();
           $etat = 'Toutes_Les_Actions';
       }


       if ($array)
       {
           $fileName = $etat.'_Directions_Régionales.xlsx';
       }
       else
       {
           $fileName = $etat.'_'.$directionName->pluck('lib_dir')->first().'.xlsx';
       }

       Excel::store(new ActionsExport($actionsFiltre, $directionName), $fileName, 'public');

       return response()->download(Storage::disk('public')->path($fileName), $fileName,
       [
           'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
           'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
       ]);
   }
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////// Model Fiche ////////////////////////////////
    public function downloadPDF()
    {
        $pdfPath = storage_path('app\public\Modèle_fiche_indicateur.pdf');
        return response()->download($pdfPath, 'Modèle_fiche_indicateur.pdf');
    }
////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////// SUB ACTION PART  //////////////////////////////
   public function subAction($id_act)
   {
       $info = Description::where('id_act', $id_act)->get();

       return response()->json([ 'infos' => $info ]);

   }
////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////ACTIONS PROPOSEES///////////////////////////////////
    public function AjaxCopDr($directionId)
    {
        if($directionId == 'all'){
            $id_act_cop_dr = ActCopDrInd::pluck('id_act_cop_dr');

        }
        else{
            $id_act_cop_dr = ActCopDrInd::where('created_by', $directionId)->pluck('id_act_cop_dr');

        }
    
        $objectifs = Objectif::orderBy('id_obj')->get();
        $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
        $indicateursSelect = Indicateur::orderBy('id_ind')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();


        $data = [];

        foreach ($objectifs as $objectif)
        {
            $sousObjectifs = SousObjectif::where('id_obj', $objectif->id_obj)->get();

            foreach ($sousObjectifs as $sousObjectif) {
                $actions = ActionsCopDr::where('id_sous_obj', $sousObjectif->id_sous_obj)->whereIn('id_act_cop_dr', $id_act_cop_dr)->get();

                foreach ($actions as $action) {
                    $indicateurs = $action->indicateurs;

                    if ($indicateurs->isNotEmpty()) {
                        $indicateursText = '';
                        $formules = [];
                
                        foreach ($indicateurs as $indicateur) {
                            // Append the indicator's name to the text
                            $indicateursText .= $indicateur->lib_ind . ', ';
                            
                            // Store the formula in an array
                            $formules[] = $indicateur->formule;
                        }
                
                        // Remove the trailing comma and space
                        $indicateursText = rtrim($indicateursText, ', ');
                
                        // Join the formulas with a separator
                        $formulesText = implode(', ', $formules);
                    } else {
                        $indicateursText = '-';
                        $formulesText = '-';
                    }
                
                    $data[] = [
                        'objectif' => $objectif->lib_obj,
                        'sous_objectif' => $sousObjectif->lib_sous_obj,
                        'action' => $action->lib_act_cop_dr,
                        'date_debut' => $action->dd,
                        'date_fin' => $action->df,
                        'indicateurs' => $indicateursText,
                        'formules' => $formulesText, // Add formules to the data array
                        'id_act' => $action->id_act_cop_dr,
                    ];
                }
            }



        }

        return response()->json([
            'data' => $data,
        ]);

    }
/////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////// function select ajust //////////////////////////////
    public function ajaxDrAjust($directionDrId)
    {
        $actpro = [];
        $actionsPro = ActionsPro::get();

        if ($directionDrId=='all')
        {
            $actionsProDr = ActionsProDr::get();
        }
        else
        {
            $actionsProDr = ActionsProDr::where('id_dir', $directionDrId)->get();
        }
        

        if ($actionsPro->count() > 0 && $actionsProDr->count() > 0) 
        {
            foreach ($actionsPro as $actproItem) 
            {
                foreach ($actionsProDr as $actprolib) 
                {
                    if ($actproItem->id_act_pro == $actprolib->id_act_pro) 
                    {
                        $actpro[] = 
                        [
                            'structure' => $actprolib->lib_created_by,
                            'action' => $actproItem->lib_act_pro,
                            'dd' => $actproItem->dd,
                            'df' => $actproItem->df,
                            'dr' => $actprolib->lib_dir,
                        ];
                    }
                }
            }
        }

        return response()->json([
            'actpro' => $actpro,
            ]);
    }




////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Users(){
        $users = User::get();
        $directions = Direction::OrderBy('id_dir')->get();

        $usersBlockeds = UsersBlocked::get();
        return view('admin.users',compact('users','directions','usersBlockeds'));
    }

    public function Add_user(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $role = $request->input('role');
        $password = $request->input('password');
        $id_dir = $request->input('direction');

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return redirect()->route('admin.users')->with('warning-msg', 'L\'utilisateur existe déjà');
        }

       
        User::create([
            'name' => $name,
            'email' => $email,
            'role' => $role,
            'password' => Hash::make($password),
            'id_dir' => $id_dir,
        ]);

        return redirect()->route('admin.users')->with('success-msg', 'Utilisateur ajouté');
    }



    public function Delete_user($userId){

        $user = User::findOrFail($userId);
    $user->delete();

    return redirect()->route('admin.users')->with('success-msg', 'Utilisateur supprimé avec succès');
    }



/////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function Block_user(Request $request,$userId)
    {
        $request->validate([
            'userId' => 'required|exists:users,id',
        ]);

        $userId = $request->input('userId');

        
        if (UsersBlocked::where('id_user', $userId)->exists()) {
            return redirect()->route('admin.users')->with('warning-msg', 'Compte Utilisateur déjà bloqué');
        }

        UsersBlocked::create([
            'id_user' => $userId,
        ]);

        return redirect()->route('admin.users')->with('success-msg', 'Compte Utilisateur bloqué avec succès');
    }

///////////////////////////////////////////////////////////////////////////////////////////////
    public function Unblock_user(Request $request,$userId)
    {
        $request->validate([
            'userId' => 'required|exists:usersBlockeds,id_user_blocked',
        ]);

        $userId = $request->input('userId');

        
        $blockedUser = UsersBlocked::where('id_user_blocked', $userId)->first();

    if (!$blockedUser) {
        return redirect()->route('admin.users')->with('warning-msg', 'Compte Utilisateur n\'est pas bloqué');
    }

    $blockedUser->delete();
    return redirect()->route('admin.users')->with('success-msg', 'Compte Utilisateur débloqué avec succès');
    }
////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function Reset_user(Request $request, $userId)
    {
        $request->validate([
            'userId' => 'required|exists:users,id', 
            'passwordr' => 'required', 
        ]);

        $user = User::findOrFail($request->userId);

        $user->password = Hash::make($request->input('passwordr'));
        $user->save();

        return redirect()->route('admin.users')->with('success-msg', 'Mot de passe réinitialisé avec succès');
    }


////////////////////////////////////////////////////////////////////////////////////////////////////////
    public function getDirections($dirId){

        $id_dir = Direction::where('id_dir', $dirId)->pluck('id_dir');
        $users = User::where('id_dir', $id_dir)->select('id','name','email')->get();
        return json_encode($users);
    }
///////////////////////////////////////////////////////////////////////////////////////////////////////


    public function Actions (Request $request){
        
        $currentDate = date('Y-m');
        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
        $request->validate([
            'direction' => 'nullable|exists:directions,id_dir',
        ]);
        
        $id_dirDc = $directionsDc->pluck('id_dir');
        $id_dirDr = $directionsDr->pluck('id_dir');

        $id_actDc= Vda::whereIn('id_dc', $id_dirDc)->pluck('id_act');
        $id_actDr= Vda::whereIn('id_dr', $id_dirDr)->pluck('id_act');

        $actionsDc = Action::whereIn('id_act', $id_actDc)->orderBy('id_act')->get();
        $actionsDr = Action::whereIn('id_act', $id_actDr)->orderBy('id_act')->get();

        
        $actions = Action::orderBy('id_act')->get();

        $prioritaires = prioritaires::get();

        $cops = ActionsCop::get();
    
        return view("admin.actions")->with([
                'directionsDc' => $directionsDc,
                'directionsDr' => $directionsDr,
                'currentDate' =>$currentDate,
                'actionsDc' => $actionsDc,
                'actionsDr' => $actionsDr,
                'actions'=> $actions,
                'prioritaires'=> $prioritaires,
                'cops'=> $cops,
        ]);
    }

/////////////////////////////////////////////////////////////////////////////////////////
    public function Add_actionDC(Request $request){

        $lib_act = $request->input('lib_act');
        $code_act = $request->input('code_act');
        $dd = $request->input('dd');
        $df = $request->input('df');
        $id_dir= $request->input('id_dir');
        $id_prio= $request->input('act_prio');
        // $id_cop= $request->input('cop');
        $existingAction = Action::where('code_act', $code_act)->first();
        if ($existingAction) {
            return redirect()->route('admin.actions')->with('warning-msg', 'L\'action existe déjà');
        }

        $countId = Action::Max('id_act');

        $action = new Action();
        $action->id_act = ($countId+1);
        $action->lib_act = $lib_act;
        $action->code_act = $code_act;
        $action->dd = $dd;
        $action->df = $df;
        $action->id_dir = $id_dir;
        $action->id_p = $id_prio;
        // $action->id_cop = $id_cop;
        $action->save();
        

        if ($id_dir >= 1 && $id_dir <= 14) {
            $vda = new Vda();
            $vda->id_vda = ($countId+1);
            $vda->id_act = $action->id_act;
            $vda->id_dc = $id_dir;
            $vda->id_dr = null;
            $vda->save();

        } 
        elseif ($id_dir >= 15 && $id_dir <= 29) {
            $vda = new Vda();
            $vda->id_vda = ($countId+1);
            $vda->id_act = $action->id_act;
            $vda->id_dc = null;
            $vda->id_dr = $id_dir;
            $vda->save();
        }
        return redirect()->back()->with('success-msg', 'Action ajoutée');
    }
//////////////////////////////////////////////////////////////////////////////////////////////////////
public function Delete_actionDC(Request $request){
    $id_act = $request->input('id_act');

    // Find the action by ID
    $action = Action::find($id_act);

    if (!$action) {
        return redirect()->back()->with('error-msg', 'Action non trouvée');
    }

    try {
        
        Vda::where('id_act', $id_act)->delete();

        
        $action->delete();


        return redirect()->back()->with('success-msg', 'Action supprimée avec succés');
    } catch (\Exception $e) {
        

        return redirect()->back()->with('error-msg', 'La suppression de l\'action a échoué');
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
public function update_actionDC(Request $request)
{
    $actId = $request->input('id_act');

    $action = Action::find($actId);

    if (!$action) {
        return redirect()->back()->with('error-msg', 'Action non trouvée');
    }

    // Update lib_act if provided
    if ($request->filled('lib_act')) {
        $action->lib_act = $request->input('lib_act');
    }

    // Update dd if provided, otherwise retain the existing value
    if ($request->filled('dd')) {
        $action->dd = $request->input('dd');
    }

    // Update df if provided, otherwise retain the existing value
    if ($request->filled('df')) {
        $action->df = $request->input('df');
    }

    if ($request->filled('act_prio')) {
        $action->id_p = $request->input('act_prio');
    }

    try {
        $action->save();
        return redirect()->back()->with('success-msg', 'Action modifiée avec succès');
    } 
    catch (\Exception $e) {
        return redirect()->back()->with('error-msg', 'Échec de mise à jour de l\'action');
    }
}

////////////////////////////////////////////////////////////////////////////////////////////////////
public function Add_actionDR(Request $request){

    $lib_act = $request->input('lib_act');
    $code_act = $request->input('code_act');
    $dd = $request->input('dd');
    $df = $request->input('df');
    $id_dir= $request->input('id_dr');
    // $id_cop= $request->input('cop');
    $existingAction = Action::where('code_act', $code_act)->first();
    if ($existingAction) {
        return redirect()->route('admin.actions')->with('warning-msg', 'L\'action existe déjà');
    }

    $countId = Action::Max('id_act');

    $action = new Action();
    $action->id_act = ($countId+1);
    $action->lib_act = $lib_act;
    $action->code_act = $code_act;
    $action->dd = $dd;
    $action->df = $df;
    $action->id_dir = $id_dir;
    $action->save();
    

    if ($id_dir >= 1 && $id_dir <= 14) {
        $vda = new Vda();
        $vda->id_vda = ($countId+1);
        $vda->id_act = $action->id_act;
        $vda->id_dc = $id_dir;
        $vda->id_dr = null;
        $vda->save();

    } 
    elseif ($id_dir >= 15 && $id_dir <= 29) {
        $vda = new Vda();
        $vda->id_vda = ($countId+1);
        $vda->id_act = $action->id_act;
        $vda->id_dc = null;
        $vda->id_dr = $id_dir;
        $vda->save();
    }
    return redirect()->back()->with('success-msg', 'Action ajoutée');
}
////////////////////////////////////////////////////////////////////////////////////////////
public function Delete_actionDR(Request $request){
    $id_act = $request->input('id_act');

    // Find the action by ID
    $action = Action::find($id_act);

    if (!$action) {
        return redirect()->back()->with('error-msg', 'Action non trouvée');
    }

    try {
        
        Vda::where('id_act', $id_act)->delete();

        
        $action->delete();


        return redirect()->back()->with('success-msg', 'Action supprimée avec succés');
    } catch (\Exception $e) {
        

        return redirect()->back()->with('error-msg', 'La suppression de l\'action a échoué');
    }
}
///////////////////////////////////////////////////////////////////////////////////////////////////////
public function update_actionDR(Request $request)
{
    $actId = $request->input('id_act');

    $action = Action::find($actId);

    if (!$action) {
        return redirect()->back()->with('error-msg', 'Action non trouvée');
    }

    // Update lib_act if provided
    if ($request->filled('lib_act')) {
        $action->lib_act = $request->input('lib_act');
    }

    // Update dd if provided, otherwise retain the existing value
    if ($request->filled('dd')) {
        $action->dd = $request->input('dd');
    }

    // Update df if provided, otherwise retain the existing value
    if ($request->filled('df')) {
        $action->df = $request->input('df');
    }

    try {
        $action->save();
        return redirect()->back()->with('success-msg', 'Action modifiée avec succès');
    } 
    catch (\Exception $e) {
        return redirect()->back()->with('error-msg', 'Échec de mise à jour de l\'action');
    }
}

public function ActionsCop (){
    
    $objectifs= Objectif::orderBy('id_obj')->get();
    $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
    $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
    $indicateurs = Indicateur::orderBy('id_ind')->get();

    return view("admin.actionsCop")->with([
        'objectifs' => $objectifs,
        'sousobjectifs' => $sousobjectifs,
        'directionsDc' => $directionsDc,
        'indicateurs' => $indicateurs,
]);
}

}