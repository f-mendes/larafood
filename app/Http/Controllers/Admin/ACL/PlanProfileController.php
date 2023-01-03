<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Profile;

class PlanProfileController extends Controller
{
    protected $plan, $profile;

    public function __construct(Plan $plan, Profile $profile)
    {

        $this->plan = $plan;
        $this->profile = $profile;
    }

    public function plans($idProfile)
    {
        $profile = $this->profile->find($idProfile);
        
        if(!$profile)
            return redirect()->back();

        $plans = $profile->plans()->paginate();

        return view('admin.pages.profiles.plans.index', compact('profile', 'plans'));
    }

    public function plansAvailable(Request $request, $idProfile)
    {
        
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();


        $filters = $request->except('_token');
        $plans = $profile->plansAvailable($request->filter);

        return view('admin.pages.profiles.plans.available', compact('profile', 'plans', 'filters'));
    }

    public function attachPlansProfile(Request $request, $idProfile)
    {
        if(!$profile = $this->profile->find($idProfile))
            return redirect()->back();

        if(!$request->plans || count($request->plans) == 0){
            return redirect()
                        ->back()
                        ->with('info', 'Precisa escolher pelo menos um plano');
        }

        $profile->plans()->attach($request->plans);

        return redirect()->route('profiles.plans', $profile->id);
    }

    public function detachPlanProfile($idProfile, $idplan)
    {
        $profile = $this->profile->find($idProfile);
        $plan = $this->plan->find($idplan);

        if(!$profile || !$plan)
            return redirect()->back();

        $profile->plans()->detach($plan);

        return redirect()->route('profiles.plans', $profile->id);
    }
}

