@extends('layouts.app')

@section('more-breadcrumbs')
    <li class="breadcrumb-item">
    	<a href="{{ route('schoolyears.show', $schoolyear) }}">{{ $schoolyear->title }}</a>
    </li>
    <li class="breadcrumb-item">
    	{{ $week->title ?? "{$week->start->format('d-m')} - {$week->end->format('d-m')}" }}
    </li>
    <li class="breadcrumb-item">
    	{{ $meeting->title }}
    </li>
@endsection

@section('content')
	<div class="meeting">
		
		@include('meetings.partials.head')
		@includeWhen(count($suggestions), 'meetings.partials.suggestions')
		@include('layouts.partials.status')

		<div class="alert alert-info">
			<p><i class="fas fa-fw fa-info"></i> <strong>Aanpak betreft mededelingen</strong></p>
			<ul>
				<li>Een <em>mededeling</em> is in de Meeting-app geen aparte categorie.</li>
				<li>Weet je al vóór de vergadering dat je een mededeling hebt? Voeg dan een nieuw punt toe, voor iedere mededeling een. Eventueel kun je daar ook de inhoud van de mededeling al bij zetten, dan hoeft het niet meer genotuleerd te worden!</li>
				<li>Anders geef je tijdens het vaststellen van de agenda je punt door. Als we later bij dat punt arriveren, kun je de inhoud mededelen.</li>
			</ul>
		</div>

		<div class="alert alert-info">
			<p><i class="fas fa-fw fa-info"></i> <strong>Aanpak betreft taskboard</strong></p>
			<ul>
				<li>Het doel is dat uiteindelijk alle taken vanuit dit systeem gemaakt worden. Bij het maken van een taak, kies je dan ook gelijk wanneer deze weer terug moet komen op de agenda. We hoeven dan niet iedere week álle taken langs, maar alleen wat er voor die week relevant is.</li>
				<li>Voorlopige werkwijze betreft de ongeregistreerde taken: iedere vergadering aan het begin een item 'taskboard' toevoegen en daarin notuleren.</li>
			</ul>
		</div>

		<div class="d-flex justify-content-between mt-5 mb-3">
			<h4>Agenda</h4>
			<div class="btn-group d-print-none">
				<a class="btn btn-outline-secondary" href="{{ route('schoolyears.weeks.meetings.topics.create', [$schoolyear, $week, $meeting]) }}"><i class="fas fa-plus"></i> Nieuw</a>
				<a class="btn btn-outline-secondary" href="{{ route('meetings.listings.create', $meeting) }}"><i class="fas fa-plus"></i> Bestaand</a>
				<a class="btn btn-outline-secondary d-none d-md-inline" href="{{ route('meetings.listings.edit', $meeting) }}"><i class="fas fa-edit"></i> Agenda aanpassen</a>
				<a class="btn btn-outline-secondary d-none d-md-inline" href="{{ route('meetings.minutes.claim.show', $meeting) }}"><i class="fas fa-gavel"></i> Notuleren</a>
			</div>
		</div>
	
		<form action="{{ route('meetings.listings.delete', $meeting) }}" class="m-0" method="POST"> 
		{{ csrf_field() }}{{ method_field('DELETE') }}
		<table class="table table-hover">
			<thead>
				<tr>
					<th style="width: 50px;" class="d-none d-md-table-cell">&nbsp;</th>
					<th style="width: 75px;" class="d-none d-md-table-cell">Tijd</th>
					<th>Onderwerp</th>
					<th>Ref.</th>
					<th class="d-none d-md-table-cell">Toegevoegd door</th>
					<th class="d-print-none">Acties</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td class="d-none d-md-table-cell">1.</td>
					<td class="d-none d-md-table-cell"></td>
					<td>Welkom, vaststellen agenda en notulist</td>
					<td></td>
					<td class="d-none d-md-table-cell"></td>
					<td class="d-print-none"></td>
				</tr>

				<?php $end = 1; ?>
				@foreach($meeting->agenda_items as $agenda_item)
					<tr>
						<td class="d-none d-md-table-cell">{{ $end = $loop->iteration+1 }}.</td>
						<td class="d-none d-md-table-cell">{{ $agenda_item->listing->duration ? $agenda_item->listing->duration.' min' : '' }}</td>
						<td>{{ $agenda_item->title }}</td>
						<td>
							{{ ($agenda_item instanceof \App\Task) ? $agenda_item->slug : '' }}
						</td>
						<td class="d-none d-md-table-cell">{{ $agenda_item->listing->added_by }}</td>
						<td class="d-print-none">
							<div class="btn-group">
								<a href="{{ ($agenda_item instanceof \App\Topic) ? route('topics.show', $agenda_item) : route('tasks.show', $agenda_item) }}" target="_blank" class="btn btn-outline-secondary">
									<i class="fas fa-eye"></i>
								</a>
								<button type="submit" name="listing" value="{{ $agenda_item->listing->id }}" class="btn btn-outline-secondary d-none d-md-inline">
									<i class="fas fa-ban"></i>
								</button>
							</div>
						</td>
					</tr>
				@endforeach

				<tr>
					<td class="d-none d-md-table-cell">{{ $end+1 }}.</td>
					<td class="d-none d-md-table-cell"></td>
					<td>Rondvraag</td>
					<td></td>
					<td class="d-none d-md-table-cell"></td>
					<td class="d-print-none"></td>
				</tr>
			</tbody>
		</table>
		</form>
	</div>
@endsection