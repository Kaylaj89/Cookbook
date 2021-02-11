<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <x-layout.panel width="2">
        <livewire:algolia></livewire:algolia>
    </x-layout.panel>


    <x-layout.panel width="2">
        @php
        $user = auth()->user();
        @endphp
        <x-layout.description-list title="Quick Stats: {!!$user->currentTeam->name!!}">
            <x-layout.dl-row title="Users" class="text-right">
                {{count($user->currentTeam->allUsers())}}
            </x-layout.dl-row>

            <x-layout.dl-row title="Authors" color="white" class="text-right">
                {{count($user->currentTeam->authors)}}
            </x-layout.dl-row>

            <x-layout.dl-row title="Recipes" class="text-right">
                {{count($user->currentTeam->recipes)}}
            </x-layout.dl-row>

            <x-layout.dl-row title="Transcriptions Needed" color="white" class="text-right">
                @if($total_transcriptions_needed > 0) <x-layout.transcriptionlink href="/recipes/needstranscription">
                    view {{$total_transcriptions_needed}} recipes</x-layout.transcriptionlink> @else
                {{$total_transcriptions_needed}}@endif
            </x-layout.dl-row>
        </x-layout.description-list>
    </x-layout.panel>


</x-app-layout>