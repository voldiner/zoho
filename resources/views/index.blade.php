<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">

    <title>тестування запитів API ZOHO</title>
</head>
<body>
<div class="container">
    @dump(session()->all())
    <div class="row justify-content-center">
        <div class="col mt-5">
            <a href="{{ route('user') }}" class="btn btn-primary btn-lg" tabindex="-1" role="button" >Get User</a>
            <a href="{{ route('account') }}" class="btn btn-primary btn-lg" tabindex="-1" role="button" >Get Account</a>
            <a href="{{ route('contact') }}" class="btn btn-primary btn-lg" tabindex="-1" role="button" >Get Contact</a>
            <a href="{{ route('campaign') }}" class="btn btn-primary btn-lg" tabindex="-1" role="button" >Get Campaign</a>
            <a href="{{ route('deal') }}" class="btn btn-primary btn-lg @if (!session()->has(['users', 'accounts','contacts', 'campaigns'])) disabled @endif" tabindex="-1" role="button" >Create deal</a>
        </div>
    </div>
    <div class="row">
        <div class="col">
            {{-- user --}}
            @if(session()->has('users'))
                <div class="card  mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">USER</h5>
                        <p class="card-text"> {{ session('users')->first_name }}</p>
                        <p class="card-text"> {{ session('users')->email }}</p>
                        <p class="card-text">ID {{ session('users')->id }}</p>
                    </div>
                </div>
            @endif
            {{-- account --}}
            @if(session()->has('accounts'))
                <div class="card  mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Account</h5>
                        <p class="card-text"> {{ session('accounts')->Account_Name }}</p>
                        <p class="card-text"> {{ session('accounts')->Billing_Country }}</p>
                        <p class="card-text"> {{ session('accounts')->Industry }}</p>
                        <p class="card-text">ID {{ session('accounts')->id }}</p>
                    </div>
                </div>
            @endif
            {{-- contact --}}
            @if(session()->has('contacts'))
                <div class="card  mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">CONTACT</h5>
                        <p class="card-text"> {{ session('contacts')->Full_Name }}</p>
                        <p class="card-text"> {{ session('contacts')->Department }}</p>
                        <p class="card-text"> {{ session('contacts')->Mailing_Street }}</p>
                        <p class="card-text">ID {{ session('contacts')->id }}</p>
                    </div>
                </div>
            @endif
            {{-- campaign --}}
            @if(session()->has('campaigns'))
                <div class="card  mt-5" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">CAMPAIGN</h5>
                        <p class="card-text"> {{ session('campaigns')->Campaign_Name }}</p>
                        <p class="card-text"> {{ session('campaigns')->Type }}</p>
                        <p class="card-text">ID {{ session('campaigns')->id }}</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
-->
</body>
</html>
