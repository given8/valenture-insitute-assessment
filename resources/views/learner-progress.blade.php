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
    <div class="py-10">
        <div>
            <h1 class="text-blue font-black">Learner Progress Page</h1>
            <form action="/learner-progress" method="GET">
                @csrf
                <select name="course">
                    <option value="">Course Filter</option>
                    @foreach ($courses as $course)
                    <option value="{{ $course->id}}">{{ $course->name}}</option>
                    @endforeach
                </select>
                <select name="sort" selected="asc">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
                <button>Filter</button>
            </form>
            <form action="/learner-progress" method="GET">
            <button>Clear Filters</button></form>
        </div>
        
        @foreach ($learners as $learner)
            <div>
                <h3>{{ $learner->firstname }} {{ $learner->firstname }}</h3>
            </div>
            <div class="pl-2">
                @foreach ($learner->courses as $course)
                    <div class="flex gap-2">
                        <p>{{ $course->name }}</p>
                        <p>{{ $course->pivot->progress }}</p>
                        <p>{{ $learner->avg() }}</p>
                    </div>
                @endforeach
            </div>
        @endforeach
        <div>
            {{-- {{ $learners->links() }} --}}
        </div>
    </div>
</body>

</html>
