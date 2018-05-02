@foreach ($companies as $company)
<a href="{!! route('company.details', $company->slug) !!}">
	<img src="{!! asset($company->logo) !!}" style="height: 150px" alt="">
	<h6>{!! $company->name !!}</h6>
	<span>{!! $company->address->address.', '.$company->address->district->name.', '.$company->address->district->city->name !!}</span>
</a>
@endforeach