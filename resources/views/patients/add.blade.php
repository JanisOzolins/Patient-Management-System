<!-- Button trigger modal -->
<div class="prescriptions-controls">
@if (Auth::user()->user_type === "staff")
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUserModal">
    Add New Patient
</button>
@elseif (Auth::user()->user_type === "manager")
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUserModal">
    Add System User
</button>
@else
<button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#addUserModal" disabled>
    Add New Patient
</button>
@endif
</div>
<!-- Modal -->
<div class="modal fade prescriptions-container" id="addUserModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <!-- Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @if (Auth::user()->user_type === "staff")
                    <h4 class="modal-title">New Patient Profile</h4>
                @elseif (Auth::user()->user_type === "manager")
                    <h4 class="modal-title">New User Profile (Manager View)</h4>
                @endif
            </div>
            <!-- Body -->
            <div class="modal-body">
                <div class="row padded">
                    <div class="col-md-12">
                        @include('auth.register')
                    </div>
                </div>  
            </div>
        </div>
    </div>
</div>

