<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-red-400 py-10">
        <h1 class="text-blue font-black">Learner Progress Page</h1>
        @foreach ($learners as $learner)
            <div>
                <h3>{{ $learner->firstname }} {{ $learner->lastname }}</h3>
            </div>
            <div class="pl-2">
                @foreach ($learner->courses as $course)
                    <div class="flex gap-2">
                        <p>{{ $course->name }}</p>
                        <p>{{ $course->pivot->progress }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div>
            {{ $learners->links() }}
        </div>
    </div>
</body>

</html>
