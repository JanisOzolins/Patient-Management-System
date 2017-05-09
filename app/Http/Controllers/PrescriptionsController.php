<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\User;
use Auth;
use Alert;

class PrescriptionsController extends Controller
{
    public function store() {

        // check if the user is authorised to issue prescriptions
        if (Auth::user()->user_type !== "doctor") {
            Alert::error('Sorry, you do not have access rights to perform this action!', 'Unauthorised access!')->persistent("Close");
            return back();
        }

        $user = User::find(request('patient_id'));
        $appointment = $user->appointments()->find(request('appointment_id'));
        $prescription = $appointment->prescriptions()->find(request('prescription_id'));

        if ($prescription === NULL) // if new prescriptions, create a new instance
        {
            $prescription = $appointment->prescriptions()->create(['p_name' => request('p_name')]);
        }

        $prescription->p_name = request('p_name');
        $prescription->p_doctor = Auth::user()->id;
        $prescription->p_active = request('p_active');
        $prescription->p_repeat_months = request('p_expiry');
        $prescription->p_condition = request('p_condition');
        $prescription->p_controlled = request('p_controlled');
        $prescription->p_repeat = request('p_repeat');
        $prescription->p_quantity = request('p_quantity');
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

	public function delete($uid, $aid, $pid) {
		$user = User::find($uid);
        $appointment = $user->appointments()->find($aid);
        $prescription = $appointment->prescriptions()->find($pid);

		$prescription->delete();

		$user->save();

		return redirect('/user/' . $uid . '/appointments/' . $aid);
	}

    public function sendPrescriptionRequest(Request $request) {
        $appointment_id = $request->input('appointment_id');
        $patient_id = $request->input('patient_id');
        $prescription_id = $request->input('prescription_id');

        $user = User::find($patient_id);
        $appointment = $user->appointments()->find($appointment_id);
        $prescription = $appointment->prescriptions()->find($prescription_id);
        $lastRepeatUnit = $prescription->repeatUnits()->last();

        // ensures that the repeat prescription hasn't expired yet
        if( $prescription->p_expiry < date('Y-m-d')) {
            return "This prescription has expired!";
        }

        $newRepeatUnit = $prescription->repeatUnits()->create([
            'repeat_requested' => date('Y-m-d'),
            'repeat_approved' => null,
            'repeat_expiry' => date('Y-m-d', strtotime($lastRepeatUnit->repeat_expiry . '+ 1 month')),
            ]);

        if($newRepeatUnit->repeat_expiry > $prescription->p_expiry) {
            $newRepeatUnit->repeat_expiry = $prescription->p_expiry;
        }

        $newRepeatUnit->save();
        $prescription-save();
        $appointment-save();
        $user-save();

        return back();
    }

    public function approveRepeatRequest(Request $request) {
        $appointment_id = $request->input('appointment_id');
        $patient_id = $request->input('patient_id');
        $prescription_id = $request->input('prescription_id');
        $repeat_unit_id = $request->input('repeat_unit_id');

        $user = User::find($patient_id);
        $appointment = $user->appointments()->find($appointment_id);
        $prescription = $appointment->prescriptions()->find($prescription_id);
        $lastRepeatUnit = $prescription->repeatUnits()->find($repeat_unit_id);

        if($lastRepeatUnit->repeat_approved == null) {
           $lastRepeatUnit->repeat_approved = date('Y-m-d'); 
           $lastRepeatUnit->save();
        }

    }
}
