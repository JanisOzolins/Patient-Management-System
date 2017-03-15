<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class PrescriptionsController extends Controller
{
    public function store() 
    {
        //return request()->all();
        $user = User::find(request('patient_id'));
        $appointment = $user->appointments()->find(request('appointment_id'));

        //return request()->all();

        if ($appointment->prescriptions()->find(request('prescription_id')) != NULL) // checks if prescription needs to be updated instead of created
        {

            $prescription = $appointment->prescriptions()->find(request('prescription_id'));

            //return $prescription;

            $currentDoctor = Auth::user()->first_name . ' ' . Auth::user()->last_name;
            
            $prescription->p_name = request('p_name');
            $prescription->p_active = request('p_active');
            $prescription->p_condition = request('p_condition');
            $prescription->p_expiry = request('p_expiry');
            $prescription->p_controlled = request('p_controlled');
            $prescription->p_repeat = request('p_repeat');
            $prescription->p_details = request('p_details');

            $prescription->save();

            //return request()->all();


            return redirect('/user/' . request('patient_id'));
        }

        //return "CREATE REQUEST ------------- " . request()->all();

        $doctor = Auth::user()->first_name . ' ' . Auth::user()->last_name; // who is the prescribing doctor

        // return request()->all();

        $prescription = $appointment->prescriptions()->create([
        	'p_doctor' => $doctor, 
        	'p_name' => request('p_name'),
        	'p_condition' => request('p_condition'),
        	'p_active' => date('Y-m-d', strtotime(request('p_active'))),
        	'p_expiry' => date('Y-m-d', strtotime(request('p_expiry'))),
        	'p_repeat' => request('p_repeat'),
        	'p_controlled' => request('p_controlled'),
        	'p_details' => request('p_details'),
        ]);

        // active date should not be earlier than creation date

        if( date('Y-m-d', strtotime(request('p_active'))) <= date('Y-m-d', strtotime($prescription->created_at)))
        {
			$prescription->p_active = date('Y-m-d', strtotime($prescription->created_at));
			$prescription->save();	
		}

        // setting expiration date to 28 days (according to NHS) if a controlled drug is being prescribed

        if ($prescription->p_controlled === "Yes") {
        	$createDate = date('Y-m-d', strtotime($prescription->created_at)); // when the prescription was created
        	$activeDate = date('Y-m-d', strtotime(request('p_active')));  // when the prescription is supposed to become active
			if( $activeDate > $createDate)
				$setdate = $activeDate;
			else
				$setdate = $createDate;

			$daystoadd = '28';
			$date = date('Y-m-d', strtotime($setdate.' + '.$daystoadd.' days'));
        	$prescription->p_expiry = $date;
        	$prescription->save();
        }

        $appointment->save();

        return redirect('/user/' . request('patient_id') . '/appointments/' . request('appointment_id'));
    }

	public function delete($uid, $pid) 
	{
		$user = User::find($uid);
        $prescription = $user->prescriptions()->find();

		$prescription = $user->prescriptions()->find($pid);

		$prescription->delete();

		$user->save();

		return redirect()->route('user.show', ['id' => $uid]);
	}
}
