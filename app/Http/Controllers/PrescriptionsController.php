<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;

class PrescriptionsController extends Controller
{
    public function store() {

        //return request()->all();

        $user = User::find(request('patient_id'));
        $appointment = $user->appointments()->find(request('appointment_id'));
        $prescription = $appointment->prescriptions()->find(request('prescription_id'));


        if ($prescription === NULL) // if new prescriptions, create a new instance
        {
            $prescription = $appointment->prescriptions()->create(['p_name' => request('p_name')]);
        }

        $doctor = Auth::user()->first_name . ' ' . Auth::user()->last_name;

        $prescription->p_name = request('p_name');
        $prescription->p_doctor = $doctor;   
        $prescription->p_active = request('p_active');
        $prescription->p_condition = request('p_condition');
        $prescription->p_controlled = request('p_controlled');
        $prescription->p_repeat = request('p_repeat');
        $prescription->p_details = request('p_details');

        // active date should not be earlier than creation date
        if( date('Y-m-d', strtotime(request('p_active'))) < date('Y-m-d', strtotime($prescription->created_at)))
        {
			$prescription->p_active = date('Y-m-d', strtotime($prescription->created_at));
		}

        // set expiration date
        if ($prescription->p_controlled === "Yes") {
            // setting expiration date to 28 days (according to NHS) if a controlled drug is being prescribed
            $length = '28 days';
            $prescription->p_expiry = $this->setExpiryDate($prescription, $length);
        }
        elseif (($prescription->p_controlled === "No") && ($prescription->p_repeat === "No"))  {
            // setting expiration date to 6 months if non-controlled, non-repeat drug is prescribed
            $length = '6 months';
            $prescription->p_expiry = $this->setExpiryDate($prescription, $length);
        }
        elseif (($prescription->p_controlled === "No") && ($prescription->p_repeat === "Yes"))  {
            // setting expiration date for repeat prescription
            $length = request('p_expiry');
            $prescription->p_expiry = $this->setExpiryDate($prescription, $length);
        }

        //set the first repeatUnit 
        $repeat = $prescription->repeatUnits()->create([
            'repeat_requested' => request('p_active'),
            'repeat_approved' => request('p_active'),
            'repeat_expiry' => date('Y-m-d', strtotime(request('p_active') . '+ 1 month')),
            ]);

        $repeat->save();
        $prescription->save();  
        $appointment->save();
        return redirect('/user/' . request('patient_id') . '/appointments/' . request('appointment_id'));
    }

    public function setExpiryDate($prescription, $length) {
            $createDate = date('Y-m-d', strtotime($prescription->created_at)); // when the prescription was created
            $activeDate = date('Y-m-d', strtotime($prescription->p_active));  // when the prescription is supposed to become active
            if( $activeDate > $createDate) {
                $setdate = $activeDate;
            }
            else {
                $setdate = $createDate;
            }

            $date = date('Y-m-d', strtotime($setdate.'+'.$length));
            return $date;
    }

    public function setGeneralExpiry($prescription) {

    }

	public function delete($uid, $aid, $pid) {
		$user = User::find($uid);
        $appointment = $user->appointments()->find($aid);
        $prescription = $appointment->prescriptions()->find($pid);

		$prescription->delete();

		$user->save();

		return redirect('/user/' . $uid . '/appointments/' . $aid);
	}
}
