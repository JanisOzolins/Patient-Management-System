@if(count($user->conditions))
    @foreach ($user->conditions as $condition)
    <div class="panel-group">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="title-bar">
                        <a class="panel-title" data-toggle="collapse" href="#{{ $condition->id }}">{{ $condition->c_name }}</a>
                        {{ Form::open(['method' => 'DELETE', 'class' => 'delete-form', 'route' => ['conditions.delete', $condition->user->id, $condition->id]]) }}
                        {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-xs user-profile-icon', 'type' => 'submit']) }}
                        {{ Form::close() }}
                        <form>
                            <a 
                            type="button" 
                            class="btn btn-default btn-xs user-profile-icon" 
                            data-toggle="modal"
                            data-condition-id="{{ $condition->id }}"
                            data-patient-id="{{ $condition->user->id }}"
                            data-name="{{ $condition->c_name }}"
                            data-diagnosed="{{ $condition->c_diagnosed_at }}"
                            data-treated="{{ $condition->c_isTreated }}"
                            data-details="{{ $condition->c_details }}"
                            data-target="#conditionsModal">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                        </form>
                    </div>
                </h3>
            </div>
            <div id="{{ $condition->id }}" class="panel-collapse collapse">
                <ul class="list-group">
                    <li class="list-group-item"><strong>Diagnosed at:</strong> {{ $condition-> c_diagnosed_at }} </li>
                    <li class="list-group-item"><strong>Has it been treated?</strong> {{ $condition-> c_isTreated }}</li>
                    @if(isset( $condition-> c_details ))
                    <li class="list-group-item"><strong>Details:</strong> {{ $condition-> c_details}}</li> 
                    @endif 
            </div>
        </div>
    </div>
    @endforeach
@else
    <p>There are no added conditions for this patient.</p>
@endif