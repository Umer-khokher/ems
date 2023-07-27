<style>
    button.primarybtn{color: #fff;
    background-color: #007bff;
    border-color: #007bff;
    display: inline-block;
    font-weight: 400;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    border: 1px solid transparent;
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: 0.25rem;
    transition: color .15s ease-in-out,background-color .15s ease-in-out,border-color .15s ease-in-out,box-shadow .15s ease-in-out;}
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <h1>Check-in Attendance</h1>

<!-- latest one >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->
@auth
    <?php
    $uid = auth()->id(); // Get the authenticated user's ID
    $attendance = DB::table('attendances')->where('user_id', $uid)
                                         ->whereDate('created_at', now()->toDateString())
                                         ->first();
    ?>

    @if($attendance)
        <p>You have already checked in today.</p>
    @else
        <form action="{{ route('check-in-attendance') }}" method="POST">
            @csrf <!-- Add the CSRF token to the form for security -->

            <button type="submit" class="primarybtn">Check-in Now</button>
        </form>
    @endif
@endauth

<!-- latest one >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> -->

            </div>
        </div>
    </div>
</x-app-layout>
