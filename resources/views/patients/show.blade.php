@extends('layouts.master')

@section('content')
<div class="row">
  	<div class="col-md-4  user-left-container">
  		<img class="img-thumbnail" src="http://placehold.it/300x300" alt="">

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
	</div>
</div>
<div style="text-align: center" class="col-md-4">
<!-- 
	<img class="img-thumbnail" src="http://placehold.it/300x300" alt="">
	<h3>{{ $user->first_name }} {{ $user->last_name }}</h3>
	<div class="well appointment-info"><h2>{{ $user->birth_date }} </h2></div>
	<div class="well appointment-info"><h2><b>Time: </b>{{ $user->email }} </h2></div>   --> 
</div>
@endsection	