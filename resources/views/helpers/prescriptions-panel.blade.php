<div class="panel-group">
            <div class="panel prescriptions-panel panel-default">
                <div class="panel-heading">
                        <h3 class="panel-title">
                            <div class="prescriptions-title-bar">
                                <a class="panel-title" data-toggle="collapse" href="#{{ $prescription->id }}">{{ $prescription->p_name }}</a>
                                @if( Route::current()->getName() === "appointments.single")
                                @if(Auth::user()->user_type === "doctor")
                                    {{ Form::open(['method' => 'DELETE', 'route' => ['prescriptions.delete', $prescription->appointment->user->id, $prescription->appointment->id, $prescription->id]]) }}
                                    {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs user-profile-icon', 'type' => 'submit']) }}
                                    {{ Form::close() }}
                                    <form>
                                        <a 
                                        type="button" 
                                        class="btn btn-default btn-xs user-profile-icon prescriptionsEditButton" 
                                        data-toggle="modal"
                                        data-prescription-id="{{ $prescription->id }}"
                                        data-appointment-id="{{ $prescription->appointment->id }}"
                                        data-patient-id="{{ $prescription->appointment->user->id }}"
                                        data-condition="{{ $prescription->p_condition }}"
                                        data-name="{{ $prescription->p_name }}"
                                        data-active="{{ $prescription->p_active }}"
                                        data-quantity="{{ $prescription->p_quantity }}"
                                        data-expiry="{{ $prescription->p_expiry }}"
                                        data-repeat-months="{{ $prescription->p_repeat_months }}"
                                        data-repeat="{{ $prescription->p_repeat }}"
                                        data-controlled="{{ $prescription->p_controlled }}"
                                        data-details="{{ $prescription->p_details }}"
                                        data-target="#prescriptionsModal">
                                        <i class="fa fa-pencil" aria-hidden="true"></i>
                                        </a>
                                    </form>
                                @endif
                                @endif
                                @if( Route::current()->getName() === "patients.show")
                                    <a type="button" href="{{ URL::to('/user/' . $appointment->user->id . '/appointments/' . $appointment->id) }}" class="edit-condition-btn btn btn-default btn-xs user-profile-icon"> 
                                        <i class="fa fa-link" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </div>
                        </h3>
                        
                    
                </div>
                <div id="{{ $prescription->id }}" class="panel-collapse collapse">
                    <ul class="list-group"> 
                        <li class="list-group-item"><strong>Quantity: </strong> {{ $prescription-> p_quantity }}</li>
                        <li class="list-group-item"><strong>Active from: </strong> {{ $prescription-> p_active }} </li>
                        <li class="list-group-item"><strong>Expiry date: </strong> {{ $prescription-> p_expiry }}</li>
                        <li class="list-group-item"><strong>Controlled drug? </strong> {{ $prescription-> p_controlled}}</li> 
                        <li class="list-group-item"><strong>Repeat prescription? </strong> {{ $prescription-> p_repeat}}</li> 
                        <li class="list-group-item"><strong>Details: </strong> {{ $prescription-> p_details}}</li>
                        <li class="list-group-item"><strong>Prescribed by: </strong> {{ $prescription-> p_doctor }} </li>
                    </ul>
                </div>
            </div>
        </div>