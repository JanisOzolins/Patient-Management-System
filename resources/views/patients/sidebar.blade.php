<img class="img-thumbnail" src="http://placehold.it/300x300" alt="patient profile picture">

<div class="tab-content">
    <div class="tab-pane active" id="wars">
      	<div class="table-responsive profile-info">
        	<table class="table">
          <tbody id="items">
            <tr><td class="attribute-name">Full Name</td></tr>
            <tr><td>{{ $user->first_name }} {{ $user->last_name }}</td></tr>

            <tr><td class="attribute-name">Date of Birth</td></tr>
            <tr><td>{{ $user->birth_date }}</td></tr>
        	<tr>
            	<td class="attribute-name">Age</td></tr>
            	<tr><td>{{ $user->age }}</td>
        	</tr>
        	<tr>
            	<td class="attribute-name">Address</td></tr>
            	<tr><td>{{ $user->address }}</td>
        	</tr>
        	<tr>
            	<td class="attribute-name">Email</td></tr>
            	<tr><td>{{ $user->email }}</td>
        	</tr>
        	<tr>
            	<td class="attribute-name">Phone</td></tr>
            	<tr><td>{{ $user->phone }}</td>
        	</tr>
          </tbody>
        </table>
    	</div>
    </div>
</div>