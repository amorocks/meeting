@extends('layouts.app')

@section('more-breadcrumbs')
    <li class="breadcrumb-item">
        <a href="{{ route('schoolyears.show', $meeting->week->schoolyear) }}">{{ $meeting->week->schoolyear->title }}</a>
    </li>
    <li class="breadcrumb-item">
        {{ $meeting->week->title ?? "{$meeting->week->start->format('d-m')} - {$meeting->week->end->format('d-m')}" }}
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('schoolyears.weeks.meetings.show', [$meeting->week->schoolyear, $meeting->week, $meeting]) }}">{{ $meeting->title }}</a>
    </li>
    <li class="breadcrumb-item">
        Notulen   
    </li>
@endsection

@section('content')

	<div class="meeting">
		
		@include('meetings.partials.head')

		<div class="alert alert-info d-print-none">
			<i class="fas fa-print"></i> Deze pagina is geschikt voor <em>afdrukken als pdf</em>.
		</div>

		<h4 class="my-4">Notulen</h4>
		
		<h5>1. Welkom, vaststellen agenda en notulist</h5>
		<hr class="my-5">

		@foreach($meeting->agenda_items as $item)

			<div class="minute">
				@unless($loop->first)<hr class="my-5">@endunless
				<h5>{{ $loop->iteration+1 }}. {{ $item->title }}</h5>

				<div class="list-group">
					@foreach($my_items[$item->listing->id] as $event)
						<div class="list-group-item">
							<div class="trix-content">{!! $event['text'] !!}</div>

							@if($event['date'] != null)
								<small>
									{{ $event['date']->format('d-m-Y H:i') }}
									@unless($event['user'] == null)
										door {{ $event['user'] }}
									@endunless
								</small>
							@endif
						</div>
					@endforeach
				</div>
				
			</div>
		@endforeach
	</div>

@endsection