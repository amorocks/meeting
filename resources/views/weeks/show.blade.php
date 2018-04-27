@extends('layouts.app')

@section('more-breadcrumbs')
    <li class="breadcrumb-item">
    	{{ $schoolyear->title }}
    </li>
    <li class="breadcrumb-item">
    	Weken aanmaken
    </li>
@endsection

@section('buttons-right')
	<a class="btn btn-outline-light" href="{{ route('schoolyears.show', $schoolyear) }}">
        <i class="fas fa-times"></i> Annuleren
    </a>
@endsection

@section('content')

	<h3 class="page-title">Weken benoemen voor schooljaar <em>{{ $schoolyear->title }}</em></h3>

	@include('layouts.errors')

	<p class="mb-0">Instructie:</p>
	<ul>
		<li>Voer alle weeknummers en periodes in, sla daarbij de vakanties en studieweken over.</li>
		<li>Bij weken die niet genummerd zijn, laat je het vakje leeg</li>
		<li>Je kunt een opmerking invoeren, maar dat hoeft niet.</li>
	</ul>

	<form action="{{ route('schoolyears.weeks.store', $schoolyear) }}" method="POST">
		{{ csrf_field() }}
		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>Week nr.</th>
					<th>Week</th>
					<th>Periode</th>
					<th>Week-in-periode</th>
					<th>Opmerkingen</th>
				</tr>
			</thead>
			<tbody>
				@foreach($weeks as $week)
					<tr>
						<td>
							<input type="hidden" name="weeks[{{ $week->iso_week }}][id]" value="{{ $week->id }}">
							<input type="hidden" name="weeks[{{ $week->iso_week }}][iso_week]" value="{{ $week->iso_week }}">
							<input type="hidden" name="weeks[{{ $week->iso_week }}][year]" value="{{ $week->year }}">
							{{ $week->iso_week }}
						</td>
						<td>{{ $week->start->format('d-m') }} - {{ $week->end->format('d-m') }}</td>
						<td>
							<input type="text" tabindex="1" name="weeks[{{ $week->iso_week }}][term]" class="form-control num-box" value="{{ old('weeks.'.$week->iso_week.'.term', $week->term) }}">
						</td>
						<td>
							<input type="text" tabindex="1" name="weeks[{{ $week->iso_week }}][week]" class="form-control num-box" value="{{ old('weeks.'.$week->iso_week.'.week', $week->week) }}">
						</td>
						<td>
							<input type="text" tabindex="0" name="weeks[{{ $week->iso_week }}][description]" class="form-control" value="{{ old('weeks.'.$week->iso_week.'.description', $week->description) }}">
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
		<button class="btn btn-success"><i class="fas fa-save"></i> Opslaan</button>
	</form>

@endsection