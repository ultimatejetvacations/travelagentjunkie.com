<nav class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/">@if(isset($travelAgency)) <img src="//www.ultimatejetvacations.com/images/travel-agencies/{{$travelAgency->logo}}" alt="{{$travelAgency->travel_agency_name}}" class="inline img-rounded"> <span class="inline">{{$travelAgency->travel_agency_name}}</span> @else Travel Agent Junkie <!--<small class="text-right">We get high off you!</small>--> @endif</a>
        </div>
    </div>
</nav>