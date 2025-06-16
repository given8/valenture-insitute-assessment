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
    <div class="py-10 px-4">
        <div>
            <h1 class="text-blue font-black text-center pb-2 text-4xl">Learner Progress Page</h1>
            <hr class="py-2">
            <div class="flex gap-2">
            <form action="/learner-progress" method="GET">
                @csrf
                <div class="flex gap-2">
                <select class="rounded-md border-2 border-solid border-amber-300 py-2" name="course">
                    <option value="">Course Filter</option>
                    @foreach ($courses as $course)
                    <option 
                        value="{{ $course->id}}"
                         @if (isset($course) && $selectedCourse == $course->id) selected @endif>
                            {{ $course->name}}
                        </option>
                    @endforeach
                </select>
                <select class="rounded-md border-2 border-solid border-amber-300 py-2" name="sort">
                    <option value="">Sorting Order</option>
                    <option value="asc" @if (isset($course) && $sortingOrder == 'asc') selected @endif>
                        Ascending
                    </option>
                    <option value="desc" @if (isset($course) && $sortingOrder == 'desc') selected @endif>
                        Descending
                    </option>
                </select>
                <button class="bg-gray-300 rounded-md px-4 py-2">Filter</button>
                </div>
            </form>
            <form action="/learner-progress" method="GET">
            <button class="bg-gray-400 rounded-md px-4 py-2">Clear Filters</button>
            </form>
            </div>
        </div>
        <table class="w-full">
            <thead>
                <tr>
                    <th class="text-left sticky top-0 bg-white text-xl">Name</th>
                    <th class="text-left pl-2 sticky top-0 bg-white text-xl">Surname</th>
                    <th class="text-left sticky top-0 bg-white text-xl">Progress(%)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($learners as $learner)
            <tr>
                <td class="font-bold">{{ $learner->firstname }}</td>
                <td class="font-bold pl-2">{{ $learner->lastname }}</td>
                <td class="font-bold">{{round($learner->avg(),2)}}</td>
            </tr>
                @foreach ($learner->courses as $course)
                <tr class="border-b-solid border-b-gray-100 border-b-[2px]">
                    <td>{{ $course->name }}</td>
                    <td class="pl-2"></td>
                    <td>{{ $course->pivot->progress }}</td>
                </tr>
                @endforeach
                <tr class="border-b-solid border-b-2 border-b-gray-300">
                    <td></td>
                    <td class="pl-2"></td>
                    <td></td>
                </tr>
        @endforeach
            </tbody>
        </table>
        <div class="py-2">
            {{ $learners->appends(request()->input())->links() }}
        </div>
    </div>
</body>

</html>
