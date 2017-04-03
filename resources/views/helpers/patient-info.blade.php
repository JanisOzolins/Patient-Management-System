<p class="info-title">Date of Birth:</p>
<p>{{ str_replace("-"," ", date('d-F-Y', strtotime($user->birth_date))) }}</p>
<p class="info-title">Age:</p>
<p>{{ $user->age }}</p>
<p class="info-title">Gender:</p>
<p>{{ $user->gender }}</p>
<p class="info-title">Address:</p>
<p>{{ $user->address }}</p>
<p class="info-title">Email:</p>
<p>{{ $user->email }}</p>
<p class="info-title">Phone:</p>
<p>{{ $user->phone }}</p>

