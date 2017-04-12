<div class="container-fluid doctors-homepage">
    <div class="col-md-7">
        <div style="background: salmon; text-align: center; padding: 25px;">Repeat Prescription Requests that need Approval</div>
        <div style="background: maroon; text-align: center; padding: 25px;">{{ Route::currentRouteName() }}</div>
    </div>
    <div class="col-md-5">
        <h3>Appointments This Week</h3>
        <div id='doctor-calendar-this-week'></div>
        <h3>Appointments Next Week</h3>
        <div id='doctor-calendar-next-week'></div>  
    </div>
</div>