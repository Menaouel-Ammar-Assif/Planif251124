<?php

namespace App\Http\Controllers;

use App\Models\Action;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Role;
use App\Models\Direction;
use App\Models\Volet;
use App\Models\Vda;
use App\Models\Description;
use App\Models\DescriptionCop;
use App\Models\Objectif;
use App\Models\SousObjectif;
use App\Models\Indicateur;
use App\Models\ActionsPro;
use App\Models\ActionsProDr;
use App\Models\ActionsCopDr;
use App\Models\ActCopDrInd;
use App\Models\ActCopInd;

use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ActionDirecteurExport;
use App\Exports\CopValeurExport;
use App\Exports\CopValeurSExport;
use App\Exports\CopValeurNExport;
use App\Exports\CopValeurAExport;

use App\Models\ActionsCop;
use App\Models\CopCible;
use App\Models\CopValeur;
use App\Models\NumDenom;
use App\Models\NumDenomVals;
use App\Models\prioritaires;
use App\Models\Cause;
use Carbon\Carbon;
use LDAP\Result;
use Barryvdh\DomPDF\Facade\PDF as PDF;
// use Barryvdh\DomPDF\Facade;

class DirecteurController extends Controller
{
    public function DirecteurDashboard(): mixed
    {
        // date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d');
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        // $actions = Action::where('id_act', 103)->first();

        // $descriptions  = Description::where('id_act', 103)->orderByDesc('date')->get();

        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        $currentDate = date('Y-m');
        $date = date('Y-m-d');

        $direction = auth()->user()->Direction;

        if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) 
        {
            $actions = $direction->VdaC()->with('Action')
            ->get()->pluck('Action')
            ->flatten()
            ->sortBy('id_act');
        }
        else
        {
            $actions = $direction->VdaR()->with('Action')
            ->get()->pluck('Action')
            ->flatten()
            ->sortBy('id_act');
        }

        $descriptions = $actions->map(function ($a) {
            return $a->Description()->get();
        })->flatten();
        
        $numActions = $actions->count();

        // actions terminnes
        $etatTerm = $actions->where('etat', '100')->count();

        // actions retardées
        $etatRet = $actions->where('etat','<>', '100')->where('df', '<',$currentDate)->count();
        // actions en cours
        $etatEnC = $numActions - ($etatTerm + $etatRet);

        $totalEtat = $actions->sum('etat');

        $endDateThreshold = date('Y-m-d', strtotime('+10 days', strtotime($date)));

        // Filter actions that ended within 10 days or less
        $actionsInDanger = $actions->where('df', '<=', $endDateThreshold)->where('df', '>=', $date)->count();

        // Calculate the average etat
        if ($numActions > 0) {
            $averageEtat = $totalEtat / $numActions;
            $averageEtat = number_format($averageEtat, 2, '.', '');
        } else {
            $averageEtat = 0;
        }

        $currentDate = Carbon::now();
        $startOfYear = Carbon::createFromFormat('Y-m-d H:i:s', $currentDate->format('Y') . '-01-01 00:00:00');
        $totalDaysInYear = $startOfYear->diffInDays($startOfYear->copy()->endOfYear());
        $daysElapsed = $startOfYear->diffInDays($currentDate);
        $percentageElapsed = ($daysElapsed / $totalDaysInYear) * 100;
        $percentageElapsed = number_format($percentageElapsed, 2, '.', '');

