<x-dashboard-layout>
	<x-slot name="pageName">{{ $pageName }}</x-slot>
    <x-slot name="breadCrumbs">
        <x-admin.breadcrumbs :pageName="$pageName" :breadCrumbs="$breadCrumbs"/>
    </x-slot>
	<x-slot name="inPageCss"></x-slot>
	<x-slot name="inPageJs"></x-slot>
	
</x-dashboard-layout>