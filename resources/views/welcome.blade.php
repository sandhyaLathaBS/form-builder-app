<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">


</head>

<body>
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
            <a style="float: right;" href="{{ url('/home') }}"
                class="text-sm text-gray-700 dark:text-gray-500 underline">Home</a>
            @else
            <a style="float: right;" href="{{ route('login') }}"
                class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

            @endauth
        </div>
        @endif
    </div>
    <div class="container">
        <h2>
            Submit Forms
        </h2>
        <div class="row">
            @if(!empty($forms))
            @foreach($forms as $form)
            <div style="padding: 45px;" class="col-md-3 shadow-lg">
                <h3>
                    <a href="{{url('fill-details')}}/<?= base64_encode($form->id); ?>">
                        <strong>{{$form->formName}}</strong></a>
                </h3>
            </div>
            @endforeach
            @endif
        </div>
    </div>
</body>

</html>