        return view('directeur.directeur_dashboard', compact('NumDenom', 'actions','currentDate','date','descriptions','averageEtat','percentageElapsed','etatTerm','etatRet','etatEnC', 'actionsInDanger','month','day','year'));

    }

    public function add_desc(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = intval(date('m')); 

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        } else {
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act' => $id_act,
            'faite' => $faite,
            'a_faire' => $a_faire,
            'probleme' => $probleme,
            'date' => $currentDate,
            'etat' => $rangeValue,
            'mois' => $month, 
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        }

        return back()->with('success', 'successfully');
    }


    public function add_desc_pre(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = intval(date('m'));

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $month -1,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function add_desc_pre2(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = intval(date('m')); 

        $id_act = $request->input('id_act');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        Description::create([
            'id_act'=> $id_act,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $month -2,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = Description::where('id_act', $id_act)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function update_desc(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        if ($rangeValue > $etatT) {

        }else {

        }

        $description = Description::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save(['timestamps' => false]);
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = Description::where('id_act', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function update_desc2(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = Action::where('id_act', $id_act)->first();
        if ($action->etat != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $description = Description::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save(['timestamps' => false]);
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = Description::where('id_act', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }

    public function Proposition()
    {
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();

        // Fetch only the actions created by the authenticated user
            if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
                $actions = ActionsPro::whereHas('actionsProDrs', function ($query) {
                    $query->where('created_by', auth()->user()->id_dir);
                })->with(['actionsProDrs'])->get();
            }else{
                $actions = ActionsPro::whereHas('actionsProDrs', function ($query) {
                    $query->where('id_dir', auth()->user()->id_dir);
                })->with(['actionsProDrs'])->get();
            }

        return view('directeur.directeur_proposition', compact('dir', 'code', 'directionsDr', 'actions','NumDenom'));
    }


    public function add_act_pro(Request $request)
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;

        $validatedData = $request->validate([
            'act_pro' => 'required|string',
            'dd' => 'required|date',
            'df' => 'required|date',
            'selected_dr' => 'required|array',
            'selected_dr.*' => 'integer|exists:directions,id_dir',
        ]);


        $actionsPro = new ActionsPro();
        $actionsPro->lib_act_pro = $validatedData['act_pro'];
        $actionsPro->dd = $validatedData['dd'];
        $actionsPro->df = $validatedData['df'];
        $actionsPro->save();

        $id_act_pro = $actionsPro->id_act_pro;

        if(is_null($id_act_pro)){

            return redirect()->back()->withErrors(['msg' =>'Failed to save the action']);
        }

            foreach ($validatedData['selected_dr'] as $id_dir) {
                $direction = Direction::find($id_dir);
                $actionsProDr = new ActionsProDr();
                $actionsProDr->id_act_pro = $id_act_pro;
                $actionsProDr->id_dir = $id_dir;
                $actionsProDr->created_by = auth()->user()->id_dir;
                $actionsProDr->lib_created_by = $dir;
                $actionsProDr->lib_dir = $direction->lib_dir;

                $actionsProDr->save();
            }

        return redirect()->back()->with('success', 'Action proposée ajoutée avec succès');
    }


    public function getSousObjs($objId)
    {

        $idObj = Objectif::where('id_obj', $objId)->pluck('id_obj');

        $sousObjs = SousObjectif::whereIn('id_obj', $idObj)->select('id_sous_obj', 'lib_sous_obj')->get();

        return json_encode($sousObjs);
    }


    public function add_act_cop(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'obj' => 'required|exists:objectifs,id_obj',
            'sousObjList' => 'required|exists:sousObjectifs,id_sous_obj',
            'act_cop_dr' => 'required|string',
            'dd' => 'required|date',
            'df' => 'required|date|after_or_equal:dd',
            'selected_indicateurs' => 'required|array',
            'selected_indicateurs.*' => 'exists:indicateurs,id_ind',
        ]);

        // Create a new ActionsCopDr instance
        $actCopDr = new ActionsCopDr();
        $actCopDr->lib_act_cop_dr = $validatedData['act_cop_dr'];
        $actCopDr->dd = $validatedData['dd'];
        $actCopDr->df = $validatedData['df'];
        $actCopDr->id_obj = $validatedData['obj'];
        $actCopDr->id_sous_obj = $validatedData['sousObjList'];
        $actCopDr->save();


        foreach ($validatedData['selected_indicateurs'] as $indicatorId) {
            ActCopDrInd::create([
                'id_act_cop_dr' => $actCopDr->id_act_cop_dr,
                'id_ind' => $indicatorId,
                'created_by' => auth()->user()->id_dir, // Assuming you have authentication in place to get the currently logged-in user
            ]);
        }

        // Redirect or return a response as needed
        return redirect()->back()->with('success', 'Action ajoutée avec succès.');
    }

    public function Cop()
    {
        $id_act_cop_dr = ActCopDrInd::where('created_by', auth()->user()->id_dir)->pluck('id_act_cop_dr');

        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $objectifs = Objectif::orderBy('id_obj')->get();
        $sousobjectifs = SousObjectif::orderBy('id_sous_obj')->get();
        $indicateursSelect = Indicateur::orderBy('id_ind')->get();
        $directionsDr = Direction::where('type_dir', 'dr')->orderBy('id_dir')->get();
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();


        $data = [];

        foreach ($objectifs as $objectif) {
            $sousObjectifs = SousObjectif::where('id_obj', $objectif->id_obj)->get();

            foreach ($sousObjectifs as $sousObjectif) {
                $actions = ActionsCopDr::where('id_sous_obj', $sousObjectif->id_sous_obj)->whereIn('id_act_cop_dr', $id_act_cop_dr)->get();

                foreach ($actions as $action) {
                    $indicateurs = $action->indicateurs;

                    if ($indicateurs->count() > 1) {
                        $indicateursText = $indicateurs->pluck('lib_ind')->unique()->implode(', ');
                    } else {
                        $indicateursText = $indicateurs->first()->lib_ind;
                    }


                    $data[] = [
                        'objectif' => $objectif->lib_obj,
                        'sous_objectif' => $sousObjectif->lib_sous_obj,
                        'action' => $action->lib_act_cop_dr,
                        'date_debut' => Carbon::parse($action->dd)->format('d-m-y'),
                        'date_fin' => Carbon::parse($action->df)->format('d-m-y'),
                        'indicateurs' => $indicateursText,
                    ];
                }
            }
        }


        return view('directeur.directeur_cop', compact('dir', 'code', 'objectifs', 'sousobjectifs', 'indicateursSelect', 'directionsDr','data','NumDenom'));
    }


    public function CopAddPage() {
        $currentMonth = date('m');
        $month = date('m');

        $year = date('Y');
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        // Fetching actions associated with the direction
        $actionIds = Action::where('id_dir', $direction->id_dir)
        ->whereNotNull('id_cop') // Filter only actions where id_cop is not null
        ->pluck('id_act');

        // Fetching actionsCop associated with the fetched actions
        $actionsCopIds = ActionsCop::whereIn('id_act', $actionIds)->pluck('id_act_cop');

        // Fetching actCopInd associated with the fetched actionsCop
        $indicateurIds = ActCopInd::whereIn('id_act_cop', $actionsCopIds)->pluck('id_ind');

        // Fetching indicateurs associated with the fetched indicateurIds
        $indicateurs = Indicateur::whereIn('id_ind', $indicateurIds)
                        ->orderBy('id_ind')
                        ->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)
                        ->whereMonth('date', '=', $month)
                        ->where('id_dc', auth()->user()->id_dir)
                        ->get();
        // dd($NumDenomVals);
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        if ($month >= 1 && $month <= 3 ) {
            $year = $year -1;
            $myPeriod = '12';
        }elseif($month >= 4 && $month <= 6) {
            $myPeriod = '03';
        }elseif ($month >= 7 && $month <= 9) {
            $myPeriod = '06';
        }else {
            $myPeriod = '09';
        }
        $idInds = $indicateurs->pluck('id_ind');

        $latestCobValeur = CopValeur::whereIn('id_ind', $idInds)
                ->whereYear('periode', $year)
                ->whereMonth('periode', $myPeriod )
                ->where('ecartType', 'négatif')
                ->get();

        $Indicateur = Indicateur::get();
        $Objectif = Objectif::get();
        $SousObjectif = SousObjectif::get();

       $CopValeurT = CopValeur::whereIn('id_ind', $idInds)->whereMonth('periode', '03')->whereYear('periode', $year)->get();
        $CopValeurS = CopValeur::whereIn('id_ind', $idInds)->whereMonth('periode', '06')->whereYear('periode', $year)->get();
        $CopValeurN = CopValeur::whereIn('id_ind', $idInds)->whereMonth('periode', '09')->whereYear('periode', $year)->get();
        $CopValeurA = CopValeur::whereIn('id_ind', $idInds)->whereMonth('periode', '12')->whereYear('periode', ($year -1))->get();
        $CopValeurA2 = CopValeur::whereIn('id_ind', $idInds)->whereMonth('periode', '12')
                        ->whereYear('periode', ($year - 1))
                        ->exists();
        
        $CopCible = CopCible::get();

        return view('directeur.copAdd', compact('myPeriod', 'month', 'year', 'dir', 'code', 'indicateurs', 'NumDenom', 'NumDenomVals','latestCobValeur','Indicateur','Objectif','SousObjectif','CopValeurT','CopValeurS','CopValeurN','CopValeurA','CopValeurA2','CopCible'));
    }


    public function CopAddStore(Request $request){
        // $month = date('m');
        $year = date('Y');

        $month = $request->input('month');

        $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();
        // $NumDenomVals = NumDenomVals::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        // $NumDenomValss = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_dc', auth()->user()->id_dir)->get();

        foreach ($NumDenom as $item) {
            // foreach ($NumDenomVals as $NumDenomVal){
                // if ($item->id_num_denom == $NumDenomVal->id_num_denom){
                    $NumDenomVals = NumDenomVals::whereNull(columns: 'val')->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_num_denom', $item->id_num_denom)->where('id_dc', auth()->user()->id_dir)->firstOrNew(['id_num_denom' => $item->id_num_denom]);
                    if ($NumDenomVals->exists){
                            $NumDenomVals->update([
                                'id_num_denom'=> $item->id_num_denom,
                                'val'=> $request->input('chmp'.$item->id_num_denom),
                                'id_dc' => auth()->user()->id_dir,
                                'unite' => $item->unite,
                                'date' => $year.'-'.$month.'-01',
                                'created_at' => now(),
                                ]);
                    }
                    else {
                        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_num_denom', $item->id_num_denom)->where('id_dc', auth()->user()->id_dir)->firstOrNew(['id_num_denom' => $item->id_num_denom]);
                        if (!$NumDenomVals->exists){
                        NumDenomVals::create([
                            'id_num_denom'=> $item->id_num_denom,
                            'val'=> $request->input('chmp'.$item->id_num_denom),
                            'id_dc'=> auth()->user()->id_dir,
                            'unite' => $item->unite,
                            'date'=> $year.'-'.$month.'-01',
                            'created_at' => now(),
                        ]);
                    }}
                // }
            // }
        }

        return redirect()->back()->with('success', 'Ajoutée avec succès.');
    }


    public function Analyse (){
        $month = date('m');
        $currentMonth = date('m');
        $year = date('Y');
        $yearC = date('Y');
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;

        $actionIds = Action::where('id_dir', $direction->id_dir)->pluck('id_act');

        $actionsCopIds = ActionsCop::whereIn('id_act', $actionIds)->pluck('id_act_cop');

        $indicateurIds = ActCopInd::whereIn('id_act_cop', $actionsCopIds)->pluck('id_ind');
        $indicateurs = Indicateur::whereIn('id_ind', $indicateurIds)->orderBy('id_ind')->get();

        if ($month >= 1 && $month <= 3 ) {
            $yearC = $year -1;
            $myPeriod = '12';
        }elseif($month >= 4 && $month <= 6) {
            $myPeriod = '03';
        }elseif ($month >= 7 && $month <= 9) {
            $myPeriod = '06';
        }else {
            $myPeriod = '09';
        }

        $idInds = $indicateurs->pluck('id_ind');

        $latestCobValeur = CopValeur::whereIn('id_ind', $idInds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $myPeriod)
        ->get()
        ->map(function ($item) {
            $item->periode = Carbon::parse($item->periode);
            return $item;
        });

        // $latestCause = Cause::whereIn('id_ind', $idInds)
        // ->whereYear('periode', $yearC)
        // ->whereMonth('periode', $myPeriod)
        // ->whereNotNull('lib_cause')
        // ->get();

        return view('directeur.directeur_analyse', compact('month', 'year','dir','code', 'direction', 'indicateurs','latestCobValeur'));
    }


    public function CauseStore(Request $request)
{
    $selectedMonth = $request->input('month');
    $currentYear = now()->year;
    $periode = sprintf('%04d-%02d-01', $currentYear, $selectedMonth);

    $indicateurIds = $request->input('indicateur_ids');
    $causeData = $request->input('cause');
    $actionCorrectiveData = $request->input('action_corrective');

    $updateOccurred = false;

    foreach ($indicateurIds as $indicateurId) {
        $cause = $causeData[$indicateurId] ?? null;
        $actionCorrective = $actionCorrectiveData[$indicateurId] ?? null;

        // Skip if both cause and action corrective are empty
        if (empty($cause) && empty($actionCorrective)) {
            continue;
        }

        // Prepare data to update or create
        $data = [
            'periode' => $periode,
            'date_remplissage' => now(),
        ];

        // Add to data array only if not empty
        if (!empty($cause)) {
            $data['lib_cause'] = $cause;
        }

        if (!empty($actionCorrective)) {
            $data['lib_correct'] = $actionCorrective;
        }

        // Check if a record exists for the given indicateur
        $existingCause = Cause::where('id_ind', $indicateurId)
            ->orderBy('periode', 'desc')
            ->first();

        if ($existingCause && $existingCause->periode === $periode) {
            // Update only if the existing record is for the last period
            $existingCause->update($data);
            $updateOccurred = true;
        } elseif (!$existingCause) {
            // Create a new record if none exists
            Cause::create(array_merge($data, [
                'id_ind' => $indicateurId,
                'id_dir' => auth()->user()->id_dir,
            ]));
        }
    }

    if ($updateOccurred) {
        return redirect()->back()->with('success', 'Mise à jour avec succès!');
    } else {
        return redirect()->back()->with('info', 'Aucune mise à jour n a été faite.');
    }
}

    public function fetchCauseAction(Request $request)
{
    $month = $request->input('month');
    $yearC = date('Y');

    if ($month == '12') {
        $yearC -= 1;
    }

    $indicateurIds = Indicateur::pluck('id_ind');

    $latestCause = Cause::whereIn('id_ind', $indicateurIds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $month)
        ->get();

    $latestCopValeur = CopValeur::whereIn('id_ind', $indicateurIds)
        ->whereYear('periode', $yearC)
        ->whereMonth('periode', $month)
        ->with('cible')
        ->get();

    // Merge the two collections
    $data = $latestCopValeur->map(function ($item) use ($latestCause) {
        $cause = $latestCause->where('id_ind', $item->id_ind)->first();
        return [
            'id_ind' => $item->id_ind,
            'result' => $item->result,
            'cible' => $item->cible,
            'ecart' => $item->ecart,
            'ecartType' => $item->ecartType,
            'lib_cause' => $cause ? $cause->lib_cause : null,
            'lib_correct' => $cause ? $cause->lib_correct : null,
        ];
    });

    return response()->json(['data' => $data]);
}

    public function addMonth($month){
        $year = date('Y');

        $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->where('id_dc', auth()->user()->id_dir)->select('id_num_denom', 'val')->get();

        $months = [
            3 => 'trimestre',
            6 => 'semestre',
            9 => 'neuf mois',
            12 => 'annuel',
        ];
        $month = (int)$month;
        $m = $months[$month] ;
        
        $response = [
                'month' => $m,
                'year' => $year,
                'NumDenom' => $NumDenom,
                'NumDenomVals' => $NumDenomVals,
            ];
        return response()->json($response);
    }

    public function addMonthTwo($month){

        $year = date('Y');

        // $NumDenom = NumDenom::orderBy('id_num_denom')->where('id_dc', auth()->user()->id_dir)->get();

        $NumDenomVals = NumDenomVals::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->select('id_num_denom', 'val')->get();

        $months = [
            3 => 'trimestre',
            6 => 'semestre',
            9 => 'neuf mois',
            12 => 'annuel',
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

    public function DirecteurPageCalculate(){
        $month = date('m');
        $year = date('Y');

        if ($month >= 1 && $month <= 3 ) {
            $year = $year -1;
            $myPeriod = '12';
        }elseif($month >= 4 && $month <= 6) {
            $myPeriod = '03';
        }elseif ($month >= 7 && $month <= 9) {
            $myPeriod = '06';
        }else {
            $myPeriod = '09';
        }

        $NumDenom = NumDenom::orderBy('id_num_denom')->get();
        $Direction = Direction::orderBy('id_dir')->where('type_dir', 'dc')->select('id_dir', 'lib_dir', 'code')->get();
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $id_dir = $direction->id_dir;


        $Indicateur = Indicateur::get();
        $Objectif = Objectif::get();
        $SousObjectif = SousObjectif::get();
        $CopValeurT = CopValeur::whereMonth('periode', '03')->whereYear('periode', $year)->get();
        $CopValeurS = CopValeur::whereMonth('periode', '06')->whereYear('periode', $year)->get();
        $CopValeurN = CopValeur::whereMonth('periode', '09')->whereYear('periode', $year)->get();
        $CopValeurA = CopValeur::whereMonth('periode', '12')->whereYear('periode', ($year -1))->get();
        $CopValeurA2 = CopValeur::whereMonth('periode', '12')
                        ->whereYear('periode', ($year - 1))
                        ->exists();
        
        $CopCible = CopCible::get();

        // dd($CopValeurA2);
        return view('directeur.directeur_addValue', compact('myPeriod','month','year','NumDenom', 'Direction', 'dir', 'code', 'Indicateur','Objectif','SousObjectif','CopValeurT','CopValeurS','CopValeurN','CopValeurA','CopValeurA2','CopCible'));


    }
    

    
    public function DirecteurCalculate(Request $request)
    {

        $month = $request->input('month');
        $year = date('Y');
        $Indicateur = Indicateur::orderBy('id_ind')->get();

        foreach ($Indicateur as $ind) {

            $id_ind = $ind->id_ind;
            $id_sous_obj = $ind->id_sous_obj;
            $id_Objectif = $ind->SousObjectif->Objectif->id_obj;

            $CobValeur = CopValeur::whereYear('periode', '=', $year)->whereMonth('periode', '=', $month)->firstOrNew(['id_ind' => $id_ind]);

            $CobCible = $ind->CopCible->where('annee', $year)->first();
            $cible = $CobCible->cible;

            if ($month == '03') {
                $cibleP = $CobCible->cibleTrimestre;
            } elseif ($month == '06') {
                $cibleP = $CobCible->cibleSemestre;
            } elseif ($month == '09') {
                $cibleP = $CobCible->cibleT_Trimestre;
            }

            if ($ind->id_chiffre == '') {

                $num = $request->input('chmp' . $ind->id_num);
                $denom = $request->input('chmp' . $ind->id_denom);
                if ($denom == '') {
                    $Result = '0';
                } else {
                    if ($id_ind != '8') {
                        $R = (($num / $denom) * 100);
                        $Result = number_format($R, 4, '.', '');
                    } else {
                        $R = (($num / $denom));
                        $Result = number_format($R, 4, '.', '');
                    }
                }

                if ($cibleP == '') {
                    $EP = '0';
                    $eTP = '/';
                } else {
                    $eP = ((($Result / $cibleP) - 1) * 100);
                    $EP = number_format($eP, 4, '.', '');
                    if ($eP >= '0') {
                        $tP = 'positif';
                    } else {
                        $tP = 'négatif';
                    }

                    if ($ind->type_p == $tP) {
                        $eTP = 'positif';
                    } else {
                        $eTP = 'négatif';
                    }
                }

                if ($cible == '') {
                    $E = '0';
                    $eT = '/';
                } else {
                    $e = ((($Result / $cible) - 1) * 100);
                    $E = number_format($e, 4, '.', '');
                    if ($e >= '0') {
                        $t = 'positif';
                    } else {
                        $t = 'négatif';
                    }

                    if ($ind->type_p == $t) {
                        $eT = 'positif';
                    } else {
                        $eT = 'négatif';
                    }
                }





                if ($CobValeur->exists) {
                    $CobValeur->update([
                        'id_obj' => $id_Objectif,
                        'id_sous_obj' => $id_sous_obj,
                        'id_ind' => $id_ind,
                        'num' => $num,
                        'denom' => $denom,
                        'result' => $Result,
                        'periode' => $year . '-' . $month . '-' . '1',
                        'ecart' => $E,
                        'ecartType' => $eT,
                        'ecartP' => $EP,
                        'ecartTypeP' => $eTP,
                    ]);

                } else {
                    CopValeur::create([
                        'id_obj' => $id_Objectif,
                        'id_sous_obj' => $id_sous_obj,
                        'id_ind' => $id_ind,
                        'num' => $num,
                        'denom' => $denom,
                        'result' => $Result,
                        'periode' => $year . '-' . $month . '-' . '1',
                        'id_cop_cible' => $CobCible->id_cop_cible,
                        'ecart' => $E,
                        'ecartType' => $eT,
                        'ecartP' => $EP,
                        'ecartTypeP' => $eTP,
                    ]);
                }

            } else {
                $chiffre = $request->input('chmp' . $ind->id_chiffre);

                if ($cibleP == '') {
                    $EP = '0';
                    $eTP = '/';
                } else {
                    $eP = ((($chiffre / $cibleP) - 1) * 100);
                    $EP = number_format($eP, 4, '.', '');

                    if ($eP >= '0') {
                        $tP = 'positif';
                    } else {
                        $tP = 'négatif';
                    }

                    if ($ind->type_p == $tP) {
                        $eTP = 'positif';
                    } else {
                        $eTP = 'négatif';
                    }
                }


                if ($cible == '') {
                    $E = '0';
                    $eT = '/';
                } else {
                    $e = ((($chiffre / $cible) - 1) * 100);
                    $E = number_format($e, 4, '.', '');

                    if ($e >= '0') {
                        $t = 'positif';
                    } else {
                        $t = 'négatif';
                    }

                    if ($ind->type_p == $t) {
                        $eT = 'positif';
                    } else {
                        $eT = 'négatif';
                    }
                }

                if ($CobValeur->exists) {

                    $CobValeur->update([
                        'id_obj' => $id_Objectif,
                        'id_sous_obj' => $id_sous_obj,
                        'id_ind' => $id_ind,

                        'result' => $chiffre,
                        'periode' => $year . '-' . $month . '-' . '1',
                        'ecart' => $E,
                        'ecartType' => $eT,
                        'ecartP' => $EP,
                        'ecartTypeP' => $eTP,
                    ]);
                } else {

                    CopValeur::create([
                        'id_obj' => $id_Objectif,
                        'id_sous_obj' => $id_sous_obj,
                        'id_ind' => $id_ind,

                        'result' => $chiffre,
                        'periode' => $year . '-' . $month . '-' . '1',
                        'id_cop_cible' => $CobCible->id_cop_cible,
                        'ecart' => $E,
                        'ecartType' => $eT,
                        'ecartP' => $EP,
                        'ecartTypeP' => $eTP,
                    ]);
                }
            }
        }
        return redirect()->route('directeur.pageCalculate')->with('success', 'Calculs effectués avec succès');

    }

    public function DirecteurActionsPrio()
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;

        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $id_dirDc = $directionsDc->pluck('id_dir');

        $id_actDc= Vda::whereIn('id_dc', $id_dirDc)->pluck('id_act');
        $actionsDc = Action::whereIn('id_act', $id_actDc)->orderBy('id_act')->get();
        $numActDc = $actionsDc->count();

        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $nmbr_act_p_ = $act_p->count();

        $prioritaires = prioritaires::orderBy('id_p')->get();
        $nmbr_act_p= $prioritaires->count();
        $id_p = $prioritaires->pluck('id_p');

        $directionsDc = Direction::where('type_dir', 'dc')->orderBy('ordre')->get();
        $currentDate = date('Y-m');
        $act_p = Action::whereNotNull('id_p')->orderBy('id_act')->get();
        $id_act_p = $act_p->pluck('id_act');
        $descriptions = Description::whereIn('id_act', $id_act_p)->orderByDesc('date')->get();

        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        return view('directeur.directeur_actionsPrio', compact('dir', 'code','nmbr_act_p','numActDc','nmbr_act_p_','prioritaires','act_p','directionsDc','currentDate','descriptions','NumDenom'));
    }


    public function DirecteurActionsCop()
    {
        $direction = Direction::where('id_dir', auth()->user()->id_dir)->first();
        $dir = $direction->lib_dir;
        $code = $direction->code;
        $NbActCop = ActionsCop::select('id_act_cop')->count();

        $user = auth()->user();

        $objectifs = Objectif::orderBy('id_obj')->with([
            'sousObjectifs.actionsCop.actions.direction' => function ($query) use ($user) {
                $query->where('id_dir', $user->id_dir);
            },
            'sousObjectifs.actionsCop.actCopInd'
        ])->get();


        $object= $objectifs->pluck('id_obj');
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        return view('directeur.directeur_actionsCop', compact('dir', 'code', 'NbActCop', 'objectifs','object','NumDenom'));
    }

    public function subActionDirecteur($id_act)
    {
        $dateFull = Date('Y-m-d');
        $dateY = Date('Y');
        $dateM = Date('m');
        $dateD = Date('d');

        $actions = Action::where('id_act', $id_act)->get();


        $descriptions  = Description::where('id_act', $id_act)->orderByDesc('date')->get();

        //$descriptionsMPre = Description::whereIn('id_act', $id_act)->where('mois', ($dateM -1))->orderByDesc('mois')->get();

        
        return response()->json([
            'actions' => $actions,
            'descriptions' => $descriptions,
            //'descriptionsMPre' => $descriptionsMPre,
            'date' => $dateFull,
            'dateY' => $dateY,
            'dateM' => $dateM,
            'dateD' => $dateD,

        ]);
    }

    public function DrCop()
    {
        // $dir = auth()->user()->Direction->lib_dir;
        // $code = auth()->user()->Direction->code;
        $NumDenom = NumDenom::orderBy('id_num_denom')->get();

        // 

        $month = date('m');
        $year = date('Y');
        $JSdate = now();

        $currentDate = Carbon::now();
        $currentDateD = date('Y-m-d');
        // $ActionsCopDr = ActionsCopDr::orderBy('id_act_cop_dr')->where('id_dr', auth()->user()->id_dir)->get();
        $ActionsCopDr = auth()->user()->Direction->ActionsCopDr;
        $descriptions = DescriptionCop::orderByDesc('date')->get();

        // dd(auth()->user()->Direction->ActionsCopDr);

        $actionIds = $ActionsCopDr->pluck('id_act_cop_dr')->toArray();
        //$descriptions = Description::whereIn('id_act', $actionIds)->orderBy('id_desc')->get();
        $desc_idAct_date = DescriptionCop::whereIn('id_act_cop_dr', $actionIds)->select('id_act_cop_dr','date','mois')->orderByDesc('date')->get();

        // $monthInt = intval($month);
        // $descriptionCounts = [];
        // foreach ($ActionsCopDr as $action)
        // {
        //     $descriptionCounts[$action->id_act_cop_dr] = DescriptionCop::where('id_act_cop_dr', $action->id_act_cop_dr)->where('mois', $monthInt)->whereYear('date', $year)->count();
        // }

        // dd($desc_idAct_date);
        return view('directeur.directeur_cop', compact('month','JSdate', 'year','currentDate','currentDateD','NumDenom','ActionsCopDr','descriptions','desc_idAct_date'));
    }

    public function add_desc_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');



        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }


    public function add_desc_pre_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt -1,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }


    public function add_desc_pre2_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');
        $month = date('m');
        $monthInt = intval($month);

        $id_act_cop_dr = $request->input('id_act_cop_dr');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act_cop_dr)->first();
        if ($action->etat  != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        $etat_mois = ($rangeValue - $etatT);

        DescriptionCop::create([
            'id_act_cop_dr'=> $id_act_cop_dr,
            'faite'=> $faite,
            'a_faire' =>$a_faire,
            'probleme' =>$probleme,
            'date' =>$currentDate,
            'etat' =>$rangeValue,
            'mois' => $monthInt -2,
            'etat_mois' => $etat_mois,
        ]);

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act_cop_dr)->max('etat');

        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }




    public function update_desc_cop(Request $request)
    {
        date_default_timezone_set('Africa/Algiers');
        $currentDate = date('Y-m-d H:i');

        $id_act = $request->input('id_act_cop_dr');
        $id_desc = $request->input('id_desc');
        $faite = $request->input('Input1');
        $a_faire = $request->input('Input2');
        $probleme = $request->input('Input3');
        $rangeValue = $request->input('customRange');

        $action = ActionsCopDr::where('id_act_cop_dr', $id_act)->first();
        if ($action->etat != '') {
            $etatT = $action->etat;
        }else{
            $etatT = '0';
        }

        if ($rangeValue > $etatT) {

        }else {

        }

        $description = DescriptionCop::find($id_desc);
        if ($description) {
            $description->faite= $faite;
            $description->a_faire = $a_faire;
            $description->probleme = $probleme;
            $description->date_update = $currentDate;
            $description->etat = $rangeValue;

            if ($rangeValue > $etatT) {
                $etat_mois2 = ($rangeValue - $etatT);
                $SS = $description->etat_mois;
                $Z = $etat_mois2 + $SS;
            }else {
                $etat_mois2 = ($etatT - $rangeValue);
                $SS = $description->etat_mois;
                $Z = $SS - $etat_mois2;
            }

            $description->etat_mois = $Z;
            $description->save();
        }else {
            return back()->with('error', 'Not changed');
        };

        $maxEtat = DescriptionCop::where('id_act_cop_dr', $id_act)->max('etat');


        if ($action) {
            $action->etat = $maxEtat;
            $action->save();
        };

        return back()->with('success', 'successfully');
    }




    public function getDescriptions($actionId)
    {
        $descriptions = DescriptionCop::where('id_act_cop_dr', $actionId)->orderByDesc('date')->get();
        return response()->json($descriptions);
    }



    public function btnDC($idbtn)
    {
        $date = date('Y-m-d'); // Get current date

        $directionId = auth()->user()->id_dir;
        $direction = Direction::where('id_dir', $directionId)->first();

        if ($directionId && $directionId >= 1 && $directionId <= 14) {
            $id_act = Vda::where('id_dc', $directionId)->pluck('id_act');
        } else {
            $id_act = Vda::where('id_dr', $directionId)->pluck('id_act');
        }

        // Initialize query for actions
        $actions = Action::whereIn('id_act', $id_act)->with('prioritaires')->orderBy('id_act');


        if ($idbtn == 'E') 
        {
            $actions->where(function ($query) use ($date) 
            {
                $query->whereNull('etat')
                    ->where('df', '>', $date)
                    ->orWhere('etat', '!=', '100')
                    ->where('df', '>', $date);
            });
        } elseif ($idbtn == 'T') 
        {
            $actions->where('etat', '100');
        } elseif ($idbtn == 'R') 
        {
            $actions->where(function ($query) use ($date) {
                $query->whereNull('etat')
                    ->where('df', '<', $date)
                    ->orWhere('etat', '!=', '100')
                    ->where('df', '<', $date);
            });
        }elseif($idbtn == 'D')
        {
            
            $endDateThreshold = date('Y-m-d', strtotime('+10 days', strtotime($date)));
            $actions->where('df', '<=', $endDateThreshold)->where('df', '>=', $date);
        }

            $actionsFiltre = $actions->get();
        

        return response()->json([
            'actionsFiltre' => $actionsFiltre,
            'date' => $date,
        ]);
    }
    
        //////////////////////////////////////////////////
        
        public function Down($Name)
        {
            $curDate = date('Y-m-d');
            $idbtn = $Name;
            $direction = auth()->user()->Direction;
        
            // Determine the actions based on user role
            if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
                $actions = $direction->VdaC()->with('Action')
                    ->get()->pluck('Action')
                    ->flatten()
                    ->sortBy('id_act');
            } else {
                $actions = $direction->VdaR()->with('Action')
                    ->get()->pluck('Action')
                    ->flatten()
                    ->sortBy('id_act');
            }
        
            // Apply filters based on $idbtn
            if ($idbtn == 'DE') {
                $actionsFiltre = $actions->filter(function ($action) use ($curDate) {
                    return (is_null($action->etat) && $action->df > $curDate) ||
                        ($action->etat != '100' && $action->df > $curDate);
                })->sortBy('id_act');
        
                $etat = 'Actions_En_cours';
            } elseif ($idbtn == 'DT') {
                $actionsFiltre = $actions->filter(function ($action) {
                    return $action->etat == '100';
                })->sortBy('id_act');
        
                $etat = 'Actions_Finalisée';
            } elseif ($idbtn == 'DR') {
                $actionsFiltre = $actions->filter(function ($action) use ($curDate) {
                    return (is_null($action->etat) && $action->df < $curDate) ||
                        ($action->etat != '100' && $action->df < $curDate);
                })->sortBy('id_act');
        
                $etat = 'Actions_Echues';
            } else {
                $actionsFiltre = $actions->sortBy('id_act');
                $etat = 'Toutes_Les_Actions';
            }
        
            // Generate the file name
            $fileName = $etat . '_' . $direction->lib_dir . '.xlsx';
        
            // Download without saving to storage
            return Excel::download(new ActionDirecteurExport($actionsFiltre), $fileName);
        }

        public function DownPdf($Name){
            $curDate = date('Y-m-d');
            $idbtn = $Name;
            $direction = auth()->user()->Direction;
        
            // Determine the actions based on user role
            if (auth()->user()->id_dir && auth()->user()->id_dir >= 1 && auth()->user()->id_dir <= 14) {
                $actions = $direction->VdaC()->with('Action')
                    ->get()->pluck('Action')
                    ->flatten()
                    ->sortBy('id_act');
            } else {
                $actions = $direction->VdaR()->with('Action')
                    ->get()->pluck('Action')
                    ->flatten()
                    ->sortBy('id_act');
            }
        
            // Apply filters based on $idbtn
            if ($idbtn == 'PE') {
                $actionsFiltre = $actions->filter(function ($action) use ($curDate) {
                    return (is_null($action->etat) && $action->df > $curDate) ||
                        ($action->etat != '100' && $action->df > $curDate);
                })->sortBy('id_act');
        
                $etat = 'Actions_En_cours';
            } elseif ($idbtn == 'PT') {
                $actionsFiltre = $actions->filter(function ($action) {
                    return $action->etat == '100';
                })->sortBy('id_act');
        
                $etat = 'Actions_Finalisée';
            } elseif ($idbtn == 'PR') {
                $actionsFiltre = $actions->filter(function ($action) use ($curDate) {
                    return (is_null($action->etat) && $action->df < $curDate) ||
                        ($action->etat != '100' && $action->df < $curDate);
                })->sortBy('id_act');
        
                $etat = 'Actions_Echues';
            } else {
                $actionsFiltre = $actions->sortBy('id_act');
                $etat = 'Toutes_Les_Actions';
            }
        
            // Prepare the data for the view
            $data = [
                'actions' => $actionsFiltre,
                'etat' => $etat,
                'direction' => $direction,
                'curDate' => $curDate,
            ];
        
            // Generate the PDF from the view
            $pdf = PDF::loadView('directeur.pdfActions', $data);
        
            // Download the PDF
            return $pdf->download($etat . '_' . $direction->lib_dir . '.pdf');
        }



        public function export()
    {
        $year = date('Y');

        return Excel::download(new CopValeurExport, 'Trimestre ' . $year . '.xlsx');
    }

    public function exportS()
    {
        $year = date('Y');

        return Excel::download(new CopValeurSExport, 'Semestre ' . $year . '.xlsx');
    }

    public function exportN()
    {
        $year = date('Y');

        return Excel::download(new CopValeurNExport, 'Neuf mois ' . $year . '.xlsx');
    }

    public function exportA()
    {
        $year = date('Y');
        $year =  $year-1;
        return Excel::download(new CopValeurAExport, 'Année ' . $year . '.xlsx');
    }




    public function downloadPDFCop(Request $request)
    {
        $periode = $request->input('selectedValue');
        $Year = date('Y');
        $curDate = date('Y-m-d');
        $direction = auth()->user()->Direction;

        $periodeDescriptions = [
            '03' => 'Trimestre',
            '06' => 'Semestre',
            '09' => 'Neuf mois',
            '12' => 'Année'
        ];

        $periodeText = $periodeDescriptions[$periode] ?? $periode;
    

        $NumDenom = NumDenom::where('id_dc', auth()->user()->id_dir)
                            ->orderBy('id_num_denom')
                            ->get();

        $NumDenomVals = NumDenomVals::where('id_dc', auth()->user()->id_dir)->whereMonth('date', operator: $periode)->whereYear('date', $Year)->get();

        $pdf = Pdf::loadView('directeur.pdfCop', compact('NumDenom', 'NumDenomVals', 'direction', 'curDate', 'periodeText','Year'));

        // $pdf->setPaper('A4', 'landscape');

        return $pdf->download($direction->lib_dir . '_COP_' . $periodeText . '.pdf');
    }


    public function downloadPDFInd(Request $request)
    {
        $periode = $request->input('selectedValue');
        $year = date('Y');
        $curDate = date('Y-m-d');
        $direction = auth()->user()->Direction;

        $periodeDescriptions = [
            '03' => 'Trimestre',
            '06' => 'Semestre',
            '09' => 'Neuf mois',
            '12' => 'Année'
        ];

        $periodeText = $periodeDescriptions[$periode] ?? $periode;

        $numDenomVals = NumDenomVals::whereYear('date', $year)
            ->whereMonth('date', $periode)
            ->orderBy('id_num_denom')
            ->get();

        $data = [
            'direction' => $direction,
            'periodeText' => $periodeText,
            'numDenomVals' => $numDenomVals,
            'curDate' => $curDate
        ];

        $pdf = PDF::loadView('directeur.pdfIndicateurs', compact('periodeText', 'year', 'data', 'direction', 'numDenomVals'));

        return $pdf->download($direction->lib_dir . '_Indicateurs_' . $periodeText . '.pdf');
    }


}
