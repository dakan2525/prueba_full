<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/css/global.css') }}">

</head>


<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <main class="form-signin w-100 m-auto">
        <form action="{{ route('check') }}" method="POST">

            @csrf
            <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

            <div class="form-floating mb-2">
                <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com"
                    name="email" value="{{ old('email') }}">
                <label for="floatingInput">Correo electronico</label>
            </div>
            @error('email')
                <span class="text-danger ">{{ $message }}</span>
            @enderror
            <div class="form-floating mb-2">
                <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                    name="password">
                <label for="floatingPassword">contraseña</label>
            </div>
            @error('password')
                <span class="text-danger ">{{ $message }}</span>
            @enderror
            <button class="btn btn-primary w-100 py-2" type="submit">Iniciar</button>
            <p class="mt-5 mb-3 text-body-secondary">© 2023</p>
        </form>
    </main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (Session::get('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: "¡Bien!",
                text: '{{ Session::get('success') }}',
                custonClass: {
                    confirmButton: 'btn btn-success'
                },
                timer: 2500
            });
        </script>
    @endif
    @if (Session::get('fail'))
        <script>
            Swal.fire({
                icon: 'fail',
                title: "¡Error!",
                text: '{{ Session::get('fail') }}',
                custonClass: {
                    confirmButton: 'btn btn-danger'
                },
                timer: 2500

            });
        </script>
    @endif
</body>

</html>